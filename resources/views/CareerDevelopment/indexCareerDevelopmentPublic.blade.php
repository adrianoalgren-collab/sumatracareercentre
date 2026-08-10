<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Career Development | Sumatra Career Centre</title>

     <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/css/career-development.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/career.css') }}">
</head>

<body>

    <!-- Navbar -->
    <x-navbar />

    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg"></div>

        <img class="hero-img"
            src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000&auto=format&fit=crop"
            alt="Career Development" />

        <div class="hero-geo hero-geo-ring"></div>
        <div class="hero-geo hero-geo-ring-inner"></div>
        <div class="hero-geo hero-geo-line"></div>

        <div class="hero-content">
            <div>
                <div class="hero-label fade-in-text" style="opacity:0; transform:translateY(16px); transition: opacity 0.8s ease, transform 0.8s ease;">
                    <span class="hero-label-bar"></span>
                    Career Development
                </div>

                <h1 class="hero-title fade-in-text" style="opacity:0; transform:translateY(20px); transition: opacity 0.8s ease, transform 0.8s ease;">
                    Kembangkan <br>
                    Skill & Karirmu <br>
                    <em>Selangkah Demi Selangkah</em>
                </h1>

                <p class="hero-desc fade-in-text" style="opacity:0; transform:translateY(20px); transition: opacity 0.8s ease, transform 0.8s ease;">
                    Ikuti kelas terstruktur untuk mempersiapkan diri memasuki dunia kerja, <br>
                    Selesaikan setiap lesson secara berurutan untuk membuka materi berikutnya.
                </p>
            </div>
        </div>
    </section>

    <!-- CLASS LIST -->
    <section class="section jobs-section">
        <div class="section-inner">

            <div class="section-header">
                <div>
                    <div class="section-eyebrow">Kelas Tersedia</div>
                    <h2 class="section-title">Semua Kelas Career Development</h2>
                </div>
            </div>

            <!-- SEARCH BAR -->
            <div class="article-search-wrapper">
                <form class="article-search-form" method="GET" action="{{ route('career.index') }}">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="article-search-input"
                        placeholder="Cari kelas, topik, atau skill yang ingin dipelajari..."
                    >
                    <button type="submit" class="article-search-btn">
                        Cari Kelas
                    </button>
                </form>
            </div>

            @if($classes->isEmpty())
                <p style="text-align:center; padding:40px 0; color:var(--smoke); font-family:'DM Sans', sans-serif;">
                    Belum ada kelas yang cocok dengan pencarianmu.
                </p>
            @else
            <div class="jobs-grid">

                @foreach($classes as $item)
                <div class="job-card">
                    <div class="job-card-image">
                        <img src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $item->judul }}">
                    </div>

                    <div class="job-card-content career-card">

                        <!-- META INFO -->
                        <div class="article-meta">
                            <span class="article-type">{{ $item->lessons_count }} Lesson</span>

                            @if($item->enrollment)
                                <div class="article-info">
                                    <span>
                                        {{ $item->enrollment->status === 'selesai' ? 'Selesai' : 'Sedang Berjalan' }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <h3 class="job-title">{{ $item->judul }}</h3>
                        <p class="job-company">{{ $item->deskripsi }}</p>

                        @if($item->enrollment)
                            @php
                                $progress = $item->enrollment->progress_percent;
                                $isDone = $progress >= 100;
                            @endphp

                            <div class="card-progress {{ $isDone ? 'is-complete' : '' }}">
                                <div class="card-progress-meta">
                                    <span>{{ $isDone ? 'Selesai' : 'Progres Belajar' }}</span>
                                    <strong>{{ $progress }}%</strong>
                                </div>
                                <div class="card-progress-track">
                                    <div class="card-progress-fill" style="width: {{ $progress }}%;"></div>
                                </div>
                            </div>
                        @endif

                        <button
                            class="btn-apply"
                            onclick="window.location.href='{{ route('career.show', $item->id) }}'">
                            @if(!$item->enrollment)
                                Mulai Belajar
                            @elseif($item->enrollment->status === 'selesai')
                                Lihat Kembali
                            @else
                                Lanjutkan Belajar
                            @endif
                        </button>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- PAGINATION -->
            @if($classes->hasPages())
            <div style="margin-top:48px; display:flex; justify-content:center; align-items:center; gap:8px; flex-wrap:wrap;">

                {{-- Tombol Previous --}}
                @if($classes->onFirstPage())
                    <span style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--smoke); font-family:'DM Sans', sans-serif; font-size:0.85rem; opacity:0.5;">
                        &laquo; Sebelumnya
                    </span>
                @else
                    <a href="{{ $classes->previousPageUrl() }}"
                       style="padding:10px 16px; border-radius:8px; border:1px solid rgba(0,75,95,0.12); color:var(--charcoal); text-decoration:none; font-family:'DM Sans', sans-serif; font-size:0.85rem; transition:background .15s;">
                        &laquo; Sebelumnya
                    </a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach($classes->getUrlRange(1, $classes->lastPage()) as $page => $url)
                    @if($page == $classes->currentPage())
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
                @if($classes->hasMorePages())
                    <a href="{{ $classes->nextPageUrl() }}"
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
                Menampilkan {{ $classes->firstItem() }}–{{ $classes->lastItem() }} dari {{ $classes->total() }} kelas
            </p>
            @endif
            @endif

        </div>
    </section>

    <!-- Footer -->
    <x-footer />

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const elements = document.querySelectorAll('.fade-in-text');
        elements.forEach((el, index) => {
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 150 + (index * 200)); // delay bertahap tiap elemen
        });
    });
</script>

</html>