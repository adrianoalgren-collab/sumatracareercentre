@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Tambah Lowongan Pekerjaan</h2>
            <p class="section-subtitle">
                Tambahkan data lowongan pekerjaan baru ke sistem
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.lowongan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

               <div class="form-group">
                <label>
                        Judul Lowongan
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: Staff Administrasi, Web Developer, Digital Marketing)
                        </small>
                    </label>
                    <input type="text" name="judul_lowongan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Perusahaan</label>
                    <select name="perusahaan_id" class="form-control" required>
                        <option value="">-- Pilih Perusahaan --</option>

                        @foreach ($perusahaan as $item)
                            <option value="{{ $item->id }}">
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
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Kategori Label</label>
                    <select name="kategori_label" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Featured Opening">Featured Opening</option>
                        <option value="Urgent Hiring">Urgent Hiring</option>
                        <option value="Internship">Internship</option>
                        <option value="Fresh Graduate">Fresh Graduate</option>
                        <option value="Management Trainee">Management Trainee</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Contract">Contract</option>
                        <option value="Remote Job">Remote Job</option>
                        <option value="Hybrid Work">Hybrid Work</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status Lowongan</label>
                    <select name="status_lowongan" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="tutup">Ditutup</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Deadline</label>
                    <input type="date" name="deadline" class="form-control">
                </div>

                <div class="form-group">
                    <label>Jumlah Dibutuhkan</label>
                    <input type="number" name="jumlah_lowongan_dibuka" class="form-control">
                </div>

                <div class="form-group">
                    <label>
                        Tanggal Deadline Label
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: 24 Dec, 15 Jan, 30 Jun)
                        </small>
                    </label>
                    <input type="text" name="tanggal_deadline_label" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>
                        Jurusan
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: pisahkan dengan koma → Teknik Informatika, Sistem Informasi, Teknik Komputer)
                        </small>
                    </label>
                    <input type="text" name="nama_jurusan[]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>
                        Syarat Khusus
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: pisahkan dengan koma → Node.js, React, PostgreSQL, Docker & Microservices)
                        </small>
                    </label>
                    <input type="text" name="syarat_khusus[]" class="form-control" required>
                </div>

                <div class="form-group form-full">
                    <label>
                        Syarat Umum
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: pisahkan dengan koma → Maksimal 35 tahun, Mampu bekerja dalam tim)
                        </small>
                    </label>
                    <input type="text" name="syarat_umum[]" class="form-control" required>
                </div>

                <div class="form-group form-full">
                    <label>Gambar Banner</label>
                    <input type="file" name="gambar_banner" class="form-control" accept="image/*">
                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="form-group form-description">
                <label>Deskripsi Pekerjaan</label>
                <textarea name="deskripsi_pekerjaan" class="form-control" rows="6"></textarea>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Lowongan
                </button>

                <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

@endsection