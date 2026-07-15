@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Data Pelamar</h2>
            <p class="section-subtitle">Kelola seluruh data pelamar yang terdaftar</p>
        </div>

        <a href="{{ route('admin.pelamar.tambah') }}"
            class="btn-primary"
            style="text-decoration:none;">

            <i class="fas fa-plus"></i>
            Tambah Pelamar

        </a>
    </div>

    <!-- TOOLBAR -->
    <form method="GET" action="{{ route('admin.pelamar.index') }}" class="table-toolbar">

        <div class="toolbar-search">
            <button type="submit" class="psh-search-btn" aria-label="Cari">
                <i class="fas fa-search"></i>
            </button>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama pelamar..." autocomplete="off">
        </div>

    </form>

    <!-- TABLE -->
    <div class="table-wrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Pelamar</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pelamar as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if($item->photo)
                            <img src="{{ asset('storage/' . $item->photo) }}"
                                alt="{{ $item->name }}"
                                style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                        @else
                            <div style="width:40px; height:40px; border-radius:50%; background:#e9ecef; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-user" style="color:#adb5bd;"></i>
                            </div>
                        @endif
                    </td>

                    <td>{{ $item->name }}</td>

                    <td>{{ $item->email }}</td>

                    <td>{{ $item->phone ?? '-' }}</td>

                    <td>{{ $item->address ?? '-' }}</td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        <a href="{{ route('admin.pelamar.edit', $item->id) }}"
                        class="btn-icon edit"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.pelamar.delete', $item->id) }}"
                            method="POST"
                            id="form-hapus-{{ $item->id }}"
                            style="margin:0;">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn-icon delete"
                                    onclick="konfirmasiHapus('form-hapus-{{ $item->id }}')"
                                    style="display:inline-flex; align-items:center; justify-content:center;">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:30px;">
                        Data pelamar belum tersedia
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    @if($pelamar->hasPages())
        <div style="margin-top:20px;">
            {{ $pelamar->links() }}
        </div>
    @endif

</div>

<x-modal-success />
<x-modal-konfirmasi-hapus />

@endsection