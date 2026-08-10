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
    <form method="GET" action="{{ route('admin.pelamar.index') }}">
    <div class="table-toolbar">
        <div class="toolbar-search">
            <i class="fas fa-search"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pelamar..." onchange="this.form.submit()">
        </div>

        <div class="toolbar-right" style="display:flex; align-items:center; gap:10px; margin-left:auto;">

            <!-- SHOW X ENTRIES -->
            <div class="entries-select">
                <label for="perPageSelect" style="font-size:13px; color:#6c757d; white-space:nowrap;">
                    Tampilkan
                </label>
                <select name="per_page" id="perPageSelect" class="form-control-sm" onchange="this.form.submit()">
                    @foreach($perPageOptions as $opsi)
                        <option value="{{ $opsi }}" {{ $perPage == $opsi ? 'selected' : '' }}>
                            {{ $opsi }}
                        </option>
                    @endforeach
                </select>
                <span style="font-size:13px; color:#6c757d; white-space:nowrap;">entri</span>
            </div>

        </div>
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
                    <td>{{ $pelamar->firstItem() + $loop->index }}</td>

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

                        <form action="{{ route('admin.pelamar.destroy', $item->id) }}"
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

    <!-- PAGINATION -->
    @if($pelamar->hasPages())
    <div class="table-pagination">
        <div class="pagination-info">
            Menampilkan {{ $pelamar->firstItem() ?? 0 }} - {{ $pelamar->lastItem() ?? 0 }}
            dari {{ $pelamar->total() }} data
        </div>

        <div class="pagination-links">
            {{ $pelamar->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif

</div>

<x-modal-success />
<x-modal-konfirmasi-hapus />

<style>
    .table-toolbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .entries-select {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .entries-select select.form-control-sm {
        padding: 5px 10px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 13px;
        background: #fff;
        color: #495057;
        cursor: pointer;
    }

    .entries-select select.form-control-sm:focus {
        outline: none;
        border-color: #2f8f6e;
    }

    .table-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 16px 4px 4px;
    }

    .pagination-info {
        font-size: 13px;
        color: #6c757d;
    }

    .pagination-links .pagination {
        margin: 0;
    }

    .pagination-links .page-link {
        border: none;
        color: #2f8f6e;
        padding: 6px 12px;
        border-radius: 8px;
        margin: 0 2px;
        font-size: 13px;
    }

    .pagination-links .page-item.active .page-link {
        background-color: #2f8f6e;
        color: #fff;
    }

    .pagination-links .page-link:hover {
        background-color: #eef6f3;
    }

    .pagination-links .page-item.disabled .page-link {
        color: #ccc;
        background: transparent;
    }
</style>

@endsection