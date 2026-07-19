<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jadwal Interview Saya | Sumatra Career Centre</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@600;700;900&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet" />

    {{-- Main CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* BREADCRUMB */
        .interview-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 18px;
            font-size: 0.8125rem;
        }
        .interview-breadcrumb a {
            color: var(--charcoal);
            opacity: 0.6;
            text-decoration: none;
        }
        .interview-breadcrumb a:hover { opacity: 1; }
        .interview-breadcrumb .material-icons-round {
            font-size: 15px;
            opacity: 0.35;
        }
        .interview-breadcrumb span.current {
            font-weight: 600;
        }

        /* FILTER TABS */
        .interview-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 32px 0 36px;
        }
        .interview-tab {
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
        .interview-tab:hover { border-color: var(--jade); }
        .interview-tab.is-active {
            background: var(--charcoal);
            border-color: var(--charcoal);
            color: #fff;
        }
        .interview-tab .count {
            opacity: 0.55;
            font-family: 'DM Mono', monospace;
            font-size: 0.75rem;
        }
        .interview-tab.is-active .count { opacity: 0.8; }

        /* GROUP LABEL */
        .interview-group-label {
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
        .interview-group-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sand);
        }
        .interview-group:first-of-type .interview-group-label { margin-top: 0; }

        /* TIMELINE */
        .interview-timeline {
            position: relative;
        }
        .interview-timeline-item {
            display: flex;
            gap: 20px;
            position: relative;
        }
        .interview-timeline-item:not(:last-child) {
            padding-bottom: 22px;
        }
        .interview-timeline-rail {
            flex-shrink: 0;
            width: 56px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .interview-timeline-date {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: var(--charcoal);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            line-height: 1;
            flex-shrink: 0;
        }
        .interview-timeline-day {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.35rem;
        }
        .interview-timeline-month {
            font-family: 'DM Mono', monospace;
            font-size: 0.625rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            opacity: 0.75;
            margin-top: 3px;
        }
        .interview-timeline-line {
            flex: 1;
            width: 1px;
            background: var(--sand);
            margin-top: 8px;
            min-height: 12px;
        }
        .interview-timeline-item:last-child .interview-timeline-line { display: none; }

        .interview-timeline-card {
            flex: 1;
            min-width: 0;
            border: 1px solid var(--sand);
            border-radius: 16px;
            padding: 22px 24px;
            background: #fff;
        }
        .interview-timeline-card.is-today {
            border-color: var(--amber);
            background: rgba(238, 21, 42, 0.03);
        }
        .interview-timeline-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }
        .interview-timeline-detail {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8125rem;
            color: var(--charcoal);
            opacity: 0.8;
            margin-top: 6px;
        }
        .interview-timeline-detail .material-icons-round {
            font-size: 16px;
            color: var(--jade);
        }
        .interview-timeline-note {
            margin-top: 12px;
            padding: 10px 12px;
            background: var(--cream);
            border-radius: 10px;
            font-size: 0.8125rem;
            color: var(--charcoal);
            opacity: 0.85;
        }
        .interview-timeline-actions {
            display: flex;
            gap: 18px;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--sand);
        }
        .interview-timeline-actions a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--forest);
            text-decoration: none;
        }
        .interview-timeline-actions a:hover { color: var(--jade); }
        .interview-timeline-actions .material-icons-round { font-size: 15px; }

        /* PENDING LIST */
        .interview-pending-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .interview-pending-item {
            display: flex;
            gap: 16px;
            padding: 20px;
            border: 1px dashed var(--sand);
            border-radius: 16px;
        }
        .interview-pending-icon {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--cream);
        }
        .interview-pending-icon .material-icons-round { color: var(--charcoal); opacity: 0.5; }
        .interview-pending-status {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8125rem;
            color: var(--charcoal);
            opacity: 0.6;
            margin-top: 6px;
        }
        .interview-pending-status .material-icons-round { font-size: 16px; }

        /* EMPTY STATE */
        .interview-empty {
            text-align: center;
            padding: 80px 24px;
            border: 1px dashed var(--sand);
            border-radius: 20px;
        }
        .interview-empty .material-icons-round {
            font-size: 44px;
            color: var(--sand);
            margin-bottom: 16px;
        }
        .interview-empty h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            margin-bottom: 8px;
        }
        .interview-empty p {
            opacity: 0.65;
            max-width: 380px;
            margin: 0 auto 24px;
        }

        @media (max-width: 640px) {
            .interview-timeline-rail { width: 46px; }
            .interview-timeline-date { width: 46px; height: 46px; border-radius: 12px; }
            .interview-timeline-day { font-size: 1.1rem; }
        }
    </style>
</head>

<body style="background:var(--cream); font-family:'DM Sans',sans-serif; color:var(--charcoal);">

<x-navbar />

<main class="section" style="padding-top:110px; padding-bottom:100px;">
    <div class="section-inner" style="max-width:840px;">

        <div class="interview-breadcrumb">
            <a href="{{ route('profil.saya') }}">Profil Saya</a>
            <span class="material-icons-round">chevron_right</span>
            <span class="current">Jadwal Interview</span>
        </div>

        <div class="section-eyebrow">Perjalanan Karier Anda</div>
        <h1 class="section-title" style="margin-bottom:12px;">Jadwal Interview Saya</h1>
        <p style="max-width:520px; opacity:0.7; line-height:1.6;">
            Semua panggilan interview yang kamu terima, disusun berdasarkan waktu supaya tidak ada satu pun yang terlewat.
        </p>

        @php
            $scheduled = $jadwalInterviews->filter(fn($l) => $l->jadwal_interview)->sortBy('jadwal_interview')->values();
            $pending   = $jadwalInterviews->reject(fn($l) => $l->jadwal_interview)->values();

            $groups = [
                'Hari Ini'    => $scheduled->filter(fn($l) => $l->jadwal_interview->isToday()),
                'Minggu Ini'  => $scheduled->filter(fn($l) => !$l->jadwal_interview->isToday() && $l->jadwal_interview->isFuture() && $l->jadwal_interview->diffInDays(now()) <= 7),
                'Mendatang'   => $scheduled->filter(fn($l) => !$l->jadwal_interview->isToday() && $l->jadwal_interview->isFuture() && $l->jadwal_interview->diffInDays(now()) > 7),
                'Sudah Lewat' => $scheduled->filter(fn($l) => $l->jadwal_interview->isPast() && !$l->jadwal_interview->isToday()),
            ];
        @endphp

        {{-- SUMMARY --}}
        <div class="profile-stats" style="margin-top:36px;">
            <div class="job-card profile-stat-card">
                <div class="stat-icon" style="margin:0 0 14px; background:rgba(238,21,42,0.1);">
                    <span class="material-icons-round" style="color:var(--amber);">event</span>
                </div>
                <p class="job-company" style="margin-bottom:2px;">Total Panggilan</p>
                <h3 class="job-title" style="margin-bottom:0;">{{ $jadwalInterviews->count() }}</h3>
            </div>
            <div class="job-card profile-stat-card">
                <div class="stat-icon" style="margin:0 0 14px; background:rgba(0,75,95,0.1);">
                    <span class="material-icons-round" style="color:var(--forest);">event_available</span>
                </div>
                <p class="job-company" style="margin-bottom:2px;">Sudah Terjadwal</p>
                <h3 class="job-title" style="margin-bottom:0;">{{ $scheduled->count() }}</h3>
            </div>
            <div class="job-card profile-stat-card">
                <div class="stat-icon" style="margin:0 0 14px; background:rgba(120,120,120,0.12);">
                    <span class="material-icons-round" style="color:var(--charcoal);">hourglass_empty</span>
                </div>
                <p class="job-company" style="margin-bottom:2px;">Menunggu Jadwal</p>
                <h3 class="job-title" style="margin-bottom:0;">{{ $pending->count() }}</h3>
            </div>
        </div>

        {{-- FILTER TABS --}}
        <div class="interview-tabs" id="interviewTabs">
            <button type="button" class="interview-tab is-active" data-filter="all">
                Semua <span class="count">{{ $jadwalInterviews->count() }}</span>
            </button>
            <button type="button" class="interview-tab" data-filter="scheduled">
                Terjadwal <span class="count">{{ $scheduled->count() }}</span>
            </button>
            <button type="button" class="interview-tab" data-filter="pending">
                Menunggu <span class="count">{{ $pending->count() }}</span>
            </button>
        </div>

        {{-- CONTENT --}}
        @if($jadwalInterviews->isEmpty())

            <div class="interview-empty">
                <span class="material-icons-round">event_busy</span>
                <h3>Belum Ada Jadwal Interview</h3>
                <p>Terus lamar posisi yang cocok dan pantau halaman ini — jadwal interview akan muncul begitu perusahaan menghubungimu.</p>
                <a href="{{ route('lowongan.pekerjaan') }}" class="btn-cta-dark" style="text-decoration:none;">Cari Lowongan</a>
            </div>

        @else

            {{-- TIMELINE GROUPS --}}
            @foreach($groups as $label => $items)
                @if($items->isNotEmpty())
                    <div class="interview-group" data-status="scheduled">
                        <p class="interview-group-label">{{ $label }} &middot; {{ $items->count() }}</p>

                        <div class="interview-timeline">
                            @foreach($items as $lamaran)
                                <div class="interview-timeline-item" data-status="scheduled">
                                    <div class="interview-timeline-rail">
                                        <div class="interview-timeline-date">
                                            <span class="interview-timeline-day">{{ $lamaran->jadwal_interview->format('d') }}</span>
                                            <span class="interview-timeline-month">{{ $lamaran->jadwal_interview->translatedFormat('M') }}</span>
                                        </div>
                                        <div class="interview-timeline-line"></div>
                                    </div>

                                    <div class="interview-timeline-card {{ $lamaran->jadwal_interview->isToday() ? 'is-today' : '' }}">
                                        <div class="interview-timeline-top">
                                            <div>
                                                <p class="job-company" style="margin-bottom:2px;">
                                                    {{ $lamaran->lowongan->perusahaan->nama_perusahaan ?? '-' }}
                                                </p>
                                                <h3 class="job-title" style="font-size:1.05rem; margin-bottom:0;">
                                                    {{ $lamaran->lowongan->judul_lowongan ?? '-' }}
                                                </h3>
                                            </div>
                                            <span class="tag {{ $lamaran->jadwal_interview->isPast() ? 'tag-type' : 'tag-active' }}">
                                                {{ $lamaran->jadwal_interview->isPast() ? 'Selesai' : 'Terjadwal' }}
                                            </span>
                                        </div>

                                        <div class="interview-timeline-detail">
                                            <span class="material-icons-round">schedule</span>
                                            <span>
                                                {{ $lamaran->jadwal_interview->translatedFormat('l, d F Y') }}
                                                &middot;
                                                {{ $lamaran->jadwal_interview->format('H:i') }} WIB
                                            </span>
                                        </div>

                                        @if($lamaran->lokasi_interview)
                                            <div class="interview-timeline-detail">
                                                <span class="material-icons-round">location_on</span>
                                                <span>{{ $lamaran->lokasi_interview }}</span>
                                            </div>
                                        @endif

                                        @if($lamaran->catatan_interview)
                                            <div class="interview-timeline-note">{{ $lamaran->catatan_interview }}</div>
                                        @endif

                                        <div class="interview-timeline-actions">
                                            @if($lamaran->lowongan)
                                                <a href="{{ route('detail.lowongan.pekerjaan', $lamaran->lowongan->id) }}">
                                                    <span class="material-icons-round">work_outline</span>
                                                    Lihat Lowongan
                                                </a>
                                            @endif
                                            @if($lamaran->jadwal_interview->isFuture())
                                                <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Interview - ' . ($lamaran->lowongan->judul_lowongan ?? '')) }}&dates={{ $lamaran->jadwal_interview->format('Ymd\THis') }}/{{ $lamaran->jadwal_interview->copy()->addHour()->format('Ymd\THis') }}&location={{ urlencode($lamaran->lokasi_interview ?? '') }}" target="_blank" rel="noopener">
                                                    <span class="material-icons-round">calendar_month</span>
                                                    Tambah ke Kalender
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            {{-- PENDING --}}
            @if($pending->isNotEmpty())
                <div class="interview-group" data-status="pending">
                    <p class="interview-group-label">Menunggu Konfirmasi &middot; {{ $pending->count() }}</p>

                    <div class="interview-pending-list">
                        @foreach($pending as $lamaran)
                            <div class="interview-pending-item" data-status="pending">
                                <div class="interview-pending-icon">
                                    <span class="material-icons-round">hourglass_empty</span>
                                </div>
                                <div>
                                    <p class="job-company" style="margin-bottom:2px;">
                                        {{ $lamaran->lowongan->perusahaan->nama_perusahaan ?? '-' }}
                                    </p>
                                    <h3 class="job-title" style="font-size:1.05rem; margin-bottom:0;">
                                        {{ $lamaran->lowongan->judul_lowongan ?? '-' }}
                                    </h3>
                                    <div class="interview-pending-status">
                                        <span class="material-icons-round">info</span>
                                        Menunggu jadwal dari admin
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @endif

    </div>
</main>

<x-footer />

<script>
    (function () {
        const tabs = document.querySelectorAll('#interviewTabs .interview-tab');
        const groups = document.querySelectorAll('.interview-group');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                tabs.forEach(t => t.classList.remove('is-active'));
                this.classList.add('is-active');

                const filter = this.dataset.filter;

                groups.forEach(group => {
                    const match = filter === 'all' || group.dataset.status === filter;
                    group.style.display = match ? '' : 'none';
                });
            });
        });
    })();
</script>

</body>
</html>