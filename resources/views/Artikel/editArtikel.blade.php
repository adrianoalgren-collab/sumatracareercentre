@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Edit Artikel</h2>
            <p class="section-subtitle">
                Perbarui data artikel pada sistem
            </p>
        </div>

        <a href="{{ route('admin.artikel.index') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data" id="formEditArtikel">
        @csrf
        @method('PUT')

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group form-full">
                    <label>Judul Artikel</label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul', $artikel->judul) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Slug
                        <small style="color: #6c757d; font-weight: normal;">
                            (opsional, otomatis dibuat dari judul jika dikosongkan)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="slug"
                        class="form-control"
                        value="{{ old('slug', $artikel->slug) }}"
                    >
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input
                        type="text"
                        name="kategori"
                        class="form-control"
                        value="{{ old('kategori', $artikel->kategori) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="draft" {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Waktu Baca (menit)</label>
                    <input
                        type="number"
                        name="waktu_baca_menit"
                        class="form-control"
                        value="{{ old('waktu_baca_menit', $artikel->waktu_baca_menit) }}"
                        min="0"
                    >
                </div>

                <div class="form-group">
                    <label>
                        Tags
                        <small style="color: #6c757d; font-weight: normal;">
                            (pisahkan dengan koma → Karier, Tips Interview, CV)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="tags"
                        class="form-control"
                        value="{{ old('tags', $artikel->tags) }}"
                    >
                </div>

                <div class="form-group form-full">
                    <label>Ringkasan</label>
                    <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan', $artikel->ringkasan) }}</textarea>
                </div>

                <div class="form-group form-full">
                    <label>Gambar Utama</label>

                    @if($artikel->gambar_utama)
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $artikel->gambar_utama) }}"
                                style="width:200px; border-radius:8px; object-fit:cover;">
                        </div>
                    @endif

                    <input type="file" name="gambar_utama" class="form-control" accept="image/*">

                    <small style="color:#6c757d;">
                        Kosongkan jika tidak ingin mengubah gambar
                    </small>
                </div>

                <div class="form-group">
                    <label>Nama Penulis</label>
                    <input
                        type="text"
                        name="penulis_nama"
                        class="form-control"
                        value="{{ old('penulis_nama', $artikel->penulis_nama) }}"
                    >
                </div>

                <div class="form-group">
                    <label>Jabatan Penulis</label>
                    <input
                        type="text"
                        name="penulis_jabatan"
                        class="form-control"
                        value="{{ old('penulis_jabatan', $artikel->penulis_jabatan) }}"
                    >
                </div>

                <div class="form-group form-full">
                    <label>Foto Penulis</label>

                    @if($artikel->penulis_foto)
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $artikel->penulis_foto) }}"
                                style="width:80px; height:80px; border-radius:50%; object-fit:cover;">
                        </div>
                    @endif

                    <input type="file" name="penulis_foto" class="form-control" accept="image/*">

                    <small style="color:#6c757d;">
                        Kosongkan jika tidak ingin mengubah foto penulis
                    </small>
                </div>

                <div class="form-group form-full">
                    <label>Bio Penulis</label>
                    <textarea name="penulis_bio" class="form-control" rows="3">{{ old('penulis_bio', $artikel->penulis_bio) }}</textarea>
                </div>

            </div>

            <!-- KONTEN -->
            <div class="form-group form-description">
                <label>Konten Artikel</label>
                <textarea
                    name="konten"
                    class="form-control"
                    rows="10"
                    required
                >{{ old('konten', $artikel->konten) }}</textarea>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary" id="btnSimpanArtikel">
                    <i class="fas fa-save" id="btnSimpanIcon"></i>
                    <span id="btnSimpanText">Update Artikel</span>
                </button>

                <a href="{{ route('admin.artikel.index') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

<script>
    document.getElementById('formEditArtikel').addEventListener('submit', function (e) {
        const btn = document.getElementById('btnSimpanArtikel');
        const icon = document.getElementById('btnSimpanIcon');
        const text = document.getElementById('btnSimpanText');

        // Cegah submit ganda kalau tombol sudah dalam kondisi loading
        if (btn.disabled) {
            e.preventDefault();
            return;
        }

        btn.disabled = true;
        icon.className = 'fas fa-spinner fa-spin';
        text.textContent = 'Menyimpan...';
    });
</script>

@endsection