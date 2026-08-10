// ===== Script khusus halaman register =====

function setRegisterRole(role) {
    document.getElementById('role_input').value = role;

    document.querySelectorAll('.role-tab').forEach(function (btn) {
        btn.classList.toggle('active', btn.dataset.role === role);
    });

    const companyFields = document.getElementById('company-fields');
    const labelName = document.getElementById('label_name');
    const labelPhone = document.getElementById('label_phone');

    if (role === 'perusahaan') {
        companyFields.style.display = 'block';
        labelName.textContent = 'Nama Penanggung Jawab';
        labelPhone.textContent = 'No Handphone Kontak';
    } else {
        companyFields.style.display = 'none';
        labelName.textContent = 'Nama Pelamar';
        labelPhone.textContent = 'No Handphone';
    }
}

// Diperlukan karena tombol role masih memakai atribut onclick="setRegisterRole(...)"
// di Blade, sementara Vite membungkus file ini sebagai module (tidak otomatis
// global). Kalau nanti onclick diganti dengan addEventListener, baris ini
// bisa dihapus.
window.setRegisterRole = setRegisterRole;

function initRegisterAnimations() {
    const animatedItems = [
        '.hero-label',
        '.hero-title',
        '.hero-desc',
        '.stats-row',
        '.hero-card',
    ];

    animatedItems.forEach((selector, index) => {
        const el = document.querySelector(selector);

        if (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(40px)';
            el.style.transition = 'all 0.8s ease';

            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 200 + index * 180);
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initRegisterAnimations();

    const initialRole = document.getElementById('role_input').value || 'pelamar';
    setRegisterRole(initialRole);
});

if (role === 'perusahaan') {
    companyFields.style.display = 'grid';
    labelName.textContent = 'Nama Penanggung Jawab';
    labelPhone.textContent = 'No Handphone Kontak';
} else {
    companyFields.style.display = 'none';
    labelName.textContent = 'Nama Pelamar';
    labelPhone.textContent = 'No Handphone';
}