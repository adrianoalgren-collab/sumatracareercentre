@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Edit Pelamar</h2>
            <p class="section-subtitle">
                Perbarui data pelamar pada sistem
            </p>
        </div>

        <a href="{{ route('admin.pelamar.index') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.pelamar.update', $pelamar->id) }}" method="POST" enctype="multipart/form-data" id="formEditPelamar">
        @csrf
        @method('PUT')

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $pelamar->name) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $pelamar->email) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Password Baru
                        <small style="color: #6c757d; font-weight: normal;">
                            (kosongkan jika tidak ingin mengubah password)
                        </small>
                    </label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                    >
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
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
                        name="phone"
                        class="form-control"
                        value="{{ old('phone', $pelamar->phone) }}"
                    >
                </div>

                <div class="form-group form-full">
                    <label>
                        Alamat
                        <small style="color: #6c757d; font-weight: normal;">
                            (opsional)
                        </small>
                    </label>
                    <input
                        type="text"
                        name="address"
                        class="form-control"
                        value="{{ old('address', $pelamar->address) }}"
                    >
                </div>

                <div class="form-group form-full">
                    <label>Foto Profil</label>

                    @if($pelamar->photo)
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $pelamar->photo) }}"
                                style="width:100px; height:100px; border-radius:50%; object-fit:cover;">
                        </div>
                    @endif

                    <input type="file" name="photo" class="form-control" accept="image/*">

                    <small style="color:#6c757d;">
                        Kosongkan jika tidak ingin mengubah foto
                    </small>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary" id="btnSimpanPelamar">
                    <i class="fas fa-save" id="btnSimpanIcon"></i>
                    <span id="btnSimpanText">Update Pelamar</span>
                </button>

                <a href="{{ route('admin.pelamar.index') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

<script>
    document.getElementById('formEditPelamar').addEventListener('submit', function (e) {
        const btn = document.getElementById('btnSimpanPelamar');
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