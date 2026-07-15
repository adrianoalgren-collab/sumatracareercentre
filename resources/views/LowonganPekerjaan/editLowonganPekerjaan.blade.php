@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Edit Lowongan Pekerjaan</h2>
            <p class="section-subtitle">
                Perbarui data lowongan pekerjaan pada sistem
            </p>
        </div>

        <a href="{{ route('LowonganPekerjaan.indexLowonganPekerjaan') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group">
                    <label>
                        Judul Lowongan
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: Staff Administrasi, Web Developer, Digital Marketing)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="judul_lowongan"
                        class="form-control"
                        value="{{ $lowongan->judul_lowongan }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Perusahaan</label>
                    <select name="perusahaan_id" class="form-control" required>
                        <option value="">-- Pilih Perusahaan --</option>

                        @foreach ($perusahaan as $item)
                            <option
                                value="{{ $item->id }}"
                                {{ $lowongan->perusahaan_id == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nama_perusahaan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Lokasi
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: Medan, Pekanbaru, Padang)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="lokasi"
                        class="form-control"
                        value="{{ $lowongan->lokasi }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Kategori Label</label>
                    <select name="kategori_label" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>

                        <option value="Featured Opening" {{ $lowongan->kategori_label == 'Featured Opening' ? 'selected' : '' }}>Featured Opening</option>
                        <option value="Urgent Hiring" {{ $lowongan->kategori_label == 'Urgent Hiring' ? 'selected' : '' }}>Urgent Hiring</option>
                        <option value="Internship" {{ $lowongan->kategori_label == 'Internship' ? 'selected' : '' }}>Internship</option>
                        <option value="Fresh Graduate" {{ $lowongan->kategori_label == 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                        <option value="Management Trainee" {{ $lowongan->kategori_label == 'Management Trainee' ? 'selected' : '' }}>Management Trainee</option>
                        <option value="Part Time" {{ $lowongan->kategori_label == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                        <option value="Full Time" {{ $lowongan->kategori_label == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Contract" {{ $lowongan->kategori_label == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Remote Job" {{ $lowongan->kategori_label == 'Remote Job' ? 'selected' : '' }}>Remote Job</option>
                        <option value="Hybrid Work" {{ $lowongan->kategori_label == 'Hybrid Work' ? 'selected' : '' }}>Hybrid Work</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status Lowongan</label>
                    <select name="status_lowongan" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif" {{ $lowongan->status_lowongan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tutup" {{ $lowongan->status_lowongan == 'tutup' ? 'selected' : '' }}>Ditutup</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Deadline</label>
                    <input
                        type="date"
                        name="deadline"
                        class="form-control"
                        value="{{ $lowongan->deadline }}"
                    >
                </div>

                <div class="form-group">
                    <label>Jumlah Dibutuhkan</label>
                    <input
                        type="number"
                        name="jumlah_lowongan_dibuka"
                        class="form-control"
                        value="{{ $lowongan->jumlah_lowongan_dibuka }}"
                    >
                </div>

                <div class="form-group">
                    <label>
                        Tanggal Deadline Label
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: 24 Dec, 15 Jan, 30 Jun)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="tanggal_deadline_label"
                        class="form-control"
                        value="{{ $lowongan->tanggal_deadline_label }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Jurusan
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: pisahkan dengan koma → Teknik Informatika, Sistem Informasi, Teknik Komputer)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="nama_jurusan[]"
                        class="form-control"
                        value="{{ $lowongan->jurusan->pluck('nama_jurusan')->implode(', ') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Syarat Khusus
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: pisahkan dengan koma → Node.js, React, PostgreSQL, Docker & Microservices)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="syarat_khusus[]"
                        class="form-control"
                        value="{{ $lowongan->syaratKhusus->pluck('syarat_khusus')->implode(', ') }}"
                        required
                    >
                </div>

                <div class="form-group form-full">
                    <label>
                        Syarat Umum
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: pisahkan dengan koma → Maksimal 35 tahun, Mampu bekerja dalam tim)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="syarat_umum[]"
                        class="form-control"
                        value="{{ $lowongan->syaratUmum->pluck('syarat_umum')->implode(', ') }}"
                        required
                    >
                </div>

                <div class="form-group form-full">
                    <label>Gambar Banner</label>

                    @if($lowongan->gambar_banner)
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $lowongan->gambar_banner) }}"
                                style="width:200px; border-radius:8px; object-fit:cover;">
                        </div>
                    @endif

                    <input type="file" name="gambar_banner" class="form-control" accept="image/*">

                    <small style="color:#6c757d;">
                        Kosongkan jika tidak ingin mengubah gambar
                    </small>
                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="form-group form-description">
                <label>Deskripsi Pekerjaan</label>
                <textarea
                    name="deskripsi_pekerjaan"
                    class="form-control"
                    rows="6"
                >{{ $lowongan->deskripsi_pekerjaan }}</textarea>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Update Lowongan
                </button>

                <a href="{{ route('LowonganPekerjaan.indexLowonganPekerjaan') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

@endsection