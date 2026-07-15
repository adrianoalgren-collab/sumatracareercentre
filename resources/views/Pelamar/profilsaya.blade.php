<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Saya | Sumatra Career Centre</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@600;700;900&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet" />

    {{-- Main CSS --}}
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])

    <style>
        /* SKELETON LOADING */
        .skeleton {
            background: linear-gradient(90deg, #e8eef1 25%, #f2f6f8 37%, #e8eef1 63%);
            background-size: 400% 100%;
            animation: skeleton-shimmer 1.4s ease infinite;
            border-radius: 8px;
        }

        @keyframes skeleton-shimmer {
            0% { background-position: 100% 50%; }
            100% { background-position: 0 50%; }
        }

        .skeleton-circle { border-radius: 50%; }

        .skeleton-line { height: 14px; margin-bottom: 10px; }
        .skeleton-line.w-60 { width: 60%; }
        .skeleton-line.w-80 { width: 80%; }
        .skeleton-line.w-40 { width: 40%; }

        #profileContent {
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        #profileContent.loaded {
            opacity: 1;
        }

        #profileSkeleton.hidden {
            display: none;
        }
    </style>
</head>

<body style="background:var(--cream); font-family:'DM Sans',sans-serif; color:var(--charcoal);">

<x-navbar />

<main class="profile-page section" style="padding-top:110px;">
    <div class="section-inner">

        <div class="section-eyebrow">Akun Saya</div>
        <h1 class="section-title" style="margin-bottom:44px;">Profil Saya</h1>

        {{-- ================= SKELETON ================= --}}
        <div id="profileSkeleton" class="profile-grid">

            <aside class="profile-sidebar">
                <div class="member-card" style="align-items:center; display:flex; flex-direction:column; gap:14px;">
                    <div class="skeleton skeleton-circle" style="width:110px; height:110px;"></div>
                    <div class="skeleton skeleton-line w-60" style="height:18px;"></div>
                    <div class="skeleton skeleton-line w-80"></div>
                    <div class="skeleton skeleton-line w-40" style="height:22px; border-radius:20px;"></div>
                </div>

                <div class="job-card" style="margin-top:24px;">
                    <div class="skeleton skeleton-line w-60" style="margin-bottom:16px;"></div>
                    <div class="skeleton skeleton-line w-80"></div>
                    <div class="skeleton skeleton-line w-80"></div>
                    <div class="skeleton skeleton-line w-60"></div>
                </div>

                <div class="job-card" style="margin-top:24px;">
                    <div class="skeleton skeleton-line w-60" style="margin-bottom:16px;"></div>
                    <div class="skeleton skeleton-line w-80"></div>
                    <div class="skeleton skeleton-line w-80"></div>
                </div>
            </aside>

            <section class="profile-main">
                <div class="profile-stats">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="job-card profile-stat-card">
                            <div class="skeleton skeleton-circle" style="width:44px; height:44px; margin-bottom:14px;"></div>
                            <div class="skeleton skeleton-line w-40"></div>
                            <div class="skeleton skeleton-line w-60" style="height:24px;"></div>
                        </div>
                    @endfor
                </div>

                <div class="job-card" style="margin-top:24px; padding:32px;">
                    <div class="skeleton skeleton-line w-40" style="height:20px; margin-bottom:26px;"></div>
                    <div class="profile-data-grid">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="profile-data-item">
                                <div class="skeleton skeleton-circle" style="width:20px; height:20px;"></div>
                                <div style="width:100%;">
                                    <div class="skeleton skeleton-line w-40" style="height:10px;"></div>
                                    <div class="skeleton skeleton-line w-80"></div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="skeleton" style="margin-top:24px; height:180px; border-radius:20px;"></div>
            </section>

        </div>

        {{-- ================= KONTEN ASLI ================= --}}
        <div id="profileContent" class="profile-grid">

            {{-- ================= SIDEBAR — MEMBER ID CARD ================= --}}
            <aside class="profile-sidebar">

                {{-- MEMBER CARD --}}
                <div class="member-card">
                    <div class="member-card-ring member-card-ring-outer"></div>
                    <div class="member-card-ring member-card-ring-inner"></div>

                    <div class="member-card-top">
                        <span class="member-card-label">Sumatra Career Centre</span>
                        <span class="member-card-id">ID · {{ $user->member_id }}</span>
                    </div>

                    <div class="member-card-avatar-wrap">
                        <svg class="member-card-progress" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="54" class="member-card-progress-track" />
                            <circle cx="60" cy="60" r="54" class="member-card-progress-fill"
                                    style="stroke-dasharray: 339.3; stroke-dashoffset: {{ round(339.3 - (339.3 * $user->profile_completion / 100)) }};" />
                        </svg>

                        <div class="member-card-avatar" id="avatarPreviewWrap">
                            <img src="{{ $user->avatar_url }}"
                                 alt="Foto profil {{ $user->name }}"
                                 id="avatarPreviewImg">

                            <div class="member-card-avatar-loading" id="avatarLoading">
                                <span class="material-icons-round">refresh</span>
                            </div>
                        </div>

                        <form id="avatarForm"
                              action="{{ route('profil.foto.update') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              style="display:contents;">
                            @csrf
                            @method('PATCH')

                            <label for="avatarInput" class="member-card-edit" aria-label="Ubah foto profil">
                                <span class="material-icons-round">edit</span>
                            </label>

                            <input type="file"
                                   name="photo"
                                   id="avatarInput"
                                   accept="image/png, image/jpeg, image/webp"
                                   hidden>
                        </form>
                    </div>

                    <h2 class="member-card-name">{{ $user->name }}</h2>
                    <p class="member-card-email">{{ $user->email }}</p>

                    <span class="tag {{ $user->role_tag_class }}" style="margin-top:14px;">{{ $user->role_label }}</span>

                    <div class="member-card-divider"></div>

                    <div class="member-card-completion">
                        <span>Kelengkapan Profil</span>
                        <strong>{{ $user->profile_completion }}%</strong>
                    </div>
                </div>

                {{-- CHECKLIST --}}
                <div class="job-card" style="margin-top:24px;">
                    <p class="hero-card-label" style="color:var(--jade); margin-bottom:16px;">Langkah Berikutnya</p>
                    <ul class="checklist">
                        <li class="checklist-item {{ $user->photo ? 'checklist-done' : '' }}">
                            <span class="material-icons-round">{{ $user->photo ? 'check_circle' : 'radio_button_unchecked' }}</span>
                            Foto profil
                            @unless($user->photo)
                                <a href="#" class="link-viewall" style="margin-left:auto; font-size:0.6875rem;">Lengkapi</a>
                            @endunless
                        </li>
                        <li class="checklist-item {{ $user->phone ? 'checklist-done' : '' }}">
                            <span class="material-icons-round">{{ $user->phone ? 'check_circle' : 'radio_button_unchecked' }}</span>
                            No HP
                            @unless($user->phone)
                                <a href="#" class="link-viewall" style="margin-left:auto; font-size:0.6875rem;">Lengkapi</a>
                            @endunless
                        </li>
                        <li class="checklist-item {{ $user->address ? 'checklist-done' : '' }}">
                            <span class="material-icons-round">{{ $user->address ? 'check_circle' : 'radio_button_unchecked' }}</span>
                            Alamat
                            @unless($user->address)
                                <a href="#" class="link-viewall" style="margin-left:auto; font-size:0.6875rem;">Lengkapi</a>
                            @endunless
                        </li>
                    </ul>
                </div>

                {{-- DOCUMENTS & SKILLS --}}
                <div class="job-card" style="margin-top:24px;">

                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                    <p class="hero-card-label" style="color:var(--jade); margin-bottom:0;">Dokumen</p>
                    <label for="documentInput" class="link-viewall" style="cursor:pointer;">
                        <span class="material-icons-round" style="font-size:16px;">add</span>
                        Tambah
                    </label>
                </div>

                <form id="documentForm" style="display:contents;">
                    @csrf
                    <input type="file" id="documentInput" name="document" accept=".pdf,.doc,.docx" hidden>
                </form>

                <div class="doc-list" id="docList">
                    @forelse($user->documents as $document)
                        <div class="doc-item" data-id="{{ $document->id }}">
                            <div class="doc-item-info">
                                <span class="material-icons-round" style="color:var(--rust);">{{ $document->icon }}</span>
                                <span>{{ $document->name }}</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <a href="{{ $document->url }}" target="_blank" class="material-icons-round doc-item-view" style="font-size:16px;">visibility</a>
                                <span class="material-icons-round" style="cursor:pointer; color:var(--rust); font-size:16px;" data-delete-id="{{ $document->id }}">delete</span>
                            </div>
                        </div>
                    @empty
                        <p class="profile-stat-note" id="docEmptyNote">Belum ada dokumen yang diunggah.</p>
                    @endforelse
                </div>

            </div>

            </aside>

            {{-- ================= MAIN ================= --}}
            <section class="profile-main">

                {{-- STATS --}}
<div class="profile-stats">

    <div class="job-card profile-stat-card">
        <div class="stat-icon" style="margin:0 0 14px; background:rgba(77,184,212,0.12);">
            <span class="material-icons-round" style="color:var(--mint);">description</span>
        </div>
        <p class="job-company" style="margin-bottom:2px;">Lamaran</p>
        <h3 class="job-title" style="margin-bottom:10px;">{{ $totalLamaran }}</h3>
        <p class="profile-stat-note">
            @if($totalLamaran > 0)
                Total lamaran yang sudah kamu kirim.
            @else
                Belum ada lamaran terkirim. <a href="{{ route('lowongan.pekerjaan') }}">Cari lowongan</a>
            @endif
        </p>
    </div>

    <div class="job-card profile-stat-card">
        <div class="stat-icon" style="margin:0 0 14px; background:rgba(238,21,42,0.1);">
            <span class="material-icons-round" style="color:var(--amber);">schedule</span>
        </div>
        <p class="job-company" style="margin-bottom:2px;">Interview</p>
        <h3 class="job-title" style="margin-bottom:10px;">{{ $totalInterview }}</h3>
        <p class="profile-stat-note">
            @if($totalInterview > 0)
                Kamu dipanggil interview untuk {{ $totalInterview }} lowongan.
            @else
                Jadwal interview akan muncul di sini.
            @endif
        </p>
    </div>

    <div class="job-card profile-stat-card">
        <div class="stat-icon" style="margin:0 0 14px; background:rgba(0,75,95,0.1);">
            <span class="material-icons-round" style="color:var(--forest);">check_circle</span>
        </div>
        <p class="job-company" style="margin-bottom:2px;">Diterima</p>
        <h3 class="job-title" style="margin-bottom:10px;">{{ $totalDiterima }}</h3>
        <p class="profile-stat-note">
            @if($totalDiterima > 0)
                Selamat! Kamu diterima di {{ $totalDiterima }} perusahaan.
            @else
                Lengkapi profil untuk peluang lebih besar.
            @endif
        </p>
    </div>

</div>

                {{-- PERSONAL DATA --}}
                <div class="job-card" id="dataPribadiCard" style="margin-top:24px; padding:32px;">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:26px; padding-bottom:18px; border-bottom:1px solid var(--sand);">
        <h2 class="job-title" style="margin-bottom:0;">Data Pribadi</h2>

        <a href="#" id="editDataBtn" class="link-viewall">
            <span class="material-icons-round" style="font-size:16px;">edit</span>
            Ubah Data
        </a>

        <div id="editDataActions" style="display:none; gap:12px;">
            <a href="#" id="cancelDataBtn" class="link-viewall" style="color:var(--charcoal); opacity:0.6;">
                Batal
            </a>
            <a href="#" id="saveDataBtn" class="link-viewall">
                <span class="material-icons-round" style="font-size:16px;">check</span>
                Simpan
            </a>
        </div>
    </div>

    <form id="dataPribadiForm">
        @csrf
        @method('PATCH')

        <div class="profile-data-grid">

            <div class="profile-data-item">
                <span class="material-icons-round">badge</span>
                <div style="width:100%;">
                    <p>Nama</p>
                    <strong class="data-view" data-field="name">{{ $user->name }}</strong>
                    <input type="text" name="name" class="data-edit" value="{{ $user->name }}"
                           style="display:none; width:100%; padding:6px 10px; border:1px solid var(--sand); border-radius:8px; font-size:0.9rem;">
                </div>
            </div>

            <div class="profile-data-item">
                <span class="material-icons-round">mail</span>
                <div style="width:100%;">
                    <p>Email</p>
                    <strong class="data-view" data-field="email">{{ $user->email }}</strong>
                    <input type="email" name="email" class="data-edit" value="{{ $user->email }}"
                           style="display:none; width:100%; padding:6px 10px; border:1px solid var(--sand); border-radius:8px; font-size:0.9rem;">
                </div>
            </div>

            <div class="profile-data-item">
                <span class="material-icons-round">call</span>
                <div style="width:100%;">
                    <p>No HP</p>
                    <strong class="data-view" data-field="phone">{{ $user->phone ?? 'Belum diisi' }}</strong>
                    <input type="text" name="phone" class="data-edit" value="{{ $user->phone }}" placeholder="08xxxxxxxxxx"
                           style="display:none; width:100%; padding:6px 10px; border:1px solid var(--sand); border-radius:8px; font-size:0.9rem;">
                </div>
            </div>

            <div class="profile-data-item">
                <span class="material-icons-round">location_on</span>
                <div style="width:100%;">
                    <p>Alamat</p>
                    <strong class="data-view" data-field="address">{{ $user->address ?? 'Belum diisi' }}</strong>
                    <input type="text" name="address" class="data-edit" value="{{ $user->address }}"
                           style="display:none; width:100%; padding:6px 10px; border:1px solid var(--sand); border-radius:8px; font-size:0.9rem;">
                </div>
            </div>

            @if($user->isPerusahaan())
            <div class="profile-data-item">
                <span class="material-icons-round">apartment</span>
                <div style="width:100%;">
                    <p>Nama Perusahaan</p>
                    <strong class="data-view" data-field="company_name">{{ $user->company_name ?? 'Belum diisi' }}</strong>
                    <input type="text" name="company_name" class="data-edit" value="{{ $user->company_name }}"
                           style="display:none; width:100%; padding:6px 10px; border:1px solid var(--sand); border-radius:8px; font-size:0.9rem;">
                </div>
            </div>

            <div class="profile-data-item">
                <span class="material-icons-round">language</span>
                <div style="width:100%;">
                    <p>Website Perusahaan</p>
                    <strong class="data-view" data-field="company_website">{{ $user->company_website ?? 'Belum diisi' }}</strong>
                    <input type="url" name="company_website" class="data-edit" value="{{ $user->company_website }}" placeholder="https://..."
                           style="display:none; width:100%; padding:6px 10px; border:1px solid var(--sand); border-radius:8px; font-size:0.9rem;">
                </div>
            </div>
            @endif

        </div>
    </form>

</div>
                {{-- CTA --}}
                <div class="cta-band" style="margin-top:24px; border-radius:20px; padding:64px 40px;">
                    <div class="cta-band-inner">
                        <h2 class="cta-title" style="font-size:clamp(1.5rem,2.5vw,2rem);">Temukan Peluang Pertamamu</h2>
                        <p class="cta-desc">Lengkapi profil Anda untuk mendapatkan rekomendasi pekerjaan terbaik.</p>
                       <div class="cta-btns">
                            <a href="{{ route('lowongan.pekerjaan') }}" class="btn-cta-dark" style="text-decoration:none;">
                                Explore Careers
                            </a>
                        </div>
                    </div>
                </div>

            </section>

        </div>

    </div>
</main>

<x-footer />

<script>
    (function () {
        const skeleton = document.getElementById('profileSkeleton');
        const content = document.getElementById('profileContent');
        const avatarImg = document.getElementById('avatarPreviewImg');

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
    })();
</script>

<script>
    (function () {
        const input = document.getElementById('avatarInput');
        const img = document.getElementById('avatarPreviewImg');
        const loading = document.getElementById('avatarLoading');
        const form = document.getElementById('avatarForm');
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
    })();
</script>

<script>
    (function () {
        const documentInput = document.getElementById('documentInput');
        const docList = document.getElementById('docList');
        const csrfToken = document.querySelector('#documentForm input[name="_token"]').value;

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

            fetch("{{ route('dokumen.store') }}", {
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

            fetch(`/profil/dokumen/${btn.dataset.deleteId}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
            })
                .then(res => { if (!res.ok) throw new Error(); btn.closest('.doc-item').remove(); })
                .catch(() => alert('Gagal menghapus dokumen, silakan coba lagi.'));
        });
    })();

    (function () {
        const skillList = document.getElementById('skillList');
        const skillInput = document.getElementById('skillInput');
        const skillAddBtn = document.getElementById('skillAddBtn');
        const csrfToken = document.querySelector('#documentForm input[name="_token"]').value;

        function skillTagHtml(skill) {
            return `
                <span class="skill-tag" data-skill="${skill}">
                    ${skill}
                    <span class="material-icons-round skill-tag-remove" style="font-size:14px; cursor:pointer; margin-left:4px; vertical-align:middle;">close</span>
                </span>`;
        }

        function addSkill() {
            const value = skillInput.value.trim();
            if (!value || skillList.querySelector(`[data-skill="${value}"]`)) return;

            fetch("{{ route('skills.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ skill: value }),
            })
                .then(res => { if (!res.ok) throw new Error(); })
                .then(() => {
                    skillList.insertAdjacentHTML('beforeend', skillTagHtml(value));
                    skillInput.value = '';
                })
                .catch(() => alert('Gagal menambah keahlian, silakan coba lagi.'));
        }

        skillAddBtn.addEventListener('click', addSkill);
        skillInput.addEventListener('keydown', e => {
            if (e.key === 'Enter') { e.preventDefault(); addSkill(); }
        });

        skillList.addEventListener('click', function (e) {
            if (!e.target.classList.contains('skill-tag-remove')) return;

            const tag = e.target.closest('.skill-tag');
            const skill = tag.dataset.skill;

            fetch("{{ route('skills.remove') }}", {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ skill }),
            })
                .then(res => { if (!res.ok) throw new Error(); tag.remove(); })
                .catch(() => alert('Gagal menghapus keahlian, silakan coba lagi.'));
        });
    })();
</script>

<script>
(function () {
    const card = document.getElementById('dataPribadiCard');
    const form = document.getElementById('dataPribadiForm');
    const editBtn = document.getElementById('editDataBtn');
    const actions = document.getElementById('editDataActions');
    const cancelBtn = document.getElementById('cancelDataBtn');
    const saveBtn = document.getElementById('saveDataBtn');
    const csrfToken = form.querySelector('input[name="_token"]').value;

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

        fetch("{{ route('profil.update') }}", {
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
})();
</script>

</body>
</html>