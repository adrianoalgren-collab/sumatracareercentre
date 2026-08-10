<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sumatra Career Centre — Masuk</title>

    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,600;1,700&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/css/login.css', 'resources/js/app.js', 'resources/js/login.js'])
</head>

<body>

    <!-- Navbar -->
    <x-navbar />

    <!-- HERO LOGIN SECTION -->
    <section class="hero login-page">

        <div class="hero-bg"></div>

        <img class="hero-img"
            src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2070&auto=format&fit=crop"
            alt="Career Background" />

        <div class="hero-geo hero-geo-ring"></div>
        <div class="hero-geo hero-geo-ring-inner"></div>
        <div class="hero-geo hero-geo-line"></div>

        <div class="hero-content">

            <!-- LEFT CONTENT -->
            <div>

                <div class="hero-label">
                    <span class="hero-label-bar"></span>
                    Platform Karir Sumatera
                </div>

                <h1 class="hero-title">
                    Bangun Karir <br>
                    Impianmu di <br>
                    <em>Sumatera</em>
                </h1>

                <p class="hero-desc">
                    Menghubungkan lulusan terbaik perguruan tinggi Sumatera
                    dengan perusahaan-perusahaan unggulan di seluruh nusantara.
                </p>

                <div class="stats-row">

                    <div class="stat">
                        <div class="stat-num">12.4K</div>
                        <div class="stat-label">Lowongan Aktif</div>
                    </div>

                    <div class="stat-div"></div>

                    <div class="stat">
                        <div class="stat-num">840+</div>
                        <div class="stat-label">Perusahaan Mitra</div>
                    </div>

                    <div class="stat-div"></div>

                    <div class="stat">
                        <div class="stat-num">96%</div>
                        <div class="stat-label">Tingkat Penempatan</div>
                    </div>

                </div>

            </div>

            <!-- RIGHT LOGIN CARD -->
            <div>

                <div class="hero-card">

                    <h2 class="job-title" style="color: var(--cream);">
                        Selamat Datang Kembali
                    </h2>

                    <p style="color: rgba(242,246,248,0.65); margin-bottom: 22px; padding-bottom: 22px; border-bottom: 1px solid rgba(242,246,248,0.1);">
                        Masuk ke akun Anda untuk melanjutkan.
                    </p>

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf

                        @if(session('error'))
                            <div style="
                                background: rgba(255, 77, 77, 0.12);
                                border: 1px solid rgba(255, 77, 77, 0.25);
                                color: #ffb3b3;
                                padding: 10px 14px;
                                border-radius: 12px;
                                margin-bottom: 14px;
                                font-size: 0.82rem;
                            ">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Role Tabs -->
                        <p style="color: rgba(242,246,248,0.5); font-size: 12px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.06em;">
                            Pilih jenis akun Anda
                        </p>

                        <input type="hidden" name="role" id="role" value="{{ old('role', 'pelamar') }}">

                        <div class="role-tabs">
                            <button type="button" class="role-tab {{ old('role', 'pelamar') === 'pelamar' ? 'active' : '' }}" data-role="pelamar" onclick="setTab(this)">
                                Pelamar
                            </button>

                            <button type="button" class="role-tab {{ old('role') === 'perusahaan' ? 'active' : '' }}" data-role="perusahaan" onclick="setTab(this)">
                                Perusahaan
                            </button>

                            <button type="button" class="role-tab {{ old('role') === 'admin' ? 'active' : '' }}" data-role="admin" onclick="setTab(this)">
                                Admin
                            </button>
                        </div>

                        <!-- Email -->
                        <div class="field-group">
                            <label for="email">Email</label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                required
                            >

                            @error('email')
                                <small style="color:#ffb3b3;">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="field-group">
                            <label for="password">Kata Sandi</label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                            >

                            @error('password')
                                <small style="color:#ffb3b3;">{{ $message }}</small>
                            @enderror

                            <a href="#" class="forgot" style="display:block; margin-top:8px; text-align:right; color: var(--cream);">
                                Lupa sandi?
                            </a>
                        </div>

                        <button type="submit" class="btn-hero-main" style="width:100%; justify-content:center;">
                            Masuk
                        </button>
                    </form>

                    <p class="register-note" style="margin-top: 18px; padding-top: 18px; border-top: 1px solid rgba(242,246,248,0.12);">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Daftarkan karir Anda</a>
                    </p>

                </div>

            </div>

        </div>
    </section>

</body>

</html>