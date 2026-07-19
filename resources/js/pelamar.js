// resources/js/pelamar.js
// Script khusus halaman "Profil Saya" (member card, upload avatar,
// upload/hapus dokumen, edit data pribadi inline).
//
// Route Laravel (route()) tidak bisa dipanggil dari file JS statis,
// jadi nilainya dibaca dari `window.PROFIL_ROUTES` yang di-set lewat
// blok <script> kecil di profil.blade.php sebelum file ini dimuat.

function initSkeletonReveal() {
    const skeleton = document.getElementById('profileSkeleton');
    const content = document.getElementById('profileContent');
    const avatarImg = document.getElementById('avatarPreviewImg');

    if (!skeleton || !content || !avatarImg) return;

    function reveal() {
        skeleton.classList.add('hidden');
        content.classList.add('loaded');
    }

    // Tunggu avatar (gambar terberat) selesai load, dengan fallback timeout
    if (avatarImg.complete) {
        reveal();
    } else {
        avatarImg.addEventListener('load', reveal, { once: true });
        avatarImg.addEventListener('error', reveal, { once: true });
    }

    // Fallback: paksa tampil setelah 1.5 detik meskipun gambar lambat
    setTimeout(reveal, 1500);
}

function initAvatarUpload() {
    const input = document.getElementById('avatarInput');
    const img = document.getElementById('avatarPreviewImg');
    const loading = document.getElementById('avatarLoading');
    const form = document.getElementById('avatarForm');

    if (!input || !img || !loading || !form) return;

    const originalSrc = img.src;

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const maxSizeMB = 2;
        if (file.size > maxSizeMB * 1024 * 1024) {
            alert('Ukuran foto maksimal ' + maxSizeMB + 'MB.');
            input.value = '';
            return;
        }

        // Preview instan
        const reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);

        // Auto-submit ke server
        loading.classList.add('active');

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(response => {
                if (!response.ok) throw new Error('Gagal upload');
                return response.json();
            })
            .then(data => {
                if (data.avatar_url) {
                    img.src = data.avatar_url;
                }
            })
            .catch(() => {
                alert('Gagal mengubah foto profil, silakan coba lagi.');
                img.src = originalSrc;
            })
            .finally(() => {
                loading.classList.remove('active');
                input.value = '';
            });
    });
}

function initDocumentManager() {
    const documentInput = document.getElementById('documentInput');
    const docList = document.getElementById('docList');

    if (!documentInput || !docList) return;

    const csrfTokenInput = document.querySelector('#documentForm input[name="_token"]');
    const csrfToken = csrfTokenInput ? csrfTokenInput.value : '';
    const routes = window.PROFIL_ROUTES || {};

    function docItemHtml(doc) {
        return `
            <div class="doc-item" data-id="${doc.id}">
                <div class="doc-item-info">
                    <span class="material-icons-round" style="color:var(--rust);">${doc.icon}</span>
                    <span>${doc.name}</span>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <a href="${doc.url}" target="_blank" class="material-icons-round doc-item-view">visibility</a>
                    <span class="material-icons-round" style="cursor:pointer; color:var(--rust); font-size:20px;" data-delete-id="${doc.id}">delete</span>
                </div>
            </div>`;
    }

    documentInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran dokumen maksimal 5MB.');
            this.value = '';
            return;
        }

        const formData = new FormData();
        formData.append('document', file);
        formData.append('_token', csrfToken);

        fetch(routes.documentStore, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(res => { if (!res.ok) throw new Error(); return res.json(); })
            .then(doc => {
                document.getElementById('docEmptyNote')?.remove();
                docList.insertAdjacentHTML('beforeend', docItemHtml(doc));
            })
            .catch(() => alert('Gagal mengunggah dokumen, silakan coba lagi.'))
            .finally(() => { documentInput.value = ''; });
    });

    docList.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-delete-id]');
        if (!btn) return;
        if (!confirm('Hapus dokumen ini?')) return;

        fetch(`${routes.documentDeleteBase}/${btn.dataset.deleteId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(res => { if (!res.ok) throw new Error(); btn.closest('.doc-item').remove(); })
            .catch(() => alert('Gagal menghapus dokumen, silakan coba lagi.'));
    });
}

function initDataPribadiForm() {
    const card = document.getElementById('dataPribadiCard');
    const form = document.getElementById('dataPribadiForm');
    const editBtn = document.getElementById('editDataBtn');
    const actions = document.getElementById('editDataActions');
    const cancelBtn = document.getElementById('cancelDataBtn');
    const saveBtn = document.getElementById('saveDataBtn');

    if (!card || !form || !editBtn || !actions || !cancelBtn || !saveBtn) return;

    const csrfTokenInput = form.querySelector('input[name="_token"]');
    const csrfToken = csrfTokenInput ? csrfTokenInput.value : '';
    const routes = window.PROFIL_ROUTES || {};

    function toggleEditMode(isEditing) {
        card.querySelectorAll('.data-view').forEach(el => {
            el.style.display = isEditing ? 'none' : 'block';
        });
        card.querySelectorAll('.data-edit').forEach(el => {
            el.style.display = isEditing ? 'block' : 'none';
        });
        editBtn.style.display = isEditing ? 'none' : 'flex';
        actions.style.display = isEditing ? 'flex' : 'none';
    }

    function resetInputs() {
        card.querySelectorAll('.data-edit').forEach(input => {
            const view = card.querySelector(`.data-view[data-field="${input.name}"]`);
            input.value = view.textContent.trim() === 'Belum diisi' ? '' : view.textContent.trim();
        });
    }

    editBtn.addEventListener('click', function (e) {
        e.preventDefault();
        resetInputs();
        toggleEditMode(true);
    });

    cancelBtn.addEventListener('click', function (e) {
        e.preventDefault();
        toggleEditMode(false);
    });

    saveBtn.addEventListener('click', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch(routes.profilUpdate, {
            method: 'POST', // Laravel method spoofing (@method('PATCH') di form)
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
            .then(res => {
                if (!res.ok) throw new Error();
                return res.json();
            })
            .then(data => {
                card.querySelectorAll('.data-view').forEach(el => {
                    const value = data[el.dataset.field];
                    el.textContent = value && value.trim() !== '' ? value : 'Belum diisi';
                });
                toggleEditMode(false);
            })
            .catch(() => alert('Gagal menyimpan data, periksa kembali isian kamu.'));
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initSkeletonReveal();
    initAvatarUpload();
    initDocumentManager();
    initDataPribadiForm();
});