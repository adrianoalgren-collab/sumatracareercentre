@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Edit Lesson</h2>
            <p class="section-subtitle">
                Perbarui materi lesson pada kelas "{{ $class->judul }}"
            </p>
        </div>

        <a href="{{ route('admin.career.lesson.index', $class->id) }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.career.lesson.update', [$class->id, $lesson->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group form-full">
                    <label>
                        Judul Lesson
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: Pengenalan Riset Kata Kunci, Teknik Dasar Public Speaking)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ $lesson->judul }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Tipe Konten</label>
                    <select name="tipe_konten" id="tipe_konten" class="form-control" required>
                        <option value="">-- Pilih Tipe Konten --</option>
                        <option value="video" {{ $lesson->tipe_konten == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="artikel" {{ $lesson->tipe_konten == 'artikel' ? 'selected' : '' }}>Artikel</option>
                        <option value="dokumen" {{ $lesson->tipe_konten == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Urutan</label>
                    <input
                        type="number"
                        name="urutan"
                        class="form-control"
                        value="{{ $lesson->urutan }}"
                        min="1"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Durasi (menit)</label>
                    <input
                        type="number"
                        name="durasi_menit"
                        class="form-control"
                        value="{{ $lesson->durasi_menit }}"
                        min="0"
                    >
                </div>

                <div class="form-group" id="wrapper-file">
                    <label>File Video / Dokumen</label>

                    <input type="file" name="file" class="form-control" accept="video/mp4,video/quicktime,video/x-msvideo,video/x-matroska,video/webm,application/pdf,.doc,.docx,.ppt,.pptx">

                    @error('file')
                        <small style="color:#dc3545;">{{ $message }}</small>
                    @enderror

                    @if ($lesson->file_path)
                        <small style="color:#6c757d;">
                            File saat ini:
                            <a href="{{ asset('storage/'.$lesson->file_path) }}" target="_blank">
                                {{ basename($lesson->file_path) }}
                            </a>
                            — kosongkan jika tidak ingin mengubah file
                        </small>
                    @else
                        <small style="color:#6c757d;">
                            Wajib diunggah untuk tipe video/dokumen. Dokumen maks 10MB (pdf, doc, docx, ppt, pptx), video maks 200MB (mp4, mov, avi, mkv, webm).
                        </small>
                    @endif
                </div>

            </div>

            <!-- KONTEN -->
            <div class="form-group form-description" id="wrapper-konten">
                <label>Konten / Isi Materi</label>
                <textarea
                    name="konten"
                    class="form-control"
                    rows="6"
                >{{ $lesson->konten }}</textarea>
            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Update Lesson
                </button>

                <a href="{{ route('admin.career.lesson.index', $class->id) }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

<script>
    (function () {
        const tipeSelect = document.getElementById('tipe_konten');
        const wrapperFile = document.getElementById('wrapper-file');
        const wrapperKonten = document.getElementById('wrapper-konten');

        function toggleFields() {
            const tipe = tipeSelect.value;

            if (tipe === 'artikel') {
                wrapperFile.style.display = 'none';
                wrapperKonten.style.display = '';
            } else if (tipe === 'video' || tipe === 'dokumen') {
                wrapperFile.style.display = '';
                wrapperKonten.style.display = 'none';
            } else {
                // Belum pilih tipe, tampilkan dua-duanya
                wrapperFile.style.display = '';
                wrapperKonten.style.display = '';
            }
        }

        tipeSelect.addEventListener('change', toggleFields);
        toggleFields(); // jalankan saat halaman pertama kali dimuat
    })();
</script>

@endsection