<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sumatra Career Centre</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="{{ asset('css/home.css') }}"/>

@vite(['resources/css/app.css', 'resources/js/home.js'])
</head>
<body>

<!-- ═══ NAV ═══ -->
<x-navbar />

<!-- ═══ HERO ═══ -->
<section class="hero">

  <img class="hero-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDEg_yuwycErLucfzinzf9qExIurvyl3NdkEhJJmYcsGBsVp6753u6iDPFoGCgXA6B0xW4JivgKj5Ic70HegS61SvFsfNe42-hIvm1mzKOtrn9RDGqq6nzCd0E2zSYnJtk7p29mbiNrOGOdzeFfaVnYoO-9uHMgPemj4x58cF3FFiEg-VSZKCmF0ESw0a-qAkFn2iZHC_V_BA4kbNivirK8VtPhu5jkPaSAMbiWOZbG1ytBg4Zhke41uRwcdhs5EUPwNeV6BBGxQOx" alt="Campus"/>
  <div class="hero-bg"></div>

  <div class="hero-content">
    <div>
  <div class="hero-label">
    <span class="hero-label-bar"></span>
    Platform Karier Terintegrasi Sumatera
  </div>

  <h1 class="hero-title">
      <em>Platform Karir</em><br>
      Sumatra Career Centre
  </h1>

  <p class="hero-desc">
    Ekosistem karier modern yang menghubungkan mahasiswa, alumni, dan dunia industri dalam satu platform terpadu.
    Kami membantu membuka akses peluang kerja, pengembangan skill, dan koneksi profesional yang lebih luas untuk membangun masa depan karier yang kompetitif di tingkat nasional maupun global.
  </p>

  <div class="hero-btns">

      @guest
          <!-- BELUM LOGIN -->
          <a href="{{ route('login') }}" class="btn-hero-main"
            style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
              Login Sebagai Pelamar
          </a>

          <a href="" class="btn-hero-sec"
            style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
              Login Sebagai Perusahaan
          </a>
      @endguest


      @auth
          <!-- SUDAH LOGIN -->
          <a href="{{ route('lowongan.pekerjaan') }}" class="btn-hero-main"
            style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
              Lihat Lowongan
          </a>

          <a href="{{ route('profil.saya') }}" class="btn-hero-sec"
            style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
              Profile Saya
          </a>
      @endauth

  </div>

</div>

</section>

<!-- ═══ STATS ═══ -->
<div class="stats-band">
  <div class="stats-inner">
    <div class="stat-cell reveal">
      <div class="stat-icon"><span class="material-icons-round">groups</span></div>
      <div class="stat-number">206</div>
      <div class="stat-label">TOTAL PELAMAR</div>
    </div>

    <div class="stat-cell reveal reveal-delay-1">
      <div class="stat-icon"><span class="material-icons-round">apartment</span></div>
      <div class="stat-number">14</div>
      <div class="stat-label">TOTAL PERUSAHAAN</div>
    </div>

    <div class="stat-cell reveal reveal-delay-2">
      <div class="stat-icon"><span class="material-icons-round">work</span></div>
      <div class="stat-number">397</div>
      <div class="stat-label">TOTAL LOWONGAN BUKA</div>
    </div>

    <div class="stat-cell reveal reveal-delay-3">
      <div class="stat-icon"><span class="material-icons-round">lock</span></div>
      <div class="stat-number">0</div>
      <div class="stat-label">TOTAL LOWONGAN TUTUP</div>
    </div>
  </div>
</div>

<!-- ═══ JOBS ═══ -->
<section class="section jobs-section">
  <div class="section-inner">

    <div class="section-header">
      <div class="reveal">
        <div class="section-eyebrow">Peluang Terbaru</div>
        <h2 class="section-title">Lowongan Pekerjaan Terbaru</h2>
        <p class="section-sub">
          Temukan berbagai peluang karier terbaik dari perusahaan terpercaya di seluruh Sumatera.
          Mulai dari industri teknologi, keuangan, hingga sektor strategis lainnya yang siap membantu Anda mengembangkan masa depan profesional.
        </p>
      </div>

      <a href="{{ route('lowongan.pekerjaan') }}" class="link-viewall reveal" style="text-decoration:none;">
          Lihat Semua Lowongan
          <span class="material-icons-round" style="font-size:14px;">arrow_forward</span>
      </a>
    </div>

    <div class="jobs-grid">

        @foreach($lowongan as $item)

        <div class="job-card reveal">

            <div class="job-card-header">
                

                <div class="job-tags">
                    <span class="tag tag-type">{{ $item->kategori_label }}</span>
                    <span class="tag tag-open">{{ $item->status_lowongan }}</span>
                </div>
            </div>

            <h3 class="job-title">{{ $item->judul_lowongan }}</h3>

            <p class="job-company">
                <span class="material-icons-round">business</span>
                {{ $item->perusahaan->nama_perusahaan }} · {{ $item->lokasi }}
            </p>

            <div class="job-skills">
                @foreach($item->jurusan as $jurusan)
                    <span class="skill-tag">{{ $jurusan->nama_jurusan }}</span>
                @endforeach
            </div>

            <a href="{{ route('detail.lowongan.pekerjaan', $item->id) }}" class="btn-apply" style="text-decoration: none;">
              Lamar Sekarang
          </a>

        </div>

        @endforeach

    </div>

  </div>
</section>

<!-- ═══ NEWS ═══ -->
<section class="section news-section">
  <div class="section-inner">

    <div class="section-header">
      <div class="reveal">
        <div class="section-eyebrow">Wawasan & Berita</div>
        <h2 class="section-title">Berita & Insight Karier</h2>
      </div>

      <a href="{{ route('artikel') }}" class="link-viewall reveal">
        Lihat Semua
        <span class="material-icons-round" style="font-size:14px;">arrow_forward</span>
      </a>
    </div>

    @if($featured)
    <div class="news-grid">

      <!-- Featured -->
      <a href="{{ route('artikel.detail', $featured->slug) }}" class="news-card reveal" style="text-decoration:none; color:inherit;">

        <div class="news-card-img">
          <img src="{{ $featured->gambar_utama ? asset('storage/'.$featured->gambar_utama) : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000&auto=format&fit=crop' }}" alt="{{ $featured->judul }}"/>
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
        <a href="{{ route('artikel.detail', $item->slug) }}" class="news-card news-card-sm reveal reveal-delay-1" style="text-decoration:none; color:inherit;">

          <div class="news-card-img">
            <img src="{{ $item->gambar_utama ? asset('storage/'.$item->gambar_utama) : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $item->judul }}"/>
            <div class="news-card-img-overlay"></div>
          </div>

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
        <div class="news-card news-card-sm reveal reveal-delay-2"
             style="background:rgba(238,21,42,0.07); border-color:rgba(238,21,42,0.18);">

          <div class="news-card-body"
               style="padding:28px; display:flex; flex-direction:column; justify-content:center; gap:10px;">

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
                font-family:'DM Sans',sans-serif; font-size:0.875rem; outline:none;"/>

              <button class="btn-apply"
                style="width:auto; padding:10px 20px; border-radius:4px; white-space:nowrap; font-size:0.8125rem;">
                Subscribe
              </button>
            </div>

          </div>

        </div>

      </div>

    </div>
    @else
    <p style="text-align:center; padding:40px 0; color:var(--smoke); font-family:'DM Sans', sans-serif;">
      Belum ada artikel yang tersedia saat ini.
    </p>
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

<!-- ═══ FOOTER ═══ -->
<x-footer />

<script src="{{ asset('js/home.js') }}"></script>
</body>
</html>