<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $artikel->judul }} | Sumatra Career Centre</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
</head>

<body style="background:var(--cream); font-family:'DM Sans',sans-serif; color:var(--charcoal);">

<x-navbar />

<main style="padding-top:70px;">

    {{-- ================= ARTICLE HEADER ================= --}}
    <section class="section" style="padding-bottom:0;">
        <div class="section-inner" style="max-width:800px;">

            <a href="{{ route('artikel') }}" class="link-viewall" style="margin-bottom:28px;">
                <span class="material-icons-round" style="font-size:16px;">arrow_back</span>
                Kembali ke Artikel
            </a>

            <div class="job-meta" style="margin-top:24px;">
                <span>{{ $artikel->kategori }}</span>
                <span>{{ $artikel->tanggal_label }}</span>
                <span>{{ $artikel->waktu_baca_label }}</span>
            </div>

            <h1 class="section-title" style="font-size:clamp(1.75rem,4vw,2.75rem); line-height:1.2;">
                {{ $artikel->judul }}
            </h1>

            <div style="display:flex; align-items:center; gap:12px; margin-top:24px;">
                <div style="width:44px; height:44px; border-radius:50%; overflow:hidden; background:var(--sand); flex-shrink:0;">
                    <img src="{{ $artikel->penulis_foto ? asset('storage/'.$artikel->penulis_foto) : 'https://i.pravatar.cc/150?img=32' }}" alt="{{ $artikel->penulis_nama }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div>
                    <p style="font-size:0.875rem; font-weight:600; color:var(--forest);">{{ $artikel->penulis_nama }}</p>
                    <p style="font-size:0.75rem; color:var(--smoke);">{{ $artikel->penulis_jabatan }}</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ================= FEATURED IMAGE ================= --}}
    <section class="section" style="padding-top:32px; padding-bottom:0;">
        <div class="section-inner" style="max-width:1000px;">
            <div style="border-radius:20px; overflow:hidden; box-shadow:0 20px 60px rgba(0,75,95,0.12);">
                <img src="{{ $artikel->gambar_utama ? asset('storage/'.$artikel->gambar_utama) : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200' }}" alt="{{ $artikel->judul }}" style="width:100%; max-height:520px; object-fit:cover; display:block;">
            </div>
        </div>
    </section>

    {{-- ================= BODY + SIDEBAR SHARE ================= --}}
    <section class="section">
        <div class="section-inner" style="max-width:800px; display:grid; grid-template-columns:56px 1fr; gap:32px;">

            {{-- SHARE RAIL --}}
            <div class="share-rail">
                <span class="share-rail-label">Bagikan</span>
                <button class="share-btn" aria-label="Bagikan ke Facebook">
                    <span class="material-icons-round">facebook</span>
                </button>
                <button class="share-btn" aria-label="Bagikan ke Twitter/X">
                    <span class="material-icons-round">alternate_email</span>
                </button>
                <button class="share-btn" aria-label="Salin tautan">
                    <span class="material-icons-round">link</span>
                </button>
            </div>

            {{-- ARTICLE BODY --}}
            <article class="article-body">
                {!! $artikel->konten !!}
            </article>

        </div>
    </section>

    {{-- ================= TAGS ================= --}}
    <section class="section" style="padding-top:0;">
        <div class="section-inner" style="max-width:800px;">
            <div class="job-skills" style="margin-bottom:0;">
                @foreach($artikel->tags_array as $tag)
                    <span class="skill-tag">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= AUTHOR CARD ================= --}}
    <section class="section" style="padding-top:0;">
        <div class="section-inner" style="max-width:800px;">
            <div class="job-card" style="display:flex; align-items:center; gap:20px; padding:28px;">
                <div style="width:64px; height:64px; border-radius:50%; overflow:hidden; background:var(--sand); flex-shrink:0;">
                    <img src="{{ $artikel->penulis_foto ? asset('storage/'.$artikel->penulis_foto) : 'https://i.pravatar.cc/150?img=32' }}" alt="{{ $artikel->penulis_nama }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div>
                    <p class="hero-card-label" style="color:var(--jade); margin-bottom:6px;">Ditulis Oleh</p>
                    <h3 class="job-title" style="margin-bottom:4px;">{{ $artikel->penulis_nama }}</h3>
                    <p class="job-company" style="margin-bottom:0;">{{ $artikel->penulis_bio }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= RELATED ARTICLES ================= --}}
    <section class="section news-section">
        <div class="section-inner">
            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Baca Juga</span>
                    <h2 class="section-title">Artikel Terkait</h2>
                </div>
            </div>

            <div class="jobs-grid">

                @foreach($related as $item)
                <a href="{{ route('artikel.detail', $item->slug) }}" style="text-decoration:none; color:inherit;">
                    <div class="news-card">
                        <div class="news-card-img">
                            <img src="{{ $item->gambar_utama ? asset('storage/'.$item->gambar_utama) : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800' }}" alt="{{ $item->judul }}">
                            <div class="news-card-img-overlay"></div>
                        </div>
                        <div class="news-card-body">
                            <div class="news-meta">
                                <span class="news-cat">{{ $item->kategori }}</span>
                                <span class="news-dot"></span>
                                <span class="news-read">{{ $item->waktu_baca_menit }} menit</span>
                            </div>
                            <h3 class="news-title">{{ $item->judul }}</h3>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </section>

</main>

<x-footer />

</body>
</html>