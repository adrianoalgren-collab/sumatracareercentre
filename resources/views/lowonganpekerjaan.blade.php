<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lowongan Kerja - Sumatra Career Centre</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/lowongan.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <x-navbar />

    <!-- HERO HEADER -->
    <header class="section" style="padding-top:140px; padding-bottom:60px; background:var(--cream); border-bottom:1px solid rgba(0,75,95,0.08);">
        <div class="section-inner">
            <div style="max-width:720px;">
                <div class="section-eyebrow">Pusat Karier Sumatera</div>
                <h1 class="section-title">Daftar Lowongan Kerja</h1>
                <p class="section-sub">
                    Temukan peluang karier terbaik di seluruh wilayah Sumatra.
                    Dari perusahaan teknologi inovatif hingga institusi besar,
                    langkah besar Anda berikutnya dimulai di sini.
                </p>
            </div>
        </div>
    </header>

    <!-- FILTER SECTION -->
    <section class="section" style="padding-top:40px; padding-bottom:40px; background:var(--white); border-bottom:1px solid rgba(0,75,95,0.08);">
        <div class="section-inner">
            <form method="GET" action="{{ route('lowongan.pekerjaan') }}" id="filterForm"
                  style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr auto; gap:20px; align-items:end;">

                <div>
                    <label style="font-size:0.8rem; font-weight:600; color:var(--smoke); display:block; margin-bottom:8px;">
                        Pencarian
                    </label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Posisi atau Perusahaan..."
                        style="width:100%; padding:14px 16px; border:1px solid rgba(0,75,95,0.12); border-radius:10px; background:var(--cream); font-family:'DM Sans', sans-serif; outline:none;"
                    >
                </div>

                <div>
                    <label style="font-size:0.8rem; font-weight:600; color:var(--smoke); display:block; margin-bottom:8px;">
                        Kategori
                    </label>
                    <select name="kategori_label"
                            style="width:100%; padding:14px; border:1px solid rgba(0,75,95,0.12); border-radius:10px; background:var(--cream); font-family:'DM Sans', sans-serif;">
                        <option value="Semua Tipe" {{ request('kategori_label', 'Semua Tipe') == 'Semua Tipe' ? 'selected' : '' }}>Semua Tipe</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori_label') == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="font-size:0.8rem; font-weight:600; color:var(--smoke); display:block; margin-bottom:8px;">
                        Tanggal Posting
                    </label>
                    <select name="tanggal_posting"
                            style="width:100%; padding:14px; border:1px solid rgba(0,75,95,0.12); border-radius:10px; background:var(--cream); font-family:'DM Sans', sans-serif;">
                        <option value="kapan_saja" {{ request('tanggal_posting', 'kapan_saja') == 'kapan_saja' ? 'selected' : '' }}>Kapan Saja</option>
                        <option value="24_jam" {{ request('tanggal_posting') == '24_jam' ? 'selected' : '' }}>24 Jam Terakhir</option>
                        <option value="minggu_ini" {{ request('tanggal_posting') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                    </select>
                </div>

                <div>
                    <label style="font-size:0.8rem; font-weight:600; color:var(--smoke); display:block; margin-bottom:8px;">
                        Status
                    </label>
                    <select name="status"
                            style="width:100%; padding:14px; border:1px solid rgba(0,75,95,0.12); border-radius:10px; background:var(--cream); font-family:'DM Sans', sans-serif;">
                        <option value="Semua Status" {{ request('status', 'Semua Status') == 'Semua Status' ? 'selected' : '' }}>Semua Status</option>
                        <option value="Lowongan Buka" {{ request('status') == 'Lowongan Buka' ? 'selected' : '' }}>Lowongan Buka</option>
                        <option value="Lowongan Tutup" {{ request('status') == 'Lowongan Tutup' ? 'selected' : '' }}>Lowongan Tutup</option>
                    </select>
                </div>

                <div style="display:flex; gap:10px;">
                    <button type="submit" id="btnCari"
                            style="padding:14px 22px; border:none; border-radius:10px; background:var(--forest, #004b5f); color:#fff; font-family:'DM Sans', sans-serif; font-weight:600; cursor:pointer;">
                        Cari
                    </button>
                    @if(request()->anyFilled(['search', 'kategori_label', 'tanggal_posting', 'status']))
                        <a href="{{ route('lowongan.pekerjaan') }}"
                           style="padding:14px 18px; border:1px solid rgba(0,75,95,0.12); border-radius:10px; color:var(--charcoal); text-decoration:none; font-family:'DM Sans', sans-serif; display:flex; align-items:center;">
                            Reset
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </section>

    <!-- JOBS SECTION -->
    <section class="section jobs-section">
        <div class="section-inner">

            <!-- SKELETON LOADING (muncul sesaat setelah filter disubmit) -->
            <div class="jobs-grid" id="skeletonGrid">
                @for($i = 0; $i < 6; $i++)
                <div class="skeleton-card">
                    <div class="skeleton-row">
                        <div class="skeleton-block skeleton-logo"></div>
                        <div class="skeleton-block skeleton-tag"></div>
                    </div>
                    <div class="skeleton-block skeleton-title"></div>
                    <div class="skeleton-block skeleton-line"></div>
                    <div class="skeleton-row" style="gap:8px;">
                        <div class="skeleton-block skeleton-skill"></div>
                        <div class="skeleton-block skeleton-skill"></div>
                    </div>
                    <div class="skeleton-block skeleton-btn"></div>
                </div>
                @endfor
            </div>

            <div id="realContent">
            @if($lowongan->isEmpty())
                <p style="text-align:center; padding:60px 0; color:var(--smoke); font-family:'DM Sans', sans-serif;">
                    Tidak ada lowongan yang cocok dengan pencarianmu.
                </p>
            @else
            <div class="jobs-grid">

                @foreach($lowongan as $item)
                <div class="job-card">

                    <!-- HEADER -->
                    <div class="job-card-header">

                        <div class="job-logo">
                            <span class="material-icons-round">business</span>
                        </div>

                        <div class="job-tags">

                            <span class="tag tag-type">
                                Full-time
                            </span>

                            @if($item->status_lowongan == 'aktif')
                                <span class="tag tag-open">Terbuka</span>
                            @else
                                <span class="tag tag-closed">Tertutup</span>
                            @endif

                        </div>

                    </div>

                    <!-- TITLE -->
                    <h3 class="job-title">
                        {{ $item->judul_lowongan }}
                    </h3>

                    <!-- COMPANY -->
                    <p class="job-company">
                        <span class="material-icons-round">location_on</span>
                        {{ $item->perusahaan?->nama_perusahaan }} · {{ $item->lokasi }}
                    </p>
                    <!-- SKILL -->
                    <div class="job-skills">

                        <span class="skill-tag">
                            {{ $item->kategori_label }}
                        </span>

                        <span class="skill-tag">
                            Deadline {{ $item->tanggal_deadline_label }}
                        </span>

                    </div>

                    <!-- BUTTON -->
                    @if($item->status_lowongan == 'aktif')

                        <button
                            class="btn-apply"
                            onclick="window.location.href='{{ route('detail.lowongan.pekerjaan', $item->id) }}'">
                            Lihat Detail
                        </button>

                    @else

                        <button class="btn-apply" disabled>
                            Closed
                        </button>

                    @endif

                </div>
                @endforeach

            </div>

            <!-- PAGINATION -->
            @if($lowongan->hasPages())
            <div style="margin-top:48px; display:flex; justify-content:center; align-items:center; gap:8px; flex-wrap:wrap;">

                {{-- Tombol Previous --}}
                @if($lowongan->onFirstPage())
                    <span style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--smoke); font-family:'DM Sans', sans-serif; font-size:0.85rem; opacity:0.5;">
                        &laquo; Sebelumnya
                    </span>
                @else
                    <a href="{{ $lowongan->previousPageUrl() }}"
                       style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--charcoal); text-decoration:none; font-family:'DM Sans', sans-serif; font-size:0.85rem; transition:background .15s;">
                        &laquo; Sebelumnya
                    </a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach($lowongan->getUrlRange(1, $lowongan->lastPage()) as $page => $url)
                    @if($page == $lowongan->currentPage())
                        <span style="padding:10px 16px; border-radius:8px; background:var(--forest, #004b5f); color:#fff; font-family:'DM Sans', sans-serif; font-size:0.85rem; font-weight:600;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--charcoal); text-decoration:none; font-family:'DM Sans', sans-serif; font-size:0.85rem;">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if($lowongan->hasMorePages())
                    <a href="{{ $lowongan->nextPageUrl() }}"
                       style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--charcoal); text-decoration:none; font-family:'DM Sans', sans-serif; font-size:0.85rem;">
                        Selanjutnya &raquo;
                    </a>
                @else
                    <span style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--smoke); font-family:'DM Sans', sans-serif; font-size:0.85rem; opacity:0.5;">
                        Selanjutnya &raquo;
                    </span>
                @endif

            </div>

            <p style="text-align:center; margin-top:16px; color:var(--smoke); font-family:'DM Sans', sans-serif; font-size:0.8rem;">
                Menampilkan {{ $lowongan->firstItem() }}–{{ $lowongan->lastItem() }} dari {{ $lowongan->total() }} lowongan
            </p>
            @endif

            @endif
            </div>

        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <x-footer />

    <script src="{{ asset('js/lowongan.js') }}"></script>

</body>
</html>