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

    {{-- Data route Laravel untuk dibaca oleh pelamar.js (file JS statis
         tidak bisa memanggil route() langsung) --}}
    <script>
        window.PROFIL_ROUTES = {
            avatarUpdate: "{{ route('profil.foto.update') }}",
            documentStore: "{{ route('dokumen.store') }}",
            documentDeleteBase: "{{ url('profil/dokumen') }}",
            profilUpdate: "{{ route('profil.update') }}",
        };
    </script>

    {{-- Main CSS + Page-specific CSS/JS --}}
    @vite(['resources/css/app.css', 'resources/css/pelamar.css', 'resources/js/app.js', 'resources/js/pelamar.js'])
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
        <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:14px;">
            <div class="stat-icon" style="margin:0; background:rgba(238,21,42,0.1);">
                <span class="material-icons-round" style="color:var(--amber);">schedule</span>
            </div>
            @if($totalInterview > 0)
                <a href="{{ route('interview.jadwal') }}" class="profile-stat-cta">
                    Lihat Jadwal
                    <span class="material-icons-round">arrow_forward</span>
                </a>
            @endif
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
        <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:14px;">
            <div class="stat-icon" style="margin:0; background:rgba(0,75,95,0.1);">
                <span class="material-icons-round" style="color:var(--forest);">campaign</span>
            </div>
            @if($totalDiterima > 0)
                <a href="{{ route('pengumuman.interview') }}" class="profile-stat-cta">
                    Lihat Pengumuman
                    <span class="material-icons-round">arrow_forward</span>
                </a>
            @endif
        </div>
        <p class="job-company" style="margin-bottom:2px;">Pengumuman</p>
        <h3 class="job-title" style="margin-bottom:10px;">{{ $totalDiterima }}</h3>
        <p class="profile-stat-note">
            @if($totalDiterima > 0)
                Ada {{ $totalDiterima }} hasil pengumuman interview untukmu.
            @else
                Hasil interview akan muncul di sini.
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

</body>
</html>