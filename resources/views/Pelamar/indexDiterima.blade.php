<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Selamat, Kamu Diterima! | Sumatra Career Centre</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@600;700;900&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet" />

    {{-- Main CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hasil-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 32px;
            font-size: 0.8125rem;
        }
        .hasil-breadcrumb a {
            color: var(--charcoal);
            opacity: 0.6;
            text-decoration: none;
        }
        .hasil-breadcrumb a:hover { opacity: 1; }
        .hasil-breadcrumb .material-icons-round { font-size: 15px; opacity: 0.35; }
        .hasil-breadcrumb span.current { font-weight: 600; }

        /* HERO */
        .hasil-hero {
            text-align: center;
            padding: 56px 32px 48px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(0,75,95,0.06) 0%, rgba(0,75,95,0.015) 100%);
            border: 1px solid rgba(0,75,95,0.18);
            margin-bottom: 40px;
        }
        .hasil-hero-badge {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: var(--forest);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 12px 28px rgba(0,75,95,0.25);
        }
        .hasil-hero-badge .material-icons-round {
            font-size: 44px;
            color: #fff;
        }
        .hasil-hero-eyebrow {
            font-family: 'DM Mono', monospace;
            font-size: 0.75rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--forest);
            margin-bottom: 10px;
        }
        .hasil-hero h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 2.1rem;
            margin-bottom: 12px;
        }
        .hasil-hero p {
            max-width: 480px;
            margin: 0 auto;
            opacity: 0.75;
            line-height: 1.6;
        }

        /* JOB SUMMARY */
        .hasil-job-summary {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border: 1px solid var(--sand);
            border-radius: 16px;
            background: #fff;
            margin-bottom: 40px;
        }
        .hasil-job-summary .stat-icon {
            margin: 0;
            flex-shrink: 0;
        }

        /* STEPS */
        .hasil-steps-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--jade);
            margin: 0 0 18px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .hasil-steps-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sand);
        }
        .hasil-steps {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 40px;
        }
        .hasil-step {
            display: flex;
            gap: 18px;
            padding: 20px 22px;
            border: 1px solid var(--sand);
            border-radius: 16px;
            background: #fff;
        }
        .hasil-step-number {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--charcoal);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Mono', monospace;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .hasil-step-title {
            font-weight: 700;
            margin-bottom: 4px;
        }
        .hasil-step-desc {
            font-size: 0.875rem;
            opacity: 0.7;
            line-height: 1.55;
        }

        /* NOTE / DEADLINE */
        .hasil-deadline {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 18px 20px;
            border-radius: 14px;
            background: rgba(238, 170, 21, 0.08);
            border: 1px solid rgba(238, 170, 21, 0.35);
            margin-bottom: 40px;
        }
        .hasil-deadline .material-icons-round {
            color: var(--amber);
            flex-shrink: 0;
        }
        .hasil-deadline p { font-size: 0.875rem; line-height: 1.55; opacity: 0.85; }
        .hasil-deadline strong { display: block; margin-bottom: 3px; }

        /* CTA */
        .hasil-cta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: center;
        }
    </style>
</head>

<body style="background:var(--cream); font-family:'DM Sans',sans-serif; color:var(--charcoal);">

<x-navbar />

<main class="section" style="padding-top:110px; padding-bottom:100px;">
    <div class="section-inner" style="max-width:720px;">

        <div class="hasil-breadcrumb">
            <a href="{{ route('profil.saya') }}">Profil Saya</a>
            <span class="material-icons-round">chevron_right</span>
            <a href="{{ route('pengumuman.interview') }}">Pengumuman Interview</a>
            <span class="material-icons-round">chevron_right</span>
            <span class="current">Diterima</span>
        </div>

        {{-- HERO --}}
        <div class="hasil-hero">
            <div class="hasil-hero-badge">
                <span class="material-icons-round">celebration</span>
            </div>
            <div class="hasil-hero-eyebrow">Kabar Baik</div>
            <h1>Selamat, {{ auth()->user()->name ?? 'Kamu' }}! Kamu Diterima 🎉</h1>
            <p>
                Kerja kerasmu selama proses seleksi membuahkan hasil. Perusahaan sudah memutuskan
                untuk mengajakmu bergabung. Ikuti langkah-langkah di bawah supaya proses onboarding berjalan lancar.
            </p>
        </div>

        {{-- JOB SUMMARY --}}
        <div class="hasil-job-summary">
            <div class="stat-icon" style="background:rgba(0,75,95,0.1);">
                <span class="material-icons-round" style="color:var(--forest);">work</span>
            </div>
            <div>
                <p class="job-company" style="margin-bottom:2px;">
                    {{ $item->lowongan->perusahaan->nama_perusahaan ?? '-' }}
                </p>
                <h3 class="job-title" style="font-size:1.1rem; margin-bottom:0;">
                    {{ $item->lowongan->judul_lowongan ?? 'Lowongan' }}
                </h3>
            </div>
        </div>

        {{-- LANGKAH SELANJUTNYA --}}
        <p class="hasil-steps-label">Langkah Selanjutnya</p>
        <div class="hasil-steps">
            <div class="hasil-step">
                <div class="hasil-step-number">1</div>
                <div>
                    <p class="hasil-step-title">Konfirmasi Kesediaan</p>
                    <p class="hasil-step-desc">Balas email atau hubungi HR perusahaan untuk mengonfirmasi bahwa kamu menerima tawaran ini, paling lambat sesuai tenggat yang diberikan.</p>
                </div>
            </div>
            <div class="hasil-step">
                <div class="hasil-step-number">2</div>
                <div>
                    <p class="hasil-step-title">Siapkan Dokumen Administrasi</p>
                    <p class="hasil-step-desc">Siapkan KTP, ijazah, transkrip nilai, NPWP, rekening bank, dan dokumen lain yang biasanya diminta untuk proses onboarding karyawan baru.</p>
                </div>
            </div>
            <div class="hasil-step">
                <div class="hasil-step-number">3</div>
                <div>
                    <p class="hasil-step-title">Tunggu Info Jadwal Mulai Kerja (Onboarding)</p>
                    <p class="hasil-step-desc">Perusahaan akan menghubungimu untuk memberi tahu tanggal mulai kerja, lokasi, dan hal-hal teknis lainnya melalui kontak yang kamu daftarkan.</p>
                </div>
            </div>
            <div class="hasil-step">
                <div class="hasil-step-number">4</div>
                <div>
                    <p class="hasil-step-title">Perbarui Status Lamaranmu</p>
                    <p class="hasil-step-desc">Tandai lamaran lain yang masih berjalan supaya kamu bisa fokus mempersiapkan diri untuk posisi barumu ini.</p>
                </div>
            </div>
        </div>

        @if($item->catatan_interview)
            <div class="hasil-deadline">
                <span class="material-icons-round">info</span>
                <p>
                    <strong>Catatan dari Perusahaan</strong>
                    {{ $item->catatan_interview }}
                </p>
            </div>
        @endif

        {{-- CTA --}}
        <div class="hasil-cta-row">
            @if($item->lowongan)
                <a href="{{ route('detail.lowongan.pekerjaan', $item->lowongan->id) }}" class="btn-cta-dark" style="text-decoration:none;">
                    Lihat Detail Lowongan
                </a>
            @endif
            <a href="{{ route('pengumuman.interview') }}" class="link-viewall">
                <span class="material-icons-round" style="font-size:16px;">arrow_back</span>
                Kembali ke Pengumuman
            </a>
        </div>

    </div>
</main>

<x-footer />

</body>
</html>