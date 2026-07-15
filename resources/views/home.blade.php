<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sumatra Career Centre</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
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
  <div class="hero-geo hero-geo-ring"></div>
  <div class="hero-geo hero-geo-ring-inner"></div>
  <div class="hero-geo hero-geo-line"></div>

  <img class="hero-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDEg_yuwycErLucfzinzf9qExIurvyl3NdkEhJJmYcsGBsVp6753u6iDPFoGCgXA6B0xW4JivgKj5Ic70HegS61SvFsfNe42-hIvm1mzKOtrn9RDGqq6nzCd0E2zSYnJtk7p29mbiNrOGOdzeFfaVnYoO-9uHMgPemj4x58cF3FFiEg-VSZKCmF0ESw0a-qAkFn2iZHC_V_BA4kbNivirK8VtPhu5jkPaSAMbiWOZbG1ytBg4Zhke41uRwcdhs5EUPwNeV6BBGxQOx" alt="Campus"/>
  <div class="hero-bg"></div>

  <div class="hero-content">
    <div>
  <div class="hero-label">
    <span class="hero-label-bar"></span>
    Platform Karier Terintegrasi Sumatera
  </div>

  <h1 class="hero-title">
    Sumatra Career Centre
  </h1>

  <p class="hero-desc">
    Sumatra Career Centre adalah ekosistem karier modern yang menghubungkan mahasiswa, alumni, dan dunia industri dalam satu platform terpadu.
    Kami membantu membuka akses peluang kerja, pengembangan skill, dan koneksi profesional yang lebih luas untuk membangun masa depan karier yang kompetitif di tingkat nasional maupun global.
  </p>

  <div class="hero-btns">

      @guest
          <!-- BELUM LOGIN -->
          <a href="{{ route('login') }}" class="btn-hero-main"
            style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
              Login Sebagai Pelamar
              <span class="material-icons-round" style="font-size:18px;">arrow_forward</span>
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
              <span class="material-icons-round" style="font-size:18px;">arrow_forward</span>
          </a>

          <a href="{{ route('profil.saya') }}" class="btn-hero-sec"
            style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
              Profile Saya
          </a>
      @endauth

  </div>

</div>

<div class="hero-card">
    <div class="hero-card-label">— Kenapa Memilih SCC</div>

    <ul class="hero-card-list">

        <li class="hero-card-item">
            <div class="hero-card-icon">
                <span class="material-icons-round">verified</span>
            </div>
            <div>
                <span class="hero-card-role">Perusahaan Tervalidasi</span>
                <span class="hero-card-co">
                    Seluruh mitra telah melalui proses verifikasi resmi
                </span>
            </div>
        </li>

        <li class="hero-card-item">
            <div class="hero-card-icon">
                <span class="material-icons-round">bolt</span>
            </div>
            <div>
                <span class="hero-card-role">Proses Rekrutmen Cepat</span>
                <span class="hero-card-co">
                    Perekrutan lebih efisien tanpa proses yang berbelit
                </span>
            </div>
        </li>

        <li class="hero-card-item">
            <div class="hero-card-icon">
                <span class="material-icons-round">school</span>
            </div>
            <div>
                <span class="hero-card-role">Terintegrasi dengan Kampus</span>
                <span class="hero-card-co">
                    Terhubung langsung dengan berbagai perguruan tinggi
                </span>
            </div>
        </li>

        <li class="hero-card-item">
            <div class="hero-card-icon">
                <span class="material-icons-round">track_changes</span>
            </div>
            <div>
                <span class="hero-card-role">Rekomendasi Pekerjaan Pintar</span>
                <span class="hero-card-co">
                    Sistem menyesuaikan lowongan dengan keahlian Anda
                </span>
            </div>
        </li>

    </ul>
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
                <div class="job-logo">
                    <img src="{{ asset('storage/' . $item->gambar_banner) }}" alt="banner">
                </div>

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

      <a href="#" class="link-viewall reveal">
        Lihat Semua
        <span class="material-icons-round" style="font-size:14px;">arrow_forward</span>
      </a>
    </div>

    <div class="news-grid">

      <!-- Featured -->
      <div class="news-card reveal">

        <div class="news-card-img">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCtDwN40H-qJgOgPmm5azwIeIJ9LbN2nYQedgPvFYiCoTNNQrgJBZFFdCgWJATKahk8HDWS6tNo1Ql6xBeKsBsY0tGtR4ANyIpqlz__q6valfVFox-2f3RIELi4nEip3F8WMo543j8HmD8zfktUthQdWIT0l5CH3Ek0FFn6NrehhdkFUin4UQeRyKXAl7nPiyqsYvpNRuuk3s4n1rkTSY6UbUz-vUW-LrmRqHs1LhUGuPSndPoqNL7B_NTMOivR0zl_J4GItDrxaM1d" alt="Workshop"/>
          <div class="news-card-img-overlay"></div>
        </div>

        <div class="news-card-body">

          <div class="news-meta">
            <span class="news-cat">Tren Industri</span>
            <span class="news-dot"></span>
            <span class="news-read">5 Menit Baca</span>
          </div>

          <h3 class="news-title">
            Transformasi Digital Dunia Kerja di Sumatera: Apa yang Perlu Kamu Ketahui
          </h3>

          <p class="news-desc">
            Perkembangan teknologi seperti AI dan otomatisasi mulai mengubah struktur dunia kerja di Indonesia.
            Lulusan diharapkan mampu beradaptasi agar tetap kompetitif di era digital.
          </p>

          <a href="#" class="news-link">
            Baca Selengkapnya
            <span class="material-icons-round" style="font-size:14px;">open_in_new</span>
          </a>

        </div>
      </div>

      <!-- Side stack -->
      <div class="news-side">

        <div class="news-card news-card-sm reveal reveal-delay-1">

          <div class="news-card-img">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGwX5O33d8SEDmw6HQ05XE5ppqwzGxL48QZ4UAWmior_mLDLv6M9fGuVqR_QIyMZU9TN4y7jBJqpePxhcVO30CuVhJNyjZdYP-oShSoEvnSLBZH68a9LDjF6yirDyNv0i8JiS6O9esWgZX69itlThFR-vQKjYd1U7o5NUD8sZ1qFdyTCj7VoyMDOb2pjzTZ6hqXb3g-OhDaVDEsYhcCT74UfRfxLFN4iitAl0NW8KKyIcwC9H8KLAWzBnxZdOU7FPbbQqgDBA1ygGH" alt="Networking"/>
            <div class="news-card-img-overlay"></div>
          </div>

          <div class="news-card-body">

            <div class="news-meta">
              <span class="news-cat">Kisah Sukses</span>
              <span class="news-dot"></span>
              <span class="news-read">8 Menit</span>
            </div>

            <h3 class="news-title">
              Dari Kampus ke Dunia Kerja: Kisah Alumni UNAND di Perusahaan Global
            </h3>

            <p class="news-desc">
              Pengalaman nyata para alumni yang berhasil meniti karier hingga posisi strategis di perusahaan multinasional.
            </p>

            <a href="#" class="news-link">
              Baca Artikel
              <span class="material-icons-round" style="font-size:12px;">open_in_new</span>
            </a>

          </div>
        </div>

        <!-- Newsletter -->
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