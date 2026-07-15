<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Sumatra Career Centre</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Playfair+Display:wght@700;800&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapiscom/icon?family=Material+Icons+Round"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/about-us.js'])

    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    <x-navbar />

    <!-- HERO SPLIT LAYOUT -->
    <section
        class="hero"
        style="background:#f7fbfc; min-height:auto; padding:140px 0 80px;"
    >
        <div
            class="section-inner"
            style="display:grid; grid-template-columns:1.1fr .9fr; gap:60px; align-items:center;"
        >

            <div>
                <div class="section-eyebrow">
                    Who We Are
                </div>

                <h1
                    class="section-title"
                    style="font-size: clamp(2.5rem,5vw,4.5rem); margin-bottom:20px;"
                >
                    Building Careers,<br>
                    Creating Futures.
                </h1>

                <p
                    class="section-sub"
                    style="max-width:560px; margin-bottom:32px;"
                >
                    Sumatra Career Centre hadir sebagai pusat pengembangan karir modern
                    yang menghubungkan mahasiswa, alumni, dan industri melalui ekosistem
                    profesional yang terintegrasi.
                </p>

                <div class="hero-btns">
                    <a href="{{ route('lowongan.pekerjaan') }}" class="btn-hero-main" style="text-decoration:none;">
                        Explore Careers
                    </a>

                  @auth
                        <a href="{{ route('profil.saya') }}" class="btn-hero-sec" style="color:#004B5F; border-color:#004B5F; text-decoration:none;">
                            Lihat Profil Saya
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-hero-sec" style="color:#004B5F; border-color:#004B5F; text-decoration:none;">
                            Gabung Bersama Kami
                        </a>
                    @endauth
                </div>
            </div>

            <div style="position:relative;">
                <img
                    src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                    alt="Team"
                    style="width:100%; border-radius:24px; box-shadow:0 30px 80px rgba(0,0,0,.08); object-fit:cover; height:520px;"
                >

                <div
                    style="position:absolute; bottom:-30px; left:-30px; background:white; padding:28px; border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,.08); max-width:280px;"
                >
                    <h3 style="font-size:2rem; color:#004B5F; font-weight:800;">
                        10.000+
                    </h3>

                    <p style="color:#5a7480;">
                        Alumni telah terhubung dengan peluang kerja terbaik di berbagai industri.
                    </p>
                </div>
            </div>

        </div>
    </section>


    <!-- TIMELINE SECTION -->
    <section
        class="section"
        style="background:white;"
    >
        <div class="section-inner">

            <div
                class="section-header"
                style="margin-bottom:60px;"
            >
                <div>
                    <div class="section-eyebrow">
                        Our Journey
                    </div>

                    <h2 class="section-title">
                        Perjalanan Kami
                    </h2>
                </div>
            </div>

            <div
                style="display:grid; grid-template-columns:repeat(3,1fr); gap:28px;"
            >

                <div class="job-card">
                    <div class="tag tag-type">2024</div>
                    <h3 class="job-title">Founded</h3>
                    <p class="section-sub">
                        Memulai platform untuk menjembatani mahasiswa dengan dunia industri profesional.
                    </p>
                </div>

                <div class="job-card">
                    <div class="tag tag-type">2025</div>
                    <h3 class="job-title">Expansion</h3>
                    <p class="section-sub">
                        Berkolaborasi dengan puluhan kampus dan ratusan perusahaan nasional.
                    </p>
                </div>

                <div class="job-card">
                    <div class="tag tag-type">2026</div>
                    <h3 class="job-title">Global Impact</h3>
                    <p class="section-sub">
                        Mendorong koneksi karir global untuk talenta terbaik Sumatera.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- VALUES SECTION -->
<!-- VISI MISI SECTION -->
<section class="section news-section">
    <div class="section-inner">

        <div class="section-header">
            <div>
                <div class="section-eyebrow">
                    Our Purpose
                </div>

                <h2 class="section-title">
                    Visi & Misi Kami
                </h2>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:24px;">

            <!-- Visi -->
            <div class="news-card" style="grid-column: span 2;">
                <div class="news-card-body">
                    <h3 class="news-title" style="font-size:1.75rem; margin-bottom:16px;">
                        Visi
                    </h3>

                    <p class="news-desc" style="font-size:1.15rem; line-height:1.7;">
                        Menjadi institusi karir yang mewadahi para alumni yang berbasis IT
                        dalam menyajikan informasi karir, pengembangan diri, dan pelayanan
                        rekrutmen.
                    </p>
                </div>
            </div>

            <!-- Misi 1 -->
            <div class="news-card">
                <div class="news-card-body">
                    <h3 class="news-title" style="font-size:1.4rem; margin-bottom:14px;">
                        Misi 01
                    </h3>

                    <p class="news-desc" style="font-size:1.05rem; line-height:1.7;">
                        Membangun organisasi yang mewadahi alumni dan menjadi tempat
                        untuk menjalin komunikasi dan silaturahmi bagi alumni.
                    </p>
                </div>
            </div>

            <!-- Misi 2 -->
            <div class="news-card">
                <div class="news-card-body">
                    <h3 class="news-title" style="font-size:1.4rem; margin-bottom:14px;">
                        Misi 02
                    </h3>

                    <p class="news-desc" style="font-size:1.05rem; line-height:1.7;">
                        Menjadi career center pertama yang mengedepankan inovasi,
                        profesionalisme, saling menghargai, dan religius.
                    </p>
                </div>
            </div>

            <!-- Misi 3 -->
            <div class="news-card">
                <div class="news-card-body">
                    <h3 class="news-title" style="font-size:1.4rem; margin-bottom:14px;">
                        Misi 03
                    </h3>

                    <p class="news-desc" style="font-size:1.05rem; line-height:1.7;">
                        Memberikan informasi rekrutmen dan karir yang terpercaya,
                        serta program pengembangan diri kepada mahasiswa dan alumni.
                    </p>
                </div>
            </div>

            <!-- Misi 4 -->
            <div class="news-card">
                <div class="news-card-body">
                    <h3 class="news-title" style="font-size:1.4rem; margin-bottom:14px;">
                        Misi 04
                    </h3>

                    <p class="news-desc" style="font-size:1.05rem; line-height:1.7;">
                        Memberikan layanan rekrutmen yang efektif dan solutif
                        kepada perusahaan.
                    </p>
                </div>
            </div>

            <!-- Misi 5 -->
            <div class="news-card" style="grid-column: span 2;">
                <div class="news-card-body">
                    <h3 class="news-title" style="font-size:1.4rem; margin-bottom:14px;">
                        Misi 05
                    </h3>

                    <p class="news-desc" style="font-size:1.05rem; line-height:1.7;">
                        Memberikan dukungan pada kampus dalam pengembangan karir
                        mahasiswa dan alumni, serta kerja sama dengan dunia industri.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


    <!-- TESTIMONIAL SECTION -->
    <!-- TESTIMONIAL SECTION -->
<section
    class="section"
    style="background:#f8fbfc;"
>
    <div class="section-inner">

        <div class="section-header">
            <div>
                <div class="section-eyebrow">
                    Testimonials
                </div>

                <h2 class="section-title">
                    Apa Kata Mereka
                </h2>

                <p class="section-sub">
                    Dengarkan pengalaman mahasiswa, alumni, dan mitra perusahaan
                    yang telah berkembang bersama Sumatra Career Centre.
                </p>
            </div>
        </div>

        <div
            style="display:grid; grid-template-columns:repeat(3,1fr); gap:28px;"
        >

            <div class="job-card">
                <p class="section-sub" style="font-style:italic; margin-bottom:20px;">
                    "SCC membantu saya mendapatkan pekerjaan bahkan sebelum wisuda.
                    Sistemnya sangat membantu dan profesional."
                </p>

                <h3 class="job-title">
                    Adinda Pertiwi
                </h3>

                <p class="job-company">
                    Alumni Universitas Andalas
                </p>
            </div>

            <div class="job-card">
                <p class="section-sub" style="font-style:italic; margin-bottom:20px;">
                    "Kami menemukan banyak kandidat berkualitas melalui platform ini.
                    Sangat efektif untuk proses rekrutmen."
                </p>

                <h3 class="job-title">
                    Budi Santoso
                </h3>

                <p class="job-company">
                    HR Manager - Tech Company
                </p>
            </div>

            <div class="job-card">
                <p class="section-sub" style="font-style:italic; margin-bottom:20px;">
                    "Proses melamar jadi jauh lebih mudah dan transparan.
                    Saya bisa pantau status lamaran kapan saja."
                </p>

                <h3 class="job-title">
                    Rina Wulandari
                </h3>

                <p class="job-company">
                    Alumni Universitas Riau
                </p>
            </div>

        </div>
    </div>
</section>


    <!-- CTA -->
    <section class="cta-band">
        <div class="cta-band-inner">

            <h2 class="cta-title">
                Ready to Grow With Us?
            </h2>

            <p class="cta-desc">
                Bergabung bersama ribuan mahasiswa dan alumni untuk membangun
                masa depan karir yang lebih kuat.
            </p>

            <div class="cta-btns">
                @auth
                    <a href="{{ route('lowongan.pekerjaan') }}" class="btn-cta-dark" style="text-decoration:none;">
                        Cari Lowongan
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-cta-dark" style="text-decoration:none;">
                        Join Now
                    </a>
                @endauth

                <a href="mailto:info@sumatracareer.com" class="btn-cta-out" style="text-decoration:none;">
                    Contact Team
                </a>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <x-footer />

    <script src="{{ asset('js/about.js') }}"></script>

</body>

</html>