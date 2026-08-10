@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <a href="{{ route('admin.career.lesson.index', $class->id) }}" class="back-link" style="text-decoration:none; display:inline-flex; align-items:center; gap:6px; margin-bottom:6px;">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Lesson — {{ $class->judul }}</span>
            </a>
            <h2 class="section-title">Tambah Lesson</h2>
            <p class="section-subtitle">
                Tambahkan materi baru untuk kelas ini
            </p>
        </div>
    </div>

    <!-- FORM -->
    <form id="lesson-form" action="{{ route('admin.career.lesson.store', $class->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group form-full">
                    <label>Judul Lesson</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>

                <div class="form-group">
                    <label>Tipe Konten</label>
                    <select name="tipe_konten" id="tipe_konten" class="form-control" required onchange="toggleFieldByTipe()">
                        <option value="">-- Pilih Tipe Konten --</option>
                        <option value="video" {{ old('tipe_konten') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="artikel" {{ old('tipe_konten') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                        <option value="dokumen" {{ old('tipe_konten') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Durasi (menit)</label>
                    <input type="number" name="durasi_menit" class="form-control" value="{{ old('durasi_menit') }}" min="0">
                </div>

                <div class="form-group form-full" id="wrapper-konten">
                    <label>Konten</label>
                    <textarea name="konten" class="form-control" rows="6">{{ old('konten') }}</textarea>
                </div>

                <div class="form-group form-full" id="wrapper-file">
                    <label id="file-label">File</label>
                    <input type="file" name="file" id="file-input" class="form-control">
                    <small style="color:#6c757d;" id="file-hint"></small>

                    @error('file')
                        <div style="color:#dc3545; font-size:13px; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" id="submit-btn" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Lesson
                </button>

                <a href="{{ route('admin.career.lesson.index', $class->id) }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

<!-- UPLOAD LOADING OVERLAY -->
<div id="upload-overlay" class="upload-overlay">
    <div class="upload-box">

        <div class="upload-icon">
            <i class="fas fa-cloud-upload-alt"></i>
        </div>

        <h3 class="upload-title" id="upload-title">Mengupload file...</h3>
        <p class="upload-filename" id="upload-filename">nama-file.mp4</p>

        <div class="upload-progress-track">
            <div class="upload-progress-bar" id="upload-progress-bar"></div>
        </div>

        <div class="upload-progress-info">
            <span id="upload-percent">0%</span>
            <span id="upload-size">0 MB / 0 MB</span>
        </div>

        <p class="upload-note" id="upload-note">Mohon jangan tutup atau refresh halaman ini.</p>

        <button type="button" id="upload-cancel-btn" class="btn-cancel-upload">
            <i class="fas fa-times"></i>
            Batal Upload
        </button>

    </div>
</div>

<script>
    // konfigurasi per tipe konten: accept, label, hint, dan apakah field wajib diisi
    const KONTEN_CONFIG = {
        dokumen: {
            fileAccept: '.pdf,.doc,.docx,.ppt,.pptx',
            fileLabel: 'File Dokumen',
            fileHint: 'Format: PDF, DOC, DOCX, PPT, PPTX. Maksimal 10MB. Wajib diisi untuk tipe konten Dokumen.',
            showFile: true,
            showKonten: false,
        },
        video: {
            fileAccept: '.mp4',
            fileLabel: 'File Video',
            fileHint: 'Format: MP4 saja. Maksimal 200MB. Wajib diisi untuk tipe konten Video.',
            showFile: true,
            showKonten: false,
        },
        artikel: {
            fileAccept: '',
            fileLabel: 'File',
            fileHint: '',
            showFile: false,
            showKonten: true,
        },
    };

    function toggleFieldByTipe() {
        const tipe = document.getElementById('tipe_konten').value;
        const wrapperFile = document.getElementById('wrapper-file');
        const wrapperKonten = document.getElementById('wrapper-konten');
        const fileInput = document.getElementById('file-input');
        const fileLabel = document.getElementById('file-label');
        const fileHint = document.getElementById('file-hint');
        const kontenTextarea = document.querySelector('#wrapper-konten textarea[name="konten"]');

        const config = KONTEN_CONFIG[tipe] || { showFile: false, showKonten: false, fileAccept: '', fileLabel: 'File', fileHint: '' };

        wrapperFile.style.display = config.showFile ? 'block' : 'none';
        wrapperKonten.style.display = config.showKonten ? 'block' : 'none';

        fileInput.accept = config.fileAccept;
        fileLabel.textContent = config.fileLabel;
        fileHint.textContent = config.fileHint;
        fileInput.required = config.showFile;

        if (kontenTextarea) {
            kontenTextarea.required = config.showKonten;
        }
    }

    document.addEventListener('DOMContentLoaded', toggleFieldByTipe);

    // ================= UPLOAD DENGAN PROGRESS + BATAL =================
    (function () {
        const form = document.getElementById('lesson-form');
        const overlay = document.getElementById('upload-overlay');
        const progressBar = document.getElementById('upload-progress-bar');
        const percentText = document.getElementById('upload-percent');
        const sizeText = document.getElementById('upload-size');
        const filenameText = document.getElementById('upload-filename');
        const uploadTitle = document.getElementById('upload-title');
        const uploadNote = document.getElementById('upload-note');
        const cancelBtn = document.getElementById('upload-cancel-btn');
        const submitBtn = document.getElementById('submit-btn');
        const fileInput = document.getElementById('file-input');

        let currentXhr = null;

        function formatMB(bytes) {
            return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
        }

        function showOverlay(filename) {
            filenameText.textContent = filename || '';
            progressBar.style.width = '0%';
            percentText.textContent = '0%';
            sizeText.textContent = '';
            uploadTitle.textContent = 'Mengupload file...';
            uploadNote.textContent = 'Mohon jangan tutup atau refresh halaman ini.';
            cancelBtn.style.display = 'inline-flex';
            overlay.classList.add('active');
        }

        function hideOverlay() {
            overlay.classList.remove('active');
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;

            submitBtn.disabled = true;

            showOverlay(hasFile ? fileInput.files[0].name : 'Menyimpan data...');
            if (!hasFile) {
                cancelBtn.style.display = 'none';
            }

            const xhr = new XMLHttpRequest();
            currentXhr = xhr;

            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.upload.addEventListener('progress', function (event) {
                if (event.lengthComputable) {
                    const percent = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percent + '%';
                    percentText.textContent = percent + '%';
                    sizeText.textContent = formatMB(event.loaded) + ' / ' + formatMB(event.total);

                    if (percent >= 100) {
                        uploadTitle.textContent = 'Memproses di server...';
                        uploadNote.textContent = 'Upload selesai, sedang menyimpan data. Mohon tunggu sebentar.';
                        cancelBtn.style.display = 'none';
                    }
                }
            });

            xhr.onload = function () {
                currentXhr = null;

                if (xhr.status >= 200 && xhr.status < 300) {
                    uploadTitle.textContent = 'Berhasil!';
                    uploadNote.textContent = 'Lesson berhasil disimpan, mengalihkan halaman...';
                    progressBar.style.width = '100%';
                    percentText.textContent = '100%';

                    const redirectUrl = xhr.responseURL || '{{ route('admin.career.lesson.index', $class->id) }}';
                    setTimeout(function () {
                        window.location.href = redirectUrl;
                    }, 600);
                } else {
                    // Ada error validasi / server error -> tampilkan ulang halaman berisi pesan error
                    hideOverlay();
                    submitBtn.disabled = false;

                    if (xhr.responseText) {
                        document.open();
                        document.write(xhr.responseText);
                        document.close();
                    } else {
                        alert('Terjadi kesalahan saat menyimpan lesson. Silakan coba lagi.');
                    }
                }
            };

            xhr.onerror = function () {
                currentXhr = null;
                hideOverlay();
                submitBtn.disabled = false;
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
            };

            xhr.onabort = function () {
                currentXhr = null;
                hideOverlay();
                submitBtn.disabled = false;
            };

            xhr.send(formData);
        });

        cancelBtn.addEventListener('click', function () {
            if (currentXhr) {
                currentXhr.abort();
            }
        });
    })();
</script>

<style>
    .back-link {
        font-size: 13px;
        font-weight: 500;
        color: #607d8b;
        transition: color 0.15s ease, gap 0.15s ease;
    }

    .back-link i {
        font-size: 12px;
        transition: transform 0.15s ease;
    }

    .back-link:hover {
        color: #1976d2;
    }

    .back-link:hover i {
        transform: translateX(-3px);
    }

    /* ===== UPLOAD OVERLAY ===== */
    .upload-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 32, 0.55);
        backdrop-filter: blur(2px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .upload-overlay.active {
        display: flex;
    }

    .upload-box {
        background: #ffffff;
        border-radius: 14px;
        width: 100%;
        max-width: 380px;
        padding: 32px 28px 26px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        animation: upload-pop 0.2s ease;
    }

    @keyframes upload-pop {
        from { transform: scale(0.94); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .upload-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 14px;
        border-radius: 50%;
        background: #e3f2fd;
        color: #1976d2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        animation: upload-bounce 1.4s ease-in-out infinite;
    }

    @keyframes upload-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    .upload-title {
        font-size: 16px;
        font-weight: 600;
        color: #263238;
        margin: 0 0 4px;
    }

    .upload-filename {
        font-size: 13px;
        color: #78909c;
        margin: 0 0 18px;
        word-break: break-all;
    }

    .upload-progress-track {
        width: 100%;
        height: 8px;
        border-radius: 999px;
        background: #eceff1;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .upload-progress-bar {
        height: 100%;
        width: 0%;
        border-radius: 999px;
        background: linear-gradient(90deg, #42a5f5, #1976d2);
        transition: width 0.15s ease;
    }

    .upload-progress-info {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #607d8b;
        margin-bottom: 18px;
    }

    .upload-progress-info #upload-percent {
        font-weight: 700;
        color: #1976d2;
    }

    .upload-note {
        font-size: 12px;
        color: #90a4ae;
        margin: 0 0 18px;
    }

    .btn-cancel-upload {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #ffcdd2;
        background: #fff5f5;
        color: #e53935;
        font-size: 13px;
        font-weight: 500;
        padding: 8px 18px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.15s ease, border-color 0.15s ease;
    }

    .btn-cancel-upload:hover {
        background: #ffebee;
        border-color: #ef9a9a;
    }
</style>

@endsection