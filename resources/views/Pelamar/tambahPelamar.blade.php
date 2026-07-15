@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Tambah Pelamar</h2>
            <p class="section-subtitle">
                Tambahkan data pelamar baru ke sistem
            </p>
        </div>

        <a href="{{ route('admin.pelamar.index') }}" class="btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.pelamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="table-wrapper form-wrapper">

            <div class="form-grid">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>
                        Telepon
                        <small style="color: #6c757d; font-weight: normal;">
                            (opsional)
                        </small>
                    </label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>

                <div class="form-group form-full">
                    <label>
                        Alamat
                        <small style="color: #6c757d; font-weight: normal;">
                            (opsional)
                        </small>
                    </label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                </div>

                <div class="form-group form-full">
                    <label>Foto Profil</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>

            </div>

            <!-- BUTTON -->
            <div class="form-actions">

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Pelamar
                </button>

                <a href="{{ route('admin.pelamar.index') }}" class="btn-secondary">
                    Batal
                </a>

            </div>

        </div>

    </form>

</div>

@endsection