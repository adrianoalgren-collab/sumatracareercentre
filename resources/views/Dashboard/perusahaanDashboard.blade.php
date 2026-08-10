@extends('layouts.app')

@section('content')

<div class="dashboard-wrapper">

    {{-- ═══════════════════════════════════════════════
         KARTU RINGKASAN
    ═══════════════════════════════════════════════ --}}
    <div class="stat-cards-grid stat-cards-grid--3">

        {{-- Skeleton --}}
        @for ($i = 0; $i < 3; $i++)
            <div class="stat-card-skel skeleton-block" data-skel-group="stats"></div>
        @endfor

        {{-- Real content --}}
        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="lowongan"><i class="fas fa-briefcase"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalLowonganAktif ?? 0 }}</span>
                <span class="stat-card-label">Lowongan Aktif</span>
            </div>
        </div>

        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="pelamar"><i class="fas fa-file-alt"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalPendaftar ?? 0 }}</span>
                <span class="stat-card-label">Total Pendaftar</span>
            </div>
        </div>

        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="interview"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalInterview ?? 0 }}</span>
                <span class="stat-card-label">Dijadwalkan Interview</span>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════
         DISTRIBUSI STATUS LAMARAN
    ═══════════════════════════════════════════════ --}}
    <div class="content-card">
        <h3 class="card-title">Distribusi Status Lamaran</h3>

        <div class="skel-list-row" data-skel-group="statuslamaran">
            <div class="skeleton-block" style="height:220px;"></div>
            <div class="skeleton-block" style="height:220px;"></div>
        </div>

        <div class="status-distribusi-wrap real-content" data-real-group="statuslamaran" style="display:none;">
            <div class="status-donut-wrap">
                <canvas id="chartStatusLamaran"></canvas>
                <div class="status-donut-center">
                    <span class="status-donut-total">{{ ($funnelMenunggu ?? 0) + ($funnelInterview ?? 0) + ($funnelDiterima ?? 0) + ($funnelDitolak ?? 0) }}</span>
                    <span class="status-donut-total-label">Total Lamaran</span>
                </div>
            </div>

            <div class="status-legend">
                <div class="status-legend-item" data-tone="menunggu">
                    <span class="status-legend-dot"></span>
                    <span class="status-legend-label">Menunggu</span>
                    <span class="status-legend-count">{{ $funnelMenunggu ?? 0 }}</span>
                </div>
                <div class="status-legend-item" data-tone="interview">
                    <span class="status-legend-dot"></span>
                    <span class="status-legend-label">Interview</span>
                    <span class="status-legend-count">{{ $funnelInterview ?? 0 }}</span>
                </div>
                <div class="status-legend-item" data-tone="diterima">
                    <span class="status-legend-dot"></span>
                    <span class="status-legend-label">Diterima</span>
                    <span class="status-legend-count">{{ $funnelDiterima ?? 0 }}</span>
                </div>
                <div class="status-legend-item" data-tone="ditolak">
                    <span class="status-legend-dot"></span>
                    <span class="status-legend-label">Ditolak</span>
                    <span class="status-legend-count">{{ $funnelDitolak ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-row">

        {{-- ═══════════════════════════════════════════════
             KALENDER INTERVIEW
        ═══════════════════════════════════════════════ --}}
        <div class="content-card dashboard-col-6">
            <h3 class="card-title">Jadwal Interview Mendatang</h3>

            <div class="skel-list" data-skel-group="kalender">
                @for ($i = 0; $i < 4; $i++)
                    <div class="skeleton-block" style="height:52px; margin-bottom:10px;"></div>
                @endfor
            </div>

            <div class="mini-list real-content" data-real-group="kalender" style="display:none;">
                @forelse($interviewMendatang ?? [] as $item)
                    <div class="mini-list-item">
                        <div class="interview-date-badge">
                            <span class="interview-date-day">{{ optional($item->jadwal_interview)->format('d') }}</span>
                            <span class="interview-date-month">{{ optional($item->jadwal_interview)->translatedFormat('M') }}</span>
                        </div>
                        <div class="mini-list-body">
                            <span class="mini-list-title">{{ $item->user->name ?? 'Pelamar' }}</span>
                            <span class="mini-list-sub">{{ $item->lowongan->judul_lowongan ?? '-' }} &middot; {{ optional($item->jadwal_interview)->format('H:i') }}</span>
                        </div>
                        <span class="status-tag {{ $item->status_tag_class ?? '' }}">{{ ucfirst($item->status ?? 'interview') }}</span>
                    </div>
                @empty
                    <p class="mini-list-empty">Tidak ada jadwal interview mendatang</p>
                @endforelse
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════
             ENGAGEMENT
        ═══════════════════════════════════════════════ --}}
        <div class="content-card dashboard-col-6">
            <h3 class="card-title">Engagement per Lowongan</h3>

            <div class="skel-list" data-skel-group="engagement">
                @for ($i = 0; $i < 4; $i++)
                    <div class="skeleton-block" style="height:52px; margin-bottom:10px;"></div>
                @endfor
            </div>

            <div class="mini-list real-content" data-real-group="engagement" style="display:none;">
                @forelse($lowonganEngagement ?? [] as $item)
                    <div class="mini-list-item">
                        <div class="mini-list-icon" data-tone="lowongan"><i class="fas fa-briefcase"></i></div>
                        <div class="mini-list-body">
                            <span class="mini-list-title">{{ $item->judul_lowongan }}</span>
                            <span class="mini-list-sub">Indikator minat pelamar</span>
                        </div>
                        <div class="engagement-badges">
                            <span class="engagement-badge" data-tone="komentar">
                                <i class="fas fa-comment-dots"></i> {{ $item->komentar_count ?? 0 }}
                            </span>
                            <span class="engagement-badge" data-tone="bookmark">
                                <i class="fas fa-bookmark"></i> {{ $item->bookmark_count ?? 0 }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="mini-list-empty">Belum ada data engagement</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════
         PER LOWONGAN
    ═══════════════════════════════════════════════ --}}
    <div class="content-card">
        <div class="card-title-row">
            <h3 class="card-title">Lowongan Saya</h3>
            @if (Route::has('perusahaan.lowongan.index'))
                <a href="{{ route('perusahaan.lowongan.index') }}" class="link-small">Lihat Semua</a>
            @endif
        </div>

        <div class="skel-list-row" data-skel-group="lowongancard">
            @for ($i = 0; $i < 3; $i++)
                <div class="skeleton-block" style="height:170px;"></div>
            @endfor
        </div>

        <div class="lowongan-card-grid real-content" data-real-group="lowongancard" style="display:none;">
            @forelse($lowonganList ?? [] as $item)
    <div class="lowongan-card">
        <div class="lowongan-card-top">
            <span class="lowongan-card-title">{{ $item->judul_lowongan }}</span>
            <span class="status-tag {{ $item->status_tag_class ?? '' }}">{{ ucfirst($item->status ?? '-') }}</span>
        </div>

        <div class="lowongan-card-metric">
            <div class="lowongan-card-metric-head">
                <span>Pendaftar</span>
                <span>{{ $item->total_pendaftar ?? 0 }} / {{ $item->jumlah_lowongan_dibuka > 0 ? $item->jumlah_lowongan_dibuka : '∞' }}</span>
            </div>
            <div class="lowongan-progress-track">
                <div class="lowongan-progress-fill" data-tone="kuota" style="width: {{ $item->persen_terisi }}%;"></div>
            </div>
        </div>

        <div class="lowongan-card-metric">
            <div class="lowongan-card-metric-head">
                <span>Deadline</span>
                <span>
                    @if ($item->sisa_hari !== null)
                        {{ $item->sisa_hari >= 0 ? $item->sisa_hari.' hari lagi' : 'Terlewat' }}
                    @else
                        -
                    @endif
                </span>
            </div>
            <div class="lowongan-progress-track">
                <div class="lowongan-progress-fill" data-tone="{{ $item->deadline_tone }}" style="width: {{ $item->persen_deadline }}%;"></div>
            </div>
        </div>

        <div class="lowongan-card-foot">
            <span class="engagement-badge" data-tone="komentar">
                <i class="fas fa-comment-dots"></i> {{ $item->komentar_count ?? 0 }}
            </span>
            <span class="engagement-badge" data-tone="bookmark">
                <i class="fas fa-bookmark"></i> {{ $item->bookmark_count ?? 0 }}
            </span>
            @if (Route::has('perusahaan.lowongan.show'))
                <a href="{{ route('perusahaan.lowongan.show', $item->id) }}" class="link-small" style="margin-left:auto;">Detail</a>
            @endif
        </div>
    </div>
@empty
    <p class="mini-list-empty">Belum ada lowongan yang diposting</p>
@endforelse
        </div>
    </div>

</div>

<style>
    :root {
        --c-green:  #2f8f6e;
        --c-teal:   #004b5f;
        --c-red:    #ee152a;
        --c-orange: #ff9e00;
        --c-blue:   #4db8d4;
        --c-purple: #6f42c1;
        --c-amber:  #f59f00;
        --c-gray:   #adb5bd;

        --text-dark:  #212529;
        --text-muted: #6c757d;
        --border-light: #f1f3f5;
        --bg-soft: #f8f9fa;
    }

    /* ===== LAYOUT ===== */
    .dashboard-wrapper { display: flex; flex-direction: column; gap: 20px; }

    .stat-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .dashboard-row {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 20px;
    }

    .dashboard-col-6 { grid-column: span 6; }

    @media (max-width: 900px) {
        .stat-cards-grid--3 { grid-template-columns: repeat(2, 1fr); }
        .dashboard-col-6 { grid-column: span 12; }
    }

    @media (max-width: 560px) {
        .stat-cards-grid--3 { grid-template-columns: 1fr; }
    }

    /* ===== CARD SHELL ===== */
    .content-card {
        background: #fff;
        border-radius: 14px;
        padding: 22px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    .card-title { font-size: 16px; font-weight: 600; color: var(--text-dark); margin: 0 0 16px; }

    .card-title-row {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 16px;
    }
    .card-title-row .card-title { margin: 0; }

    .link-small { font-size: 12.5px; color: var(--c-green); text-decoration: none; font-weight: 600; }
    .link-small:hover { text-decoration: underline; }

    /* ===== STAT CARDS ===== */
    .stat-card, .stat-card-skel {
        background: #fff;
        border-radius: 14px;
        padding: 22px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }

    .stat-card-skel { height: 84px; }

    .stat-card-icon {
        width: 52px; height: 52px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }

    .stat-card-icon[data-tone="pelamar"]   { background: rgba(47,143,110,.10); color: var(--c-green); }
    .stat-card-icon[data-tone="lowongan"]  { background: rgba(238,21,42,.10);  color: var(--c-red); }
    .stat-card-icon[data-tone="interview"] { background: rgba(77,184,212,.10); color: var(--c-blue); }

    .stat-card-body { display: flex; flex-direction: column; }
    .stat-card-number { font-size: 24px; font-weight: 700; color: var(--text-dark); }
    .stat-card-label { font-size: 12.5px; color: var(--text-muted); }

    /* ===== DISTRIBUSI STATUS LAMARAN (DONUT) ===== */
    .status-distribusi-wrap {
        display: flex;
        align-items: center;
        gap: 32px;
    }

    .status-donut-wrap {
        position: relative;
        width: 200px;
        height: 200px;
        flex-shrink: 0;
    }

    .status-donut-center {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .status-donut-total { font-size: 24px; font-weight: 700; color: var(--text-dark); line-height: 1.1; }
    .status-donut-total-label { font-size: 11px; color: var(--text-muted); margin-top: 2px; }

    .status-legend {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .status-legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 4px;
        border-bottom: 1px solid var(--border-light);
    }
    .status-legend-item:last-child { border-bottom: none; }

    .status-legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        flex-shrink: 0;
    }
    .status-legend-item[data-tone="menunggu"]  .status-legend-dot { background: var(--c-amber); }
    .status-legend-item[data-tone="interview"] .status-legend-dot { background: var(--c-blue); }
    .status-legend-item[data-tone="diterima"]  .status-legend-dot { background: var(--c-green); }
    .status-legend-item[data-tone="ditolak"]   .status-legend-dot { background: var(--c-red); }

    .status-legend-label { font-size: 13px; font-weight: 600; color: var(--text-dark); flex: 1; }
    .status-legend-count { font-size: 14px; font-weight: 700; color: var(--text-dark); }

    @media (max-width: 560px) {
        .status-distribusi-wrap { flex-direction: column; gap: 20px; }
    }

    /* ===== MINI LIST (shared) ===== */
    .mini-list-item {
        display: flex; align-items: center; gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid var(--border-light);
    }
    .mini-list-item:last-child { border-bottom: none; }

    .mini-list-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; flex-shrink: 0;
    }
    .mini-list-icon[data-tone="lowongan"] { background: rgba(238,21,42,.10); color: var(--c-red); }

    .mini-list-body { display: flex; flex-direction: column; flex: 1; min-width: 0; }
    .mini-list-title {
        font-size: 13.5px; font-weight: 600; color: var(--text-dark);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .mini-list-sub { font-size: 12px; color: var(--text-muted); }

    .mini-list-empty {
        text-align: center; padding: 20px 0;
        color: var(--text-muted); font-size: 13px;
    }

    /* ===== INTERVIEW DATE BADGE ===== */
    .interview-date-badge {
        flex-shrink: 0;
        width: 44px;
        border-radius: 10px;
        background: rgba(77,184,212,.10);
        color: var(--c-blue);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 6px 0;
        line-height: 1.1;
    }
    .interview-date-day { font-size: 16px; font-weight: 700; }
    .interview-date-month { font-size: 10px; text-transform: uppercase; font-weight: 600; }

    /* ===== STATUS TAG (fallback styling, di-override oleh accessor status_tag_class bila ada) ===== */
    .status-tag {
        flex-shrink: 0;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
        background: var(--bg-soft);
        color: var(--text-muted);
        text-transform: capitalize;
    }

    /* ===== ENGAGEMENT BADGES ===== */
    .engagement-badges { display: flex; gap: 8px; flex-shrink: 0; }
    .engagement-badge {
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .engagement-badge[data-tone="komentar"] { background: rgba(77,184,212,.10); color: var(--c-blue); }
    .engagement-badge[data-tone="bookmark"] { background: rgba(255,158,0,.10); color: var(--c-orange); }

    /* ===== LOWONGAN CARDS ===== */
    .lowongan-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }

    .lowongan-card {
        background: var(--bg-soft);
        border-radius: 14px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .lowongan-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .lowongan-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .lowongan-card-metric-head {
        display: flex;
        justify-content: space-between;
        font-size: 11.5px;
        color: var(--text-muted);
        margin-bottom: 6px;
        font-weight: 600;
    }

    .lowongan-progress-track {
        height: 6px;
        border-radius: 999px;
        background: #e9ebee;
        overflow: hidden;
    }

    .lowongan-progress-fill { height: 100%; border-radius: 999px; }
    .lowongan-progress-fill[data-tone="kuota"]  { background: var(--c-green); }
    .lowongan-progress-fill[data-tone="normal"] { background: var(--c-blue); }
    .lowongan-progress-fill[data-tone="mepet"]  { background: var(--c-orange); }
    .lowongan-progress-fill[data-tone="habis"]  { background: var(--c-red); }

    .lowongan-card-foot {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ===== SKELETON ===== */
    .skeleton-block {
        border-radius: 10px;
        background: linear-gradient(90deg, #eef0f2 25%, #f7f8f9 37%, #eef0f2 63%);
        background-size: 400% 100%;
        animation: skeleton-shimmer 1.4s ease infinite;
    }

    .skel-list-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 14px;
    }

    @keyframes skeleton-shimmer {
        0% { background-position: 100% 50%; }
        100% { background-position: 0 50%; }
    }

    .real-content { animation: fade-in-content 0.5s ease; }

    @keyframes fade-in-content {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const groups = [
            'stats', 'statuslamaran', 'kalender', 'engagement', 'lowongancard'
        ];

        groups.forEach((group, index) => {
            setTimeout(() => {
                document.querySelectorAll(`[data-skel-group="${group}"]`).forEach(el => el.style.display = 'none');
                document.querySelectorAll(`[data-real-group="${group}"]`).forEach(el => el.style.display = '');
            }, 300 + (index * 150));
        });

        const ctx = document.getElementById('chartStatusLamaran');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Menunggu', 'Interview', 'Diterima', 'Ditolak'],
                    datasets: [{
                        data: [
                            {{ $funnelMenunggu ?? 0 }},
                            {{ $funnelInterview ?? 0 }},
                            {{ $funnelDiterima ?? 0 }},
                            {{ $funnelDitolak ?? 0 }}
                        ],
                        backgroundColor: ['#f59f00', '#4db8d4', '#2f8f6e', '#ee152a'],
                        borderWidth: 0,
                        cutout: '72%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: (item) => `${item.label}: ${item.raw}`
                            }
                        }
                    }
                }
            });
        }
    });
</script>

@endsection