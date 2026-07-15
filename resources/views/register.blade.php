<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sumatra Career Centre — Daftar</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/register.css', 'resources/js/app.js', 'resources/js/register.js'])
</head>

<body>


    <x-modal-success />
    <!-- Navbar -->
     
    <x-navbar />

    <!-- HERO REGISTER SECTION -->
    <section class="hero register-page">

        <div class="hero-bg"></div>

        <img class="hero-img"
            src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2070&auto=format&fit=crop"
            alt="Career Background" />

        <!-- geometric -->
        <div class="hero-geo hero-geo-ring"></div>
        <div class="hero-geo hero-geo-ring-inner"></div>
        <div class="hero-geo hero-geo-line"></div>

        <div class="hero-content">

            <!-- LEFT CONTENT -->
            <div>

                <div class="hero-label">
                    <span class="hero-label-bar"></span>
                    Registrasi Pelamar
                </div>

                <h1 class="hero-title">
                    Mulai Perjalanan Karirmu di <em>Sumatera</em>
                </h1>

                <p class="hero-desc">
                    Daftarkan dirimu dan temukan peluang kerja terbaik dari
                    perusahaan-perusahaan unggulan di seluruh Indonesia.
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

            <!-- RIGHT REGISTER CARD -->
            <div>

                <div class="hero-card">

                    <div class="hero-card-label">
                        Register Portal
                    </div>

                    <h2 class="job-title" style="color: var(--cream);">
                        Buat Akun Baru
                    </h2>

                    <p style="color: rgba(242,246,248,0.65);">
                        Lengkapi data berikut untuk memulai perjalanan karirmu.
                    </p>

                    @if ($errors->any())
                        <div class="hero-card-alert">
                            Periksa kembali data yang kamu isi, ada beberapa yang belum sesuai.
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <!-- Halaman ini khusus registrasi pelamar -->
                        <input type="hidden" name="role" value="pelamar">

                        <!-- Nama & Email berdampingan -->
                        <div class="field-row">
                            <div class="field-group">
                                <label for="nama">Nama Pelamar</label>
                                <input type="text" id="nama" name="name" value="{{ old('name') }}" placeholder="Nama lengkap">
                                @error('name')<p class="field-error">{{ $message }}</p>@enderror
                            </div>

                            <div class="field-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com">
                                @error('email')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <!-- Password & Konfirmasi berdampingan -->
                        <div class="field-row">
                            <div class="field-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" placeholder="••••••••">
                                @error('password')<p class="field-error">{{ $message }}</p>@enderror
                            </div>

                            <div class="field-group">
                                <label for="confirm_password">Konfirmasi</label>
                                <input type="password" id="confirm_password" name="password_confirmation" placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="field-group">
                            <label for="phone">No Handphone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                            @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <!-- Button -->
                        <button type="submit" class="btn-hero-main" style="width:100%; justify-content:center;">
                            Daftar Sekarang
                        </button>

                        <p class="register-note">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Masuk di sini</a>
                        </p>

                    </form>

                </div>

            </div>

        </div>
    </section>

</body>

</html>