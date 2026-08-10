@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Tambah Artikel</h2>
            <p class="section-subtitle">
                Tambahkan artikel baru ke sistem
            </p>
        </div>

        <a href="{{ route('admin.artikel.index') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group form-full">
                    <label>Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>

                <div class="form-group">
                    <label>
                        Slug
                        <small style="color: #6c757d; font-weight: normal;">
                            (opsional, otomatis dibuat dari judul jika dikosongkan)
                        </small>
                    </label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Waktu Baca (menit)</label>
                    <input type="number" name="waktu_baca_menit" class="form-control" value="{{ old('waktu_baca_menit') }}" min="0">
                </div>

                <div class="form-group">
                    <label>
                        Tags
                        <small style="color: #6c757d; font-weight: normal;">
                            (pisahkan dengan koma → Karier, Tips Interview, CV)
                        </small>
                    </label>
                    <input type="text" name="tags" class="form-control" value="{{ old('tags') }}">
                </div>

                <div class="form-group form-full">
                    <label>Ringkasan</label>
                    <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan') }}</textarea>
                </div>

                <div class="form-group form-full">
                    <label>Gambar Utama</label>
                    <input type="file" name="gambar_utama" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Nama Penulis</label>
                    <input type="text" name="penulis_nama" class="form-control" value="{{ old('penulis_nama') }}">
                </div>

                <div class="form-group">
                    <label>Jabatan Penulis</label>
                    <input type="text" name="penulis_jabatan" class="form-control" value="{{ old('penulis_jabatan') }}">
                </div>

                <div class="form-group form-full">
                    <label>Foto Penulis</label>
                    <input type="file" name="penulis_foto" class="form-control" accept="image/*">
                </div>

                <div class="form-group form-full">
                    <label>Bio Penulis</label>
                    <textarea name="penulis_bio" class="form-control" rows="3">{{ old('penulis_bio') }}</textarea>
                </div>

            </div>

            <!-- KONTEN -->
           <div class="form-group form-description">
                <label>Konten Artikel</label>
                <textarea name="konten" id="konten" class="form-control" rows="10" required>{{ old('konten') }}</textarea>
                <small style="color: #6c757d; font-weight: normal; display: block; margin-bottom: 5px;">
                    Tips: gunakan AI untuk bantu menulis. Contoh prompt: "Tulis artikel tentang [topik] dengan gaya santai, sertakan sub-judul (h2), poin-poin (bullet), dan satu kutipan menarik (blockquote) agar konten lebih menarik dibaca."
                </small>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Artikel
                </button>

                <a href="{{ route('admin.artikel.index') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#konten'))
        .catch(error => console.error(error));
</script>
@endsection