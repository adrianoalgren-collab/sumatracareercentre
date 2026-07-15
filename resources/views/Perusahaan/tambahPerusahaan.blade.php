@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Tambah Perusahaan</h2>
            <p class="section-subtitle">
                Tambahkan data perusahaan baru ke sistem
            </p>
        </div>

        <a href="{{ route('admin.perusahaan.index') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.perusahaan.store') }}" method="POST" id="formPerusahaan">
        @csrf

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group">
                    <label>
                        Nama Perusahaan
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: PT Maju Bersama, CV Sukses Mandiri)
                        </small>
                    </label>
                    <input type="text" name="nama_perusahaan" class="form-control"
                        value="{{ old('nama_perusahaan') }}" required>
                    @error('nama_perusahaan')
                        <small style="color:#dc3545;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email Perusahaan</label>
                    <input type="email" name="email_perusahaan" class="form-control"
                        value="{{ old('email_perusahaan') }}" required>
                    @error('email_perusahaan')
                        <small style="color:#dc3545;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Telepon
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: 0812xxxxxxx)
                        </small>
                    </label>
                    <input type="text" name="telepon_perusahaan" class="form-control"
                        value="{{ old('telepon_perusahaan') }}">
                    @error('telepon_perusahaan')
                        <small style="color:#dc3545;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Website
                        <small style="color: #6c757d; font-weight: normal;">
                            (contoh: https://perusahaan.com)
                        </small>
                    </label>
                    <input type="url" name="website_perusahaan" class="form-control"
                        value="{{ old('website_perusahaan') }}" placeholder="https://">
                    @error('website_perusahaan')
                        <small style="color:#dc3545;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status Perusahaan</label>
                    <select name="status_perusahaan" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif" {{ old('status_perusahaan') == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="nonaktif" {{ old('status_perusahaan') == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                    @error('status_perusahaan')
                        <small style="color:#dc3545;">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <!-- ALAMAT -->
            <div class="form-group form-description">
                <label>Alamat Perusahaan</label>
                <textarea name="alamat_perusahaan" class="form-control" rows="4">{{ old('alamat_perusahaan') }}</textarea>
                @error('alamat_perusahaan')
                    <small style="color:#dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary" id="btnSimpanPerusahaan">
                    <i class="fas fa-save" id="btnSimpanIcon"></i>
                    <span id="btnSimpanText">Simpan Perusahaan</span>
                </button>

                <a href="{{ route('admin.perusahaan.index') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

<script>
    document.getElementById('formPerusahaan').addEventListener('submit', function (e) {
        const btn = document.getElementById('btnSimpanPerusahaan');
        const icon = document.getElementById('btnSimpanIcon');
        const text = document.getElementById('btnSimpanText');

        // Cegah submit ganda jika tombol sudah dalam kondisi loading
        if (btn.disabled) {
            e.preventDefault();
            return;
        }

        btn.disabled = true;
        btn.style.opacity = '0.7';
        btn.style.cursor = 'not-allowed';

        icon.classList.remove('fa-save');
        icon.classList.add('fa-spinner', 'fa-spin');
        text.textContent = 'Menyimpan...';
    });
</script>

@endsection