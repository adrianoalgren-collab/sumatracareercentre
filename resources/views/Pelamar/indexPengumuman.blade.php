<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengumuman Interview | Sumatra Career Centre</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@600;700;900&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet" />

    {{-- Main CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* BREADCRUMB */
        .pengumuman-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 18px;
            font-size: 0.8125rem;
        }
        .pengumuman-breadcrumb a {
            color: var(--charcoal);
            opacity: 0.6;
            text-decoration: none;
        }
        .pengumuman-breadcrumb a:hover { opacity: 1; }
        .pengumuman-breadcrumb .material-icons-round {
            font-size: 15px;
            opacity: 0.35;
        }
        .pengumuman-breadcrumb span.current {
            font-weight: 600;
        }

        /* FILTER TABS */
        .pengumuman-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 32px 0 36px;
        }
        .pengumuman-tab {
            border: 1px solid var(--sand);
            background: #fff;
            padding: 9px 18px;
            border-radius: 30px;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--charcoal);
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .pengumuman-tab:hover { border-color: var(--jade); }
        .pengumuman-tab.is-active {
            background: var(--charcoal);
            border-color: var(--charcoal);
            color: #fff;
        }
        .pengumuman-tab .count {
            opacity: 0.55;
            font-family: 'DM Mono', monospace;
            font-size: 0.75rem;
        }
        .pengumuman-tab.is-active .count { opacity: 0.8; }

        /* GROUP LABEL */
        .pengumuman-group-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--jade);
            margin: 40px 0 18px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .pengumuman-group-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sand);
        }
        .pengumuman-group:first-of-type .pengumuman-group-label { margin-top: 0; }

        /* LIST */
        .pengumuman-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .pengumuman-card {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            border: 1px solid var(--sand);
            border-radius: 16px;
            padding: 22px 24px;
            background: #fff;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            transition: border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }
        .pengumuman-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 40, 30, 0.06);
        }
        .pengumuman-card.is-diterima {
            border-color: rgba(0,75,95,0.35);
            background: rgba(0,75,95,0.03);
        }
        .pengumuman-card.is-diterima:hover { border-color: var(--forest); }
        .pengumuman-card.is-ditolak {
            border-color: rgba(238,21,42,0.2);
        }
        .pengumuman-card.is-ditolak:hover { border-color: var(--rust); }
        .pengumuman-chevron {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            height: 48px;
            opacity: 0.35;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
        .pengumuman-card:hover .pengumuman-chevron {
            opacity: 0.8;
            transform: translateX(3px);
        }
        .pengumuman-icon {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pengumuman-body {
            flex: 1;
            min-width: 0;
        }
        .pengumuman-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }
        .pengumuman-detail {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8125rem;
            color: var(--charcoal);
            opacity: 0.8;
            margin-top: 6px;
        }
        .pengumuman-detail .material-icons-round {
            font-size: 16px;
            color: var(--jade);
        }
        .pengumuman-note {
            margin-top: 12px;
            padding: 10px 12px;
            background: var(--cream);
            border-radius: 10px;
            font-size: 0.8125rem;
            color: var(--charcoal);
            opacity: 0.85;
        }
        .pengumuman-actions {
            display: flex;
            gap: 18px;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--sand);
        }
        .pengumuman-actions a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--forest);
            text-decoration: none;
        }
        .pengumuman-actions a:hover { color: var(--jade); }
        .pengumuman-actions .material-icons-round { font-size: 15px; }

        /* EMPTY STATE */
        .pengumuman-empty {
            text-align: center;
            padding: 80px 24px;
            border: 1px dashed var(--sand);
            border-radius: 20px;
        }
        .pengumuman-empty .material-icons-round {
            font-size: 44px;
            color: var(--sand);
            margin-bottom: 16px;
        }
        .pengumuman-empty h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            margin-bottom: 8px;
        }
        .pengumuman-empty p {
            opacity: 0.65;
            max-width: 380px;
            margin: 0 auto 24px;
        }

        @media (max-width: 640px) {
            .pengumuman-card { flex-direction: column; }
            .pengumuman-top { flex-wrap: wrap; }
        }
    </style>
</head>

<body style="background:var(--cream); font-family:'DM Sans',sans-serif; color:var(--charcoal);">

<x-navbar />

<main class="section" style="padding-top:110px; padding-bottom:100px;">
    <div class="section-inner" style="max-width:840px;">

        <div class="pengumuman-breadcrumb">
            <a href="{{ route('profil.saya') }}">Profil Saya</a>
            <span class="material-icons-round">chevron_right</span>
            <span class="current">Pengumuman Interview</span>
        </div>

        <div class="section-eyebrow">Perjalanan Karier Anda</div>
        <h1 class="section-title" style="margin-bottom:12px;">Pengumuman Interview</h1>
        <p style="max-width:520px; opacity:0.7; line-height:1.6;">
            Semua hasil interview dari lowongan yang sudah kamu ikuti, supaya kamu tahu langkah selanjutnya.
        </p>

        @php
            $totalSemua = $totalDiterima + $totalDitolak;
        @endphp

        {{-- SUMMARY --}}
        <div class="profile-stats" style="margin-top:36px;">
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
                        Belum ada pengumuman diterima.
                    @endif
                </p>
            </div>
            <div class="job-card profile-stat-card">
                <div class="stat-icon" style="margin:0 0 14px; background:rgba(238,21,42,0.1);">
                    <span class="material-icons-round" style="color:var(--rust);">cancel</span>
                </div>
                <p class="job-company" style="margin-bottom:2px;">Tidak Lolos</p>
                <h3 class="job-title" style="margin-bottom:10px;">{{ $totalDitolak }}</h3>
                <p class="profile-stat-note">Tetap semangat, masih banyak peluang lain.</p>
            </div>
        </div>

        {{-- FILTER TABS --}}
        <div class="pengumuman-tabs" id="pengumumanTabs">
            <button type="button" class="pengumuman-tab is-active" data-filter="all">
                Semua <span class="count">{{ $totalSemua }}</span>
            </button>
            <button type="button" class="pengumuman-tab" data-filter="diterima">
                Diterima <span class="count">{{ $totalDiterima }}</span>
            </button>
            <button type="button" class="pengumuman-tab" data-filter="ditolak">
                Tidak Lolos <span class="count">{{ $totalDitolak }}</span>
            </button>
        </div>

        {{-- CONTENT --}}
        @if($pengumuman->isEmpty())

            <div class="pengumuman-empty">
                <span class="material-icons-round">campaign</span>
                <h3>Belum Ada Pengumuman</h3>
                <p>Hasil interview akan muncul di sini setelah perusahaan memberikan keputusan.</p>
                <a href="{{ route('lowongan.pekerjaan') }}" class="btn-cta-dark" style="text-decoration:none;">Cari Lowongan</a>
            </div>

        @else

            <div class="pengumuman-group" data-status="all">
                <p class="pengumuman-group-label">Hasil Interview &middot; {{ $pengumuman->count() }}</p>

                <div class="pengumuman-list">
                    @foreach($pengumuman as $item)
                        <a href="{{ route('pengumuman.detail', $item->id) }}" class="pengumuman-card is-{{ $item->status }}" data-status="{{ $item->status }}">
                            <div class="pengumuman-icon" style="background:{{ $item->status === 'diterima' ? 'rgba(0,75,95,0.1)' : 'rgba(238,21,42,0.1)' }};">
                                <span class="material-icons-round" style="color:{{ $item->status === 'diterima' ? 'var(--forest)' : 'var(--rust)' }};">
                                    {{ $item->status === 'diterima' ? 'check_circle' : 'cancel' }}
                                </span>
                            </div>

                            <div class="pengumuman-body">
                                <div class="pengumuman-top">
                                    <div>
                                        <p class="job-company" style="margin-bottom:2px;">
                                            {{ $item->lowongan->perusahaan->nama_perusahaan ?? '-' }}
                                        </p>
                                        <h3 class="job-title" style="font-size:1.05rem; margin-bottom:0;">
                                            {{ $item->lowongan->judul_lowongan ?? 'Lowongan' }}
                                        </h3>
                                    </div>
                                    <span class="tag {{ $item->status_tag_class }}">{{ $item->status_label }}</span>
                                </div>

                                @if($item->jadwal_interview)
                                    <div class="pengumuman-detail">
                                        <span class="material-icons-round">event</span>
                                        <span>{{ $item->jadwal_interview->translatedFormat('l, d F Y') }} &middot; {{ $item->jadwal_interview->format('H:i') }} WIB</span>
                                    </div>
                                @endif

                                @if($item->catatan_interview)
                                    <div class="pengumuman-note">{{ $item->catatan_interview }}</div>
                                @endif
                            </div>

                            <div class="pengumuman-chevron">
                                <span class="material-icons-round">chevron_right</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        @endif

        <div style="margin-top:32px;">
            <a href="{{ route('profil.saya') }}" class="link-viewall">
                <span class="material-icons-round" style="font-size:16px;">arrow_back</span>
                Kembali ke Profil
            </a>
        </div>

    </div>
</main>

<x-footer />

<script>
    (function () {
        const tabs = document.querySelectorAll('#pengumumanTabs .pengumuman-tab');
        const cards = document.querySelectorAll('.pengumuman-card');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                tabs.forEach(t => t.classList.remove('is-active'));
                this.classList.add('is-active');

                const filter = this.dataset.filter;

                cards.forEach(card => {
                    const match = filter === 'all' || card.dataset.status === filter;
                    card.style.display = match ? '' : 'none';
                });
            });
        });
    })();
</script>

</body>
</html>