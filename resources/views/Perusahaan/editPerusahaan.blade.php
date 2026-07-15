@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Edit Perusahaan</h2>
            <p class="section-subtitle">
                Perbarui data perusahaan pada sistem
            </p>
        </div>

        <a href="{{ route('admin.perusahaan.index') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.perusahaan.update', $perusahaan->id) }}" method="POST" enctype="multipart/form-data" id="formEditPerusahaan">
        @csrf
        @method('PUT')

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input
                        type="text"
                        name="nama_perusahaan"
                        class="form-control"
                        value="{{ $perusahaan->nama_perusahaan }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email Perusahaan</label>
                    <input
                        type="email"
                        name="email_perusahaan"
                        class="form-control"
                        value="{{ $perusahaan->email_perusahaan }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Telepon
                        <small style="color: #6c757d; font-weight: normal;">
                            (opsional)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="telepon_perusahaan"
                        class="form-control"
                        value="{{ $perusahaan->telepon_perusahaan }}"
                    >
                </div>

                <div class="form-group">
                    <label>
                        Website
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: https://namaperusahaan.com)
                        </small>
                    </label>
                    <input
                        type="url"
                        name="website_perusahaan"
                        class="form-control"
                        value="{{ $perusahaan->website_perusahaan }}"
                        placeholder="https://"
                    >
                </div>

                <div class="form-group">
                    <label>Status Perusahaan</label>
                    <select name="status_perusahaan" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif" {{ $perusahaan->status_perusahaan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $perusahaan->status_perusahaan == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary" id="btnSimpanPerusahaan">
                    <i class="fas fa-save" id="btnSimpanIcon"></i>
                    <span id="btnSimpanText">Update Perusahaan</span>
                </button>

                <a href="{{ route('admin.perusahaan.index') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

<script>
    document.getElementById('formEditPerusahaan').addEventListener('submit', function (e) {
        const btn = document.getElementById('btnSimpanPerusahaan');
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