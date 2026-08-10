@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Edit Career Development</h2>
            <p class="section-subtitle">
                Perbarui data kelas career development pada sistem
            </p>
        </div>

        <a href="{{ route('admin.career.index') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.career.update', $class->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group form-full">
                    <label>
                        Judul Kelas
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: Dasar-Dasar Digital Marketing, Public Speaking untuk Pemula)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ $class->judul }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="draft" {{ $class->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $class->status == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Thumbnail</label>

                    <input type="file" name="thumbnail" class="form-control" accept="image/*">

                    <small style="color:#6c757d;">
                        Kosongkan jika tidak ingin mengubah thumbnail
                    </small>
                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="form-group form-description">
                <label>Deskripsi Kelas</label>
                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="6"
                >{{ $class->deskripsi }}</textarea>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Update Kelas
                </button>

                <a href="{{ route('admin.career.index') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

@endsection