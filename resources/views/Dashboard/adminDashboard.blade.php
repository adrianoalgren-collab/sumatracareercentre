@extends('layouts.app')

@section('content')

<div class="dashboard-wrapper">

    {{-- ═══════════════════════════════════════════════
         STAT CARDS UTAMA
    ═══════════════════════════════════════════════ --}}
    <div class="stat-cards-grid">

        {{-- Skeleton --}}
        @for ($i = 0; $i < 6; $i++)
            <div class="stat-card-skel skeleton-block" data-skel-group="stats"></div>
        @endfor

        {{-- Real content --}}
        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="pelamar"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalPelamar }}</span>
                <span class="stat-card-label">Total Pelamar</span>
            </div>
        </div>

        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="perusahaan"><i class="fas fa-building"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalPerusahaan }}</span>
                <span class="stat-card-label">Total Perusahaan</span>
            </div>
        </div>

        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="lowongan"><i class="fas fa-briefcase"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalLowongan }}</span>
                <span class="stat-card-label">Lowongan Aktif</span>
            </div>
        </div>

        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="lamaran"><i class="fas fa-file-alt"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalLamaran }}</span>
                <span class="stat-card-label">Total Lamaran</span>
            </div>
        </div>

        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="interview"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalInterview }}</span>
                <span class="stat-card-label">Interview Terjadwal</span>
            </div>
        </div>

        <div class="stat-card real-content" data-real-group="stats" style="display:none;">
            <div class="stat-card-icon" data-tone="artikel"><i class="fas fa-newspaper"></i></div>
            <div class="stat-card-body">
                <span class="stat-card-number">{{ $totalArtikel }}</span>
                <span class="stat-card-label">Total Artikel</span>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════
         STATISTIK RINGKAS
    ═══════════════════════════════════════════════ --}}
    <div class="content-card">
        <h3 class="card-title">Statistik Ringkas</h3>

        <div class="skel-list-row" data-skel-group="ringkas">
            @for ($i = 0; $i < 6; $i++)
                <div class="skeleton-block" style="height:70px;"></div>
            @endfor
        </div>

        <div class="ringkas-grid real-content" data-real-group="ringkas" style="display:none;">
            <div class="ringkas-item">
                <span class="ringkas-number">{{ $totalUserAdmin ?? 0 }}</span>
                <span class="ringkas-label">User Admin</span>
            </div>
            <div class="ringkas-item">
                <span class="ringkas-number">{{ $totalUserPerusahaan ?? 0 }}</span>
                <span class="ringkas-label">User Perusahaan</span>
            </div>
            <div class="ringkas-item">
                <span class="ringkas-number">{{ $totalUserPelamar ?? 0 }}</span>
                <span class="ringkas-label">User Pelamar</span>
            </div>
            <div class="ringkas-item">
                <span class="ringkas-number">{{ $totalLowonganAktif ?? $totalLowongan }}</span>
                <span class="ringkas-label">Lowongan Aktif</span>
            </div>
            <div class="ringkas-item">
                <span class="ringkas-number">{{ $totalLamaranHariIni ?? 0 }}</span>
                <span class="ringkas-label">Lamaran Hari Ini</span>
            </div>
            <div class="ringkas-item">
                <span class="ringkas-number">{{ $totalLamaranMingguIni ?? 0 }}</span>
                <span class="ringkas-label">Lamaran Minggu Ini</span>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         GRAFIK TREN
    ═══════════════════════════════════════════════ --}}
    <div class="dashboard-row">

        <div class="content-card dashboard-col-6">
            <h3 class="card-title">Tren Pendaftaran User Baru</h3>

            <div class="skel-list" data-skel-group="trenuser">
                <div class="skeleton-block" style="height:260px;"></div>
            </div>

            <div class="chart-wrap real-content" data-real-group="trenuser" style="display:none;">
                <canvas id="chartUserBaru"></canvas>
            </div>
        </div>

        <div class="content-card dashboard-col-6">
            <h3 class="card-title">Tren Jumlah Lamaran</h3>

            <div class="skel-list" data-skel-group="trenlamaran">
                <div class="skeleton-block" style="height:260px;"></div>
            </div>

            <div class="chart-wrap real-content" data-real-group="trenlamaran" style="display:none;">
                <canvas id="chartLamaranBulanan"></canvas>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════
         MODERASI
    ═══════════════════════════════════════════════ --}}
    <div class="dashboard-row">

        <div class="content-card dashboard-col-6">
            <div class="card-title-row">
                <h3 class="card-title">Lowongan Menunggu Approval</h3>
                @if (Route::has('admin.lowongan.index'))
                    <a href="{{ route('admin.lowongan.index', ['status' => 'pending']) }}" class="link-small">Lihat Semua</a>
                @endif
            </div>

            <div class="skel-list" data-skel-group="moderasilowongan">
                @for ($i = 0; $i < 3; $i++)
                    <div class="skeleton-block" style="height:48px; margin-bottom:10px;"></div>
                @endfor
            </div>

            <div class="mini-list real-content" data-real-group="moderasilowongan" style="display:none;">
                @forelse($lowonganPendingApproval ?? [] as $item)
                    <div class="mini-list-item">
                        <div class="mini-list-icon" data-tone="pending"><i class="fas fa-hourglass-half"></i></div>
                        <div class="mini-list-body">
                            <span class="mini-list-title">{{ $item->judul_lowongan }}</span>
                            <span class="mini-list-sub">{{ $item->perusahaan->nama_perusahaan ?? '-' }}</span>
                        </div>
                        @if (Route::has('admin.lowongan.show'))
                            <a href="{{ route('admin.lowongan.show', $item->id) }}" class="mini-list-action">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @endif
                    </div>
                @empty
                    <p class="mini-list-empty">Tidak ada lowongan yang menunggu approval</p>
                @endforelse
            </div>
        </div>

        <div class="content-card dashboard-col-6">
            <h3 class="card-title">Komentar Terbaru</h3>

            <div class="skel-list" data-skel-group="moderasikomentar">
                @for ($i = 0; $i < 3; $i++)
                    <div class="skeleton-block" style="height:48px; margin-bottom:10px;"></div>
                @endfor
            </div>

            <div class="mini-list real-content" data-real-group="moderasikomentar" style="display:none;">
                @forelse($komentarTerbaru ?? [] as $item)
                    <div class="mini-list-item">
                        <div class="mini-list-icon" data-tone="komentar"><i class="fas fa-comment-dots"></i></div>
                        <div class="mini-list-body">
                            <span class="mini-list-title">{{ $item->nama_user ?? ($item->user->name ?? 'Anonim') }}</span>
                            <span class="mini-list-sub">{{ \Illuminate\Support\Str::limit($item->isi_komentar, 60) }}</span>
                        </div>
                    </div>
                @empty
                    <p class="mini-list-empty">Belum ada komentar</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════
         TOP PERFORMERS
    ═══════════════════════════════════════════════ --}}
    <div class="dashboard-row">

        <div class="content-card dashboard-col-6">
            <h3 class="card-title">Perusahaan dengan Lowongan Terbanyak</h3>

            <div class="skel-list" data-skel-group="topperusahaan">
                @for ($i = 0; $i < 3; $i++)
                    <div class="skeleton-block" style="height:48px; margin-bottom:10px;"></div>
                @endfor
            </div>

            <div class="mini-list real-content" data-real-group="topperusahaan" style="display:none;">
                @forelse($topPerusahaan ?? [] as $item)
                    <div class="mini-list-item">
                        <div class="mini-list-icon" data-tone="perusahaan"><i class="fas fa-building"></i></div>
                        <div class="mini-list-body">
                            <span class="mini-list-title">{{ $item->nama_perusahaan }}</span>
                            <span class="mini-list-sub">Lowongan diposting atas nama perusahaan ini</span>
                        </div>
                        <span class="count-badge" data-tone="perusahaan">{{ $item->lowongan_pekerjaan_count }}</span>
                    </div>
                @empty
                    <p class="mini-list-empty">Belum ada data</p>
                @endforelse
            </div>
        </div>

        <div class="content-card dashboard-col-6">
            <h3 class="card-title">Lowongan dengan Pendaftar Terbanyak</h3>

            <div class="skel-list" data-skel-group="toplowongan">
                @for ($i = 0; $i < 3; $i++)
                    <div class="skeleton-block" style="height:48px; margin-bottom:10px;"></div>
                @endfor
            </div>

            <div class="mini-list real-content" data-real-group="toplowongan" style="display:none;">
                @forelse($topLowongan ?? [] as $item)
                    <div class="mini-list-item">
                        <div class="mini-list-icon" data-tone="lowongan"><i class="fas fa-briefcase"></i></div>
                        <div class="mini-list-body">
                            <span class="mini-list-title">{{ $item->judul_lowongan }}</span>
                            <span class="mini-list-sub">{{ $item->perusahaan->nama_perusahaan ?? '-' }}</span>
                        </div>
                        <span class="count-badge" data-tone="lowongan">{{ $item->lamaran_count }}</span>
                    </div>
                @empty
                    <p class="mini-list-empty">Belum ada data</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════════════════════
         CAREER CLASS + ARTIKEL
    ═══════════════════════════════════════════════ --}}
    <div class="dashboard-row">

        <div class="content-card dashboard-col-4">
            <h3 class="card-title">Career Class</h3>

            <div class="skel-list" data-skel-group="career">
                @for ($i = 0; $i < 3; $i++)
                    <div class="skeleton-block" style="height:60px; margin-bottom:10px;"></div>
                @endfor
            </div>

            <div class="career-mini-stats real-content" data-real-group="career" style="display:none;">

                <div class="career-mini-stat" data-tone="published">
                    <span class="career-mini-icon"><i class="fas fa-graduation-cap"></i></span>
                    <div class="career-mini-body">
                        <span class="career-mini-number">{{ $totalKelasPublished ?? $totalKelas ?? 0 }}</span>
                        <span class="career-mini-label">Kelas Published</span>
                    </div>
                </div>

                <div class="career-mini-stat" data-tone="enrollment">
                    <span class="career-mini-icon"><i class="fas fa-user-friends"></i></span>
                    <div class="career-mini-body">
                        <span class="career-mini-number">{{ $totalEnrollment ?? $totalPeserta ?? 0 }}</span>
                        <span class="career-mini-label">Total Enrollment</span>
                    </div>
                </div>

                <div class="career-mini-stat" data-tone="completion">
                    <span class="career-mini-icon"><i class="fas fa-check-circle"></i></span>
                    <div class="career-mini-body career-mini-body--full">
                        <div class="career-mini-top-row">
                            <span class="career-mini-number">
                                {{ isset($rataCompletionRate) ? number_format($rataCompletionRate, 1) : '0' }}<small>%</small>
                            </span>
                            <span class="career-mini-label">Completion Rate</span>
                        </div>
                        <div class="career-mini-progress">
                            <div class="career-mini-progress-fill"
                                 style="width: {{ isset($rataCompletionRate) ? min(100, $rataCompletionRate) : 0 }}%;"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="content-card dashboard-col-8">
            <div class="card-title-row">
                <h3 class="card-title">Artikel</h3>
                @if (Route::has('admin.artikel.index'))
                    <a href="{{ route('admin.artikel.index') }}" class="link-small">Lihat Semua</a>
                @endif
            </div>

            <div class="skel-list" data-skel-group="artikel">
                <div class="skeleton-block" style="height:16px; margin-bottom:10px; width:140px;"></div>
                <div class="skel-list-row">
                    <div class="skeleton-block" style="height:90px;"></div>
                    <div class="skeleton-block" style="height:90px;"></div>
                </div>
                <div class="skeleton-block" style="height:16px; margin:16px 0 10px; width:180px;"></div>
                <div class="skeleton-block" style="height:48px; margin-bottom:10px;"></div>
                <div class="skeleton-block" style="height:48px;"></div>
            </div>

            <div class="real-content" data-real-group="artikel" style="display:none;">

                <p class="artikel-subtitle">Artikel Terbaru</p>
                <div class="artikel-mini-grid">
                    @forelse($artikelTerbaru as $item)
                        <a href="{{ Route::has('artikel.detail') ? route('artikel.detail', $item->slug) : '#' }}"
                           class="artikel-mini-card">
                            <img src="{{ $item->gambar_utama ? asset('storage/'.$item->gambar_utama) : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop' }}"
                                 alt="{{ $item->judul }}">
                            <div class="artikel-mini-body">
                                <span class="artikel-mini-cat">{{ $item->kategori }}</span>
                                <span class="artikel-mini-title">{{ $item->judul }}</span>
                            </div>
                        </a>
                    @empty
                        <p class="mini-list-empty">Belum ada artikel</p>
                    @endforelse
                </div>

                <p class="artikel-subtitle" style="margin-top:18px;">Draft Belum Publish</p>
                <div class="mini-list">
                    @forelse($artikelDraft ?? [] as $item)
                        <div class="mini-list-item">
                            <div class="mini-list-icon" data-tone="draft"><i class="fas fa-file-signature"></i></div>
                            <div class="mini-list-body">
                                <span class="mini-list-title">{{ $item->judul }}</span>
                                <span class="mini-list-sub">Diubah terakhir {{ $item->updated_at->diffForHumans() }}</span>
                            </div>
                            @if (Route::has('admin.artikel.edit'))
                                <a href="{{ route('admin.artikel.edit', $item->id) }}" class="mini-list-action">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @endif
                        </div>
                    @empty
                        <p class="mini-list-empty">Tidak ada artikel draft</p>
                    @endforelse
                </div>

            </div>
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
    .dashboard-col-4 { grid-column: span 4; }
    .dashboard-col-8 { grid-column: span 8; }

    @media (max-width: 900px) {
        .stat-cards-grid { grid-template-columns: repeat(2, 1fr); }
        .dashboard-col-6, .dashboard-col-4, .dashboard-col-8 { grid-column: span 12; }
    }

    @media (max-width: 560px) {
        .stat-cards-grid { grid-template-columns: 1fr; }
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

    .stat-card-icon[data-tone="pelamar"]     { background: rgba(47,143,110,.10);  color: var(--c-green); }
    .stat-card-icon[data-tone="perusahaan"]  { background: rgba(0,75,95,.10);     color: var(--c-teal); }
    .stat-card-icon[data-tone="lowongan"]    { background: rgba(238,21,42,.10);   color: var(--c-red); }
    .stat-card-icon[data-tone="lamaran"]     { background: rgba(255,158,0,.10);   color: var(--c-orange); }
    .stat-card-icon[data-tone="interview"]   { background: rgba(77,184,212,.10);  color: var(--c-blue); }
    .stat-card-icon[data-tone="artikel"]     { background: rgba(111,66,193,.10);  color: var(--c-purple); }

    .stat-card-body { display: flex; flex-direction: column; }
    .stat-card-number { font-size: 24px; font-weight: 700; color: var(--text-dark); }
    .stat-card-label { font-size: 12.5px; color: var(--text-muted); }

    /* ===== STATISTIK RINGKAS ===== */
    .ringkas-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
    }

    @media (max-width: 900px) { .ringkas-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 560px) { .ringkas-grid { grid-template-columns: repeat(2, 1fr); } }

    .ringkas-item {
        display: flex; flex-direction: column;
        padding: 14px 16px;
        background: var(--bg-soft);
        border-radius: 10px;
    }
    .ringkas-number { font-size: 20px; font-weight: 700; color: var(--text-dark); }
    .ringkas-label { font-size: 11.5px; color: var(--text-muted); }

    /* ===== CHART ===== */
    .chart-wrap {
        position: relative;
        width: 100%;
        height: 260px;
    }

    /* ===== MINI LIST ===== */
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

    .mini-list-icon[data-tone="perusahaan"] { background: rgba(0,75,95,.10);   color: var(--c-teal); }
    .mini-list-icon[data-tone="lowongan"]   { background: rgba(238,21,42,.10); color: var(--c-red); }
    .mini-list-icon[data-tone="pending"]    { background: rgba(245,159,0,.12); color: var(--c-amber); }
    .mini-list-icon[data-tone="komentar"]   { background: rgba(77,184,212,.12); color: var(--c-blue); }
    .mini-list-icon[data-tone="draft"]      { background: rgba(173,181,189,.15); color: var(--text-muted); }

    .mini-list-body { display: flex; flex-direction: column; flex: 1; min-width: 0; }
    .mini-list-title {
        font-size: 13.5px; font-weight: 600; color: var(--text-dark);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .mini-list-sub { font-size: 12px; color: var(--text-muted); }

    .mini-list-action {
        color: var(--c-gray); font-size: 12px;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none;
    }

    .mini-list-empty {
        text-align: center; padding: 20px 0;
        color: var(--text-muted); font-size: 13px;
    }

    .count-badge {
        flex-shrink: 0;
        min-width: 28px;
        height: 28px;
        padding: 0 8px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .count-badge[data-tone="perusahaan"] { background: rgba(0,75,95,.10);   color: var(--c-teal); }
    .count-badge[data-tone="lowongan"]   { background: rgba(238,21,42,.10); color: var(--c-red); }

    /* ===== CAREER MINI STATS ===== */
    .career-mini-stats {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .career-mini-stat {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 18px 16px;
        background: #fff;
        border: 1px solid #E7ECEF;
        border-radius: 14px;
        position: relative;
        overflow: hidden;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .career-mini-stat::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 3px;
    }

    .career-mini-stat:hover {
        border-color: #D7DEE3;
        box-shadow: 0 4px 14px rgba(0,0,0,0.05);
    }

    .career-mini-stat[data-tone="published"]::before  { background: var(--c-teal); }
    .career-mini-stat[data-tone="enrollment"]::before { background: #2F80ED; }
    .career-mini-stat[data-tone="completion"]::before { background: var(--c-orange); }

    .career-mini-icon {
        flex: none;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 20px;
    }

    .career-mini-stat[data-tone="published"] .career-mini-icon  { background: rgba(0,75,95,.08);  color: var(--c-teal); }
    .career-mini-stat[data-tone="enrollment"] .career-mini-icon { background: rgba(47,128,237,.10); color: #2F80ED; }
    .career-mini-stat[data-tone="completion"] .career-mini-icon { background: rgba(255,158,0,.10); color: var(--c-orange); }

    .career-mini-body { display: flex; flex-direction: column; }
    .career-mini-body--full { flex: 1; min-width: 0; }

    .career-mini-top-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .career-mini-number { font-size: 26px; font-weight: 700; color: var(--text-dark); line-height: 1.1; }
    .career-mini-number small { font-size: 15px; font-weight: 600; margin-left: 2px; }
    .career-mini-label { font-size: 12.5px; color: var(--text-muted); font-weight: 500; margin-top: 2px; }

    .career-mini-progress {
        margin-top: 10px;
        height: 6px;
        border-radius: 999px;
        background: #F0F2F4;
        overflow: hidden;
    }

    .career-mini-progress-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--c-orange), #FFA94D);
        transition: width .5s ease;
    }

    /* ===== ARTIKEL ===== */
    .artikel-subtitle {
        font-size: 12.5px; font-weight: 700; color: var(--text-muted);
        text-transform: uppercase; margin: 0 0 10px;
    }

    .artikel-mini-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 14px;
    }

    .artikel-mini-card {
        display: block;
        text-decoration: none;
        color: inherit;
        border-radius: 10px;
        overflow: hidden;
        background: var(--bg-soft);
        transition: transform 0.2s ease;
    }
    .artikel-mini-card:hover { transform: translateY(-3px); }

    .artikel-mini-card img { width: 100%; height: 80px; object-fit: cover; display: block; }

    .artikel-mini-body { padding: 10px 12px; display: flex; flex-direction: column; gap: 4px; }
    .artikel-mini-cat { font-size: 10.5px; font-weight: 700; color: var(--c-red); text-transform: uppercase; }
    .artikel-mini-title {
        font-size: 12.5px; font-weight: 600; color: var(--text-dark);
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
        overflow: hidden; line-height: 1.4;
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
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
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
        // daftar group skeleton yang ada di halaman ini
        const groups = [
            'stats', 'ringkas', 'trenuser', 'trenlamaran',
            'moderasilowongan', 'moderasikomentar',
            'topperusahaan', 'toplowongan', 'career', 'artikel'
        ];

        groups.forEach((group, index) => {
            setTimeout(() => {
                document.querySelectorAll(`[data-skel-group="${group}"]`).forEach(el => el.style.display = 'none');
                document.querySelectorAll(`[data-real-group="${group}"]`).forEach(el => el.style.display = '');
            }, 300 + (index * 150));
        });

        // ===== GRAFIK TREN =====
        @php
            $labelBulanChart  = $labelBulan ?? ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            $dataUserBaruChart = $chartUserBulanan ?? array_fill(0, 12, 0);
            $dataLamaranChart  = $chartLamaranBulanan ?? array_fill(0, 12, 0);
        @endphp
        const labelBulan   = @json($labelBulanChart);
        const dataUserBaru = @json($dataUserBaruChart);
        const dataLamaran  = @json($dataLamaranChart);

        new Chart(document.getElementById('chartUserBaru'), {
            type: 'line',
            data: {
                labels: labelBulan,
                datasets: [{
                    label: 'User Baru',
                    data: dataUserBaru,
                    borderColor: '#2f8f6e',
                    backgroundColor: 'rgba(47,143,110,0.1)',
                    tension: 0.35,
                    fill: true,
                    pointRadius: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { offset: false },
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });

        new Chart(document.getElementById('chartLamaranBulanan'), {
            type: 'bar',
            data: {
                labels: labelBulan,
                datasets: [{
                    label: 'Jumlah Lamaran',
                    data: dataLamaran,
                    backgroundColor: '#ff9e00',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { offset: false },
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    });
</script>

@endsection