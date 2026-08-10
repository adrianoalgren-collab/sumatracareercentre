<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artikel | Sumatra Career Centre</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
   <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/artikel.js', 'resources/css/artikel.css'])

    <link rel="stylesheet" href="{{ asset('css/artikel.css') }}">
</head>

<body>

    <!-- Navbar -->
    <x-navbar />

    <!-- FEATURED ARTICLE -->
    @if($featured)
    <section class="section news-section news-section-hero">
        <div class="section-inner">

            <div class="section-header">
                <div>
                    <div class="section-eyebrow">Artikel Unggulan</div>
                    <h2 class="section-title">Berita & Insight Karier</h2>
                </div>
            </div>

            <div class="news-grid">

                <!-- Featured -->
                <a href="{{ route('artikel.detail', $featured->slug) }}" class="news-card" style="text-decoration:none; color:inherit;">

                    <div class="news-card-img">
                        <img src="{{ $featured->gambar_utama ? asset('storage/'.$featured->gambar_utama) : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000&auto=format&fit=crop' }}"
                             alt="{{ $featured->judul }}" />
                        <div class="news-card-img-overlay"></div>
                    </div>

                    <div class="news-card-body">

                        <div class="news-meta">
                            <span class="news-cat">{{ $featured->kategori }}</span>
                            <span class="news-dot"></span>
                            <span class="news-read">{{ $featured->waktu_baca_label }}</span>
                        </div>

                        <h3 class="news-title">
                            {{ $featured->judul }}
                        </h3>

                        <p class="news-desc">
                            {{ $featured->ringkasan }}
                        </p>

                        <span class="news-link">
                            Baca Selengkapnya
                            <span class="material-icons-round" style="font-size:14px;">open_in_new</span>
                        </span>

                    </div>
                </a>

                <!-- Side stack -->
                <div class="news-side">

                    @foreach($sideArticles->take(1) as $item)
                    <a href="{{ route('artikel.detail', $item->slug) }}" class="news-card news-card-sm" style="text-decoration:none; color:inherit;">

                        

                        <div class="news-card-body">

                            <div class="news-meta">
                                <span class="news-cat">{{ $item->kategori }}</span>
                                <span class="news-dot"></span>
                                <span class="news-read">{{ $item->waktu_baca_label }}</span>
                            </div>

                            <h3 class="news-title">
                                {{ $item->judul }}
                            </h3>

                            <p class="news-desc">
                                {{ $item->ringkasan }}
                            </p>

                            <span class="news-link">
                                Baca Artikel
                                <span class="material-icons-round" style="font-size:12px;">open_in_new</span>
                            </span>

                        </div>
                    </a>
                    @endforeach

                    <!-- Newsletter (statis, bukan artikel) -->
                    <div class="news-card news-card-sm" style="background:rgba(238,21,42,0.07); border-color:rgba(238,21,42,0.18);">

                        <div class="news-card-body" style="padding:28px; display:flex; flex-direction:column; justify-content:center; gap:10px;">

                            <div class="news-meta">
                                <span class="news-cat" style="color:var(--amber);">Newsletter</span>
                            </div>

                            <h3 class="news-title">Dapatkan Update Karier Terbaru</h3>

                            <p class="news-desc" style="margin-bottom:16px;">
                                Berlangganan sekarang dan jangan lewatkan informasi lowongan, insight industri, dan peluang eksklusif lainnya.
                            </p>

                            <div style="display:flex; gap:8px;">
                                <input type="email" placeholder="Masukkan email kamu..."
                                    style="flex:1; padding:10px 14px; border-radius:4px; border:1px solid rgba(77,184,212,0.3);
                                    background:rgba(255,255,255,0.06); color:var(--cream);
                                    font-family:'DM Sans',sans-serif; font-size:0.875rem; outline:none;" />

                                <button class="btn-apply" style="width:auto; padding:10px 20px; border-radius:4px; white-space:nowrap; font-size:0.8125rem;">
                                    Subscribe
                                </button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
    @endif

    <!-- LATEST ARTICLES -->
    <section class="section jobs-section">
        <div class="section-inner">

            <div class="section-header">
                <div>
                    <div class="section-eyebrow">Artikel Terbaru</div>
                    <h2 class="section-title">Insight & Peluang Baru</h2>
                </div>
            </div>

            <!-- SEARCH BAR -->
            <div class="article-search-wrapper">
                <form class="article-search-form" method="GET" action="{{ route('artikel') }}">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="article-search-input"
                        placeholder="Cari artikel, seminar, workshop, atau insight karier..."
                    >
                    <button type="submit" class="article-search-btn">
                        Cari Artikel
                    </button>
                </form>
            </div>

            @if($artikel->isEmpty())
                <p style="text-align:center; padding:40px 0; color:var(--smoke); font-family:'DM Sans', sans-serif;">
                    Tidak ada artikel yang cocok dengan pencarianmu.
                </p>
            @else
            <div class="jobs-grid">

                @foreach($artikel as $item)
                <div class="job-card">
                    <div class="job-card-image">
                        <img src="{{ $item->gambar_utama ? asset('storage/'.$item->gambar_utama) : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop' }}"
                             alt="{{ $item->judul }}">
                    </div>

                    <div class="job-card-content">

                        <!-- META INFO -->
                        <div class="article-meta">
                            <span class="article-type">{{ $item->kategori }}</span>

                            <div class="article-info">
                                <span>{{ $item->tanggal_label }}</span>
                                <span class="meta-dot"></span>
                                <span>{{ $item->waktu_baca_label }}</span>
                            </div>
                        </div>

                        <h3 class="job-title">{{ $item->judul }}</h3>
                        <p class="job-company">
                            {{ $item->ringkasan }}
                        </p>

                        <button
                            class="btn-apply"
                            onclick="window.location.href='{{ route('artikel.detail', $item->slug) }}'">
                            Baca Artikel
                        </button>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- PAGINATION -->
            @if($artikel->hasPages())
            <div style="margin-top:48px; display:flex; justify-content:center; align-items:center; gap:8px; flex-wrap:wrap;">

                {{-- Tombol Previous --}}
                @if($artikel->onFirstPage())
                    <span style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--smoke); font-family:'DM Sans', sans-serif; font-size:0.85rem; opacity:0.5;">
                        &laquo; Sebelumnya
                    </span>
                @else
                    <a href="{{ $artikel->previousPageUrl() }}"
                       style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--charcoal); text-decoration:none; font-family:'DM Sans', sans-serif; font-size:0.85rem; transition:background .15s;">
                        &laquo; Sebelumnya
                    </a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach($artikel->getUrlRange(1, $artikel->lastPage()) as $page => $url)
                    @if($page == $artikel->currentPage())
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
                @if($artikel->hasMorePages())
                    <a href="{{ $artikel->nextPageUrl() }}"
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
                Menampilkan {{ $artikel->firstItem() }}–{{ $artikel->lastItem() }} dari {{ $artikel->total() }} artikel
            </p>
            @endif
            @endif

        </div>
    </section>

    <!-- ═══ CTA ═══ -->
    <div class="cta-band">
    <div class="cta-band-inner reveal">
        <h2 class="cta-title">Siap Memulai Perjalanan Kariermu?</h2>
        <p class="cta-desc">Bergabunglah dengan lebih dari 150,000 alumni yang telah menemukan karier impian mereka melalui Sumatra Career Centre.</p>
        <div class="cta-btns">

        @guest
            <a href="{{ route('register') }}" class="btn-cta-dark"
                style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
                Daftar Sekarang — Gratis
            </a>
        @endguest

        <a href="{{ route('lowongan.pekerjaan') }}" class="btn-cta-out"
            style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
            Lihat Semua Lowongan
        </a>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <script src="{{ asset('js/artikel.js') }}"></script>

</body>

</html>