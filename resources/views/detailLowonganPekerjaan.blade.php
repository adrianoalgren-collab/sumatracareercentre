<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lowongan->judul_lowongan }} - Sumatra Career Centre</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/detail-lowongan.js'])

    <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}">
</head>

<body>

    <x-navbar />

    {{-- ================= SKELETON ================= --}}
    <div id="skeletonWrap">

        {{-- HEADER SKELETON --}}
        <section class="section" style="padding-top: 140px; padding-bottom: 40px;">
            <div class="section-inner">
                <div class="job-card">
                    <div style="display: flex; justify-content: space-between; gap: 30px; flex-wrap: wrap; align-items: center;">

                        <div style="flex: 1; min-width: 280px;">
                            <div class="skeleton-block" style="width: 120px; height: 16px; margin-bottom: 14px;"></div>
                            <div class="skeleton-block" style="width: 70%; height: 32px; margin-bottom: 14px;"></div>
                            <div class="skeleton-block" style="width: 40%; height: 16px; margin-bottom: 18px;"></div>
                            <div style="display: flex; gap: 10px;">
                                <div class="skeleton-block" style="width: 90px; height: 26px; border-radius: 20px;"></div>
                                <div class="skeleton-block" style="width: 90px; height: 26px; border-radius: 20px;"></div>
                            </div>
                        </div>

                        <div style="min-width: 260px;">
                            <div class="skeleton-block" style="width: 100%; height: 44px; border-radius: 10px; margin-bottom: 12px;"></div>
                            <div class="skeleton-block" style="width: 100%; height: 44px; border-radius: 10px; margin-bottom: 12px;"></div>
                            <div class="skeleton-block" style="width: 80%; height: 14px; margin: 0 auto;"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- STATS SKELETON --}}
        <section class="stats-band">
            <div class="stats-inner">
                @for ($i = 0; $i < 4; $i++)
                    <div class="stat-cell">
                        <div class="skeleton-block" style="width: 60px; height: 28px; margin: 0 auto 10px;"></div>
                        <div class="skeleton-block" style="width: 100px; height: 12px; margin: 0 auto;"></div>
                    </div>
                @endfor
            </div>
        </section>

        {{-- CONTENT SKELETON --}}
        <section class="section">
            <div class="section-inner">
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px; align-items: start;">

                    {{-- LEFT --}}
                    <div>
                        {{-- IMAGE --}}
                        <div class="job-card" style="padding: 0; margin-bottom: 32px; overflow: hidden;">
                            <div class="skeleton-block" style="width: 100%; height: 720px; border-radius: 0;"></div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="job-card" style="margin-bottom: 32px;">
                            <div class="skeleton-block" style="width: 220px; height: 22px; margin-bottom: 18px;"></div>
                            <div class="skeleton-block" style="width: 100%; height: 14px; margin-bottom: 10px;"></div>
                            <div class="skeleton-block" style="width: 100%; height: 14px; margin-bottom: 10px;"></div>
                            <div class="skeleton-block" style="width: 80%; height: 14px;"></div>
                        </div>

                        {{-- REQUIREMENTS --}}
                        <div class="jobs-grid" style="grid-template-columns: 1fr 1fr;">
                            @for ($i = 0; $i < 2; $i++)
                                <div class="job-card">
                                    <div class="skeleton-block" style="width: 150px; height: 18px; margin-bottom: 18px;"></div>
                                    <div class="skeleton-block" style="width: 90%; height: 12px; margin-bottom: 10px;"></div>
                                    <div class="skeleton-block" style="width: 80%; height: 12px; margin-bottom: 10px;"></div>
                                    <div class="skeleton-block" style="width: 85%; height: 12px;"></div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- RIGHT / ASIDE --}}
                    <aside>
                        <div class="job-card">
                            <div class="skeleton-block" style="width: 180px; height: 18px; margin-bottom: 22px;"></div>

                            @for ($i = 0; $i < 4; $i++)
                                <div style="margin-bottom: 18px;">
                                    <div class="skeleton-block" style="width: 110px; height: 11px; margin-bottom: 8px;"></div>
                                    <div class="skeleton-block" style="width: 150px; height: 16px;"></div>
                                </div>
                            @endfor

                            <div class="skeleton-block" style="width: 100%; height: 44px; border-radius: 10px; margin-top: 10px;"></div>
                        </div>

                        {{-- KOMENTAR --}}
                        <div class="job-card" style="margin-top: 24px;">
                            <div class="skeleton-block" style="width: 200px; height: 18px; margin-bottom: 20px;"></div>

                            @for ($i = 0; $i < 2; $i++)
                                <div style="padding: 18px; background: #f8fafc; border-radius: 12px; margin-bottom: 12px;">
                                    <div class="skeleton-block" style="width: 120px; height: 14px; margin-bottom: 10px;"></div>
                                    <div class="skeleton-block" style="width: 90%; height: 12px;"></div>
                                </div>
                            @endfor

                            <div class="skeleton-block" style="width: 100%; height: 120px; border-radius: 12px; margin-top: 6px;"></div>
                        </div>
                    </aside>

                </div>
            </div>
        </section>

    </div>

    {{-- ================= KONTEN ASLI ================= --}}
    <div id="realContent">

        {{-- HEADER --}}
        <section class="section" style="padding-top: 140px; padding-bottom: 40px;">
            <div class="section-inner">

                <div class="job-card">
                    <div style="display: flex; justify-content: space-between; gap: 30px; flex-wrap: wrap; align-items: center;">

                        {{-- LEFT --}}
                        <div>
                            <div class="section-eyebrow">
                                {{ $lowongan->kategori_label }}
                            </div>

                            <h1 class="section-title" style="margin-bottom: 14px;">
                                {{ $lowongan->judul_lowongan }}
                            </h1>

                            <p class="job-company" style="font-size: 1rem;">
                                {{ $lowongan->perusahaan?->nama_perusahaan }} • {{ $lowongan->lokasi }}
                            </p>

                            <div class="job-skills" style="margin-top: 18px;">
                                @foreach ($lowongan->jurusan as $item)
                                    <span class="skill-tag">{{ $item->nama_jurusan }}</span>
                                @endforeach
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div style="min-width: 260px;">
                            <x-button-lamar-sekarang :lowongan="$lowongan" />

                            <x-button-bagikan-lowongan :lowongan="$lowongan" />

                            <p style="margin-top: 6px; font-size: 13px; color: #5a7480; text-align: center;">
                                Deadline: {{ \Carbon\Carbon::parse($lowongan->deadline)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        {{-- STATS --}}
        <section class="stats-band">
            <div class="stats-inner">

                <div class="stat-cell">
                    <div class="stat-number">{{ $lowongan->jumlah_lowongan_dibuka }}</div>
                    <div class="stat-label">Lowongan Dibuka</div>
                </div>

                <div class="stat-cell">
                    <div class="stat-number">{{ $lowongan->total_pendaftar }}</div>
                    <div class="stat-label">Total Pendaftar</div>
                </div>

                <div class="stat-cell">
                    <div class="stat-number">{{ $lowongan->total_interview }}</div>
                    <div class="stat-label">Dipanggil Interview</div>
                </div>

                <div class="stat-cell">
                    <div class="stat-number">{{ $lowongan->tanggal_deadline_label }}</div>
                    <div class="stat-label">Deadline</div>
                </div>

            </div>
        </section>

        {{-- CONTENT --}}
        <section class="section">
            <div class="section-inner">

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px; align-items: start;">

                    {{-- LEFT SIDE --}}
                    <div>

                        {{-- IMAGE --}}
                        <div class="job-card" style="padding: 0; margin-bottom: 32px;">
                            <div class="job-card-image" style="height: 720px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <img
                                    src="{{ asset('storage/' . $lowongan->gambar_banner) }}"
                                    alt="{{ $lowongan->judul_lowongan }}"
                                    style="width: 100%; height: 100%; object-fit: contain; object-position: center;">
                            </div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="job-card" style="margin-bottom: 32px;">
                            <h2 class="job-title">Deskripsi Pekerjaan</h2>
                            <p class="job-desc">{{ $lowongan->deskripsi_pekerjaan }}</p>
                        </div>

                        {{-- REQUIREMENTS --}}
                        <div class="jobs-grid" style="grid-template-columns: 1fr 1fr;">

                            {{-- SYARAT KHUSUS --}}
                            <div class="job-card">
                                <h3 class="job-title">Syarat Khusus</h3>

                                <ul style="margin-top: 18px; padding-left: 18px; color: #5a7480; line-height: 1.9;">
                                    @foreach ($lowongan->syaratKhusus as $item)
                                        <li>{{ $item->syarat_khusus }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- SYARAT UMUM --}}
                            <div class="job-card">
                                <h3 class="job-title">Syarat Umum</h3>

                                <ul style="margin-top: 18px; padding-left: 18px; color: #5a7480; line-height: 1.9;">
                                    @foreach ($lowongan->syaratUmum as $item)
                                        <li>{{ $item->syarat_umum }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                    </div>

                    {{-- RIGHT SIDE --}}
                    <aside>

                        <div class="job-card">

                            <h3 class="job-title">Informasi Pekerjaan</h3>

                            <div style="margin-top: 22px; display: flex; flex-direction: column; gap: 18px;">

                                <div>
                                    <small class="job-company">Jumlah Dibutuhkan</small>
                                    <div><strong>{{ $lowongan->jumlah_lowongan_dibuka }} Orang</strong></div>
                                </div>

                                <div>
                                    <small class="job-company">Status</small>
                                    <div><strong>{{ ucfirst($lowongan->status_lowongan) }}</strong></div>
                                </div>

                                <div>
                                    <small class="job-company">Penempatan</small>
                                    <div><strong>{{ $lowongan->lokasi }}</strong></div>
                                </div>

                                <div>
                                    <small class="job-company">Perusahaan</small>
                                    <div><strong>{{ $lowongan->perusahaan?->nama_perusahaan }}</strong></div>
                                </div>

                                

                            </div>

                        </div>

                        {{-- KOMENTAR --}}
                        <div class="job-card" style="margin-top: 24px;">
                            <h3 class="job-title">Diskusi & Komentar</h3>

                            {{-- LIST KOMENTAR (SCROLLABLE) --}}
                            <div style="margin-top: 20px; max-height: 260px; overflow-y: auto; display: flex; flex-direction: column; gap: 18px; padding-right: 8px;">

                                @forelse ($lowongan->komentar as $item)
                                    <div style="padding: 18px; background: #f8fafc; border-radius: 12px;">

                                        {{-- HEADER --}}
                                        <div style="display: flex; justify-content: space-between; align-items: center;">

                                            <strong>{{ $item->user?->name ?? $item->nama_user }}</strong>

                                            @auth
                                                @if ($item->user_id == auth()->id())
                                                    {{-- DROPDOWN SIMPLE (NO JS) --}}
                                                    <div style="position: relative;">
                                                        <details style="cursor: pointer;">
                                                            <summary style="list-style: none; font-size: 18px;">⋮</summary>

                                                            <div style="position: absolute; right: 0; margin-top: 8px; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; min-width: 120px; z-index: 10;">
                                                                <form action="{{ route('komentar.delete', $item->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Hapus komentar ini?')">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit"
                                                                            style="width: 100%; text-align: left; padding: 10px; background: none; border: none; color: red; cursor: pointer;">
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </details>
                                                    </div>
                                                @endif
                                            @endauth

                                        </div>

                                        {{-- ISI KOMENTAR --}}
                                        <span style="color: #475569;">{{ $item->isi_komentar }}</span>

                                    </div>
                                @empty
                                    <div style="padding: 18px; background: #f8fafc; border-radius: 12px; color: #64748b;">
                                        Belum ada komentar.
                                    </div>
                                @endforelse

                            </div>

                            {{-- FORM KOMENTAR (TETAP DI LUAR SCROLL) --}}
                            <form action="{{ route('komentar.store', $lowongan->id) }}" method="POST" style="margin-top: 18px;">
                                @csrf

                                <textarea
                                    name="isi_komentar"
                                    placeholder="Tulis komentar..."
                                    style="width: 100%; height: 120px; padding: 16px; border: 1px solid #ddd; border-radius: 12px;"
                                    required></textarea>

                                <button type="submit" class="btn-apply" style="margin-top: 12px;">
                                    Kirim Komentar
                                </button>
                            </form>

                        </div>

                    </aside>

                </div>

            </div>
        </section>

    </div>

    <x-footer />

    <script src="{{ asset('js/detail-lowongan.js') }}"></script>

</body>
</html>