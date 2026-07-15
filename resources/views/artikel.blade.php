<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artikel | Sumatra Career Centre</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Navbar -->
    <x-navbar />

    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg"></div>

        <img class="hero-img"
            src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2000&auto=format&fit=crop"
            alt="Artikel Career" />

        <div class="hero-geo hero-geo-ring"></div>
        <div class="hero-geo hero-geo-ring-inner"></div>
        <div class="hero-geo hero-geo-line"></div>

        <div class="hero-content">
            <div>
                <div class="hero-label">
                    <span class="hero-label-bar"></span>
                    Berita & Wawasan Karier
                </div>

                <h1 class="hero-title">
                    Artikel & Insight <br>
                    Untuk Masa Depan <br>
                    <em>Karirmu</em>
                </h1>

                <p class="hero-desc">
                    Temukan tren industri terbaru, tips pengembangan diri,
                    seminar karier, workshop, hingga peluang eksklusif untuk
                    mempercepat perjalanan profesionalmu.
                </p>
            </div>

            <div class="hero-card">
                <div class="hero-card-label">Kategori Populer</div>

                <ul class="hero-card-list">
                    <li class="hero-card-item">
                        <div>
                            <span class="hero-card-role">Seminar Karier</span>
                            <span class="hero-card-co">Tips interview & networking</span>
                        </div>
                    </li>

                    <li class="hero-card-item">
                        <div>
                            <span class="hero-card-role">Campus Hiring</span>
                            <span class="hero-card-co">Peluang rekrutmen kampus</span>
                        </div>
                    </li>

                    <li class="hero-card-item">
                        <div>
                            <span class="hero-card-role">Workshop</span>
                            <span class="hero-card-co">Skill upgrade & personal branding</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- FEATURED ARTICLE -->
    @if($featured)
    <section class="section news-section">
        <div class="section-inner">

            <div class="section-header">
                <div>
                    <div class="section-eyebrow">Artikel Unggulan</div>
                    <h2 class="section-title">{{ $featured->judul }}</h2>
                    <p class="section-sub">
                        {{ $featured->ringkasan }}
                    </p>
                </div>
            </div>

            <div class="news-grid">
                <a href="{{ route('artikel.detail', $featured->slug) }}" style="text-decoration:none; color:inherit;">
                <div class="news-card">
                    <div class="news-card-img">
                        <img src="{{ $featured->gambar_utama ? asset('storage/'.$featured->gambar_utama) : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000&auto=format&fit=crop' }}" alt="featured">
                        <div class="news-card-img-overlay"></div>
                    </div>

                    <div class="news-card-body">
                        <div class="news-meta">
                            <span class="news-cat">{{ $featured->kategori }}</span>
                            <span class="news-dot"></span>
                            <span class="news-read">{{ $featured->tanggal_label }}</span>
                        </div>

                        <h3 class="news-title">
                            {{ $featured->judul }}
                        </h3>

                        <p class="news-desc">
                            {{ $featured->ringkasan }}
                        </p>

                        <span class="news-link">Baca Selengkapnya →</span>
                    </div>
                </div>
                </a>

                <div class="news-side">
                    @forelse($sideArticles as $item)
                    <a href="{{ route('artikel.detail', $item->slug) }}" style="text-decoration:none; color:inherit;">
                    <div class="news-card news-card-sm">
                        <div class="news-card-body">
                            <h4 class="news-title">{{ $item->judul }}</h4>
                            <p class="news-desc">{{ $item->ringkasan }}</p>
                        </div>
                    </div>
                    </a>
                    @empty
                    {{-- Tidak ada artikel tambahan --}}
                    @endforelse
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
                        <img src="{{ $item->gambar_utama ? asset('storage/'.$item->gambar_utama) : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $item->judul }}">
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
            <div class="article-pagination">

                @if(!$artikel->onFirstPage())
                    <a href="{{ $artikel->previousPageUrl() }}" class="page-btn">←</a>
                @endif

                @foreach($artikel->getUrlRange(1, $artikel->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="page-btn {{ $page == $artikel->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach

                @if($artikel->hasMorePages())
                    <a href="{{ $artikel->nextPageUrl() }}" class="page-btn">→</a>
                @endif

            </div>
            @endif
            @endif

        </div>
    </section>

    <!-- CTA -->
    <section class="cta-band">
        <div class="cta-band-inner">
            <h2 class="cta-title">Dapatkan Update Mingguan</h2>
            <p class="cta-desc">
                Jadilah yang pertama tahu tentang lowongan eksklusif,
                event kampus, dan tips karier terbaru langsung di inbox Anda.
            </p>

            <div class="cta-btns">
                <button class="btn-cta-dark">Berlangganan</button>
                <a href="{{ route('artikel') }}" class="btn-cta-out" style="text-decoration:none; display:inline-flex; align-items:center;">Lihat Semua Artikel</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />

    <script>
    function setTab(el) {
        document.querySelectorAll('.role-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        el.classList.add('active');
    }

    document.addEventListener("DOMContentLoaded", function () {
        const animatedItems = [
            ".hero-label",
            ".hero-title",
            ".hero-desc",
            ".hero-card",

            ".section-header",
            ".news-card",
            ".news-card-sm",

            ".article-search-wrapper",
            ".job-card:nth-child(1)",
            ".job-card:nth-child(2)",
            ".job-card:nth-child(3)",

            ".article-pagination",
            ".cta-band-inner"
        ];

        animatedItems.forEach((selector, index) => {
            const elements = document.querySelectorAll(selector);

            elements.forEach((el) => {
                el.style.opacity = "0";
                el.style.transform = "translateY(40px)";
                el.style.transition = "all 0.8s ease";

                setTimeout(() => {
                    el.style.opacity = "1";
                    el.style.transform = "translateY(0)";
                }, 200 + (index * 180));
            });
        });
    });
</script>

</body>

</html>