@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Data Lowongan Pekerjaan</h2>
            <p class="section-subtitle">Kelola seluruh data lowongan pekerjaan perusahaan</p>
        </div>

        <a href="{{ route('admin.lowongan.tambah') }}"
            class="btn-primary"
            style="text-decoration:none;">

            <i class="fas fa-plus"></i>
            Tambah Lowongan

        </a>
    </div>

    <!-- TOOLBAR -->
    <form method="GET" action="{{ url()->current() }}">
    <div class="table-toolbar">
        <div class="toolbar-search">
            <i class="fas fa-search"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lowongan pekerjaan..." onchange="this.form.submit()">
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

            <!-- CUSTOM DROPDOWN STATUS (CSS ada di content.css, cari prefix .psh-) -->
            @php
                $statusAktif = request('status', 'semua');
                $labelStatus = match($statusAktif) {
                    'aktif' => 'Aktif',
                    'tutup' => 'Ditutup',
                    default => 'Semua Status',
                };
            @endphp

            <input type="hidden" name="status" id="pshStatusInput" value="{{ $statusAktif }}">

            <div class="psh-dropdown" id="pshDropdownStatus">
                <button type="button" class="psh-dropdown-toggle" onclick="pshToggleDropdown()">
                    <i class="fas fa-filter psh-dropdown-icon-left"></i>
                    <span id="pshDropdownLabel">{{ $labelStatus }}</span>
                    <i class="fas fa-chevron-down psh-dropdown-icon-right"></i>
                </button>

                <div class="psh-dropdown-menu" id="pshDropdownMenu">
                    <div class="psh-dropdown-item {{ $statusAktif == 'semua' ? 'is-active' : '' }}"
                        onclick="pshPilihStatus('semua', 'Semua Status')">
                        <span>Semua Status</span>
                        <i class="fas fa-check psh-dropdown-check"></i>
                    </div>
                    <div class="psh-dropdown-item {{ $statusAktif == 'aktif' ? 'is-active' : '' }}"
                        onclick="pshPilihStatus('aktif', 'Aktif')">
                        <span>
                            <span class="psh-dot psh-dot-success"></span>
                            Aktif
                        </span>
                        <i class="fas fa-check psh-dropdown-check"></i>
                    </div>
                    <div class="psh-dropdown-item {{ $statusAktif == 'tutup' ? 'is-active' : '' }}"
                        onclick="pshPilihStatus('tutup', 'Ditutup')">
                        <span>
                            <span class="psh-dot psh-dot-warning"></span>
                            Ditutup
                        </span>
                        <i class="fas fa-check psh-dropdown-check"></i>
                    </div>
                </div>
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
                    <th>Posisi</th>
                    <th>Perusahaan</th>
                    <th>Lokasi</th>
                    <th>Pelamar</th>
                    <th>Status</th>
                    <th>Batas Akhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($lowongan as $item)
                <tr>
                    <td>{{ $lowongan->firstItem() + $loop->index }}</td>

                    <td>{{ $item->judul_lowongan }}</td>

                    <td>{{ $item->perusahaan?->nama_perusahaan }}</td>

                    <td>{{ $item->lokasi }}</td>

                    <td>
                        <a href="{{ route('admin.lowongan.pelamar', $item->id) }}" class="pelamar-count-link">
                            <i class="fas fa-users"></i>
                            {{ $item->lamaran_count }} Pelamar
                        </a>
                    </td>

                    <td>
                        @if($item->status_lowongan == 'aktif')
                            <span class="badge success">Aktif</span>
                        @else
                            <span class="badge warning">Ditutup</span>
                        @endif
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y') }}
                    </td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        <a href="{{ route('LowonganPekerjaan.editLowonganPekerjaan', $item->id) }}"
                        class="btn-icon edit"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.lowongan.toggleStatus', $item->id) }}"
                            method="POST"
                            id="form-toggle-{{ $item->id }}"
                            style="margin:0;">

                            @csrf
                            @method('PATCH')

                            <button type="button"
                                    class="btn-icon {{ $item->status_lowongan == 'aktif' ? 'lock' : 'unlock' }}"
                                    title="{{ $item->status_lowongan == 'aktif' ? 'Tutup lowongan' : 'Aktifkan kembali' }}"
                                    onclick="konfirmasiToggleStatus('form-toggle-{{ $item->id }}', '{{ $item->status_lowongan == 'aktif' ? 'menutup' : 'mengaktifkan kembali' }}', '{{ addslashes($item->judul_lowongan) }}')"
                                    style="display:inline-flex; align-items:center; justify-content:center;">
                                <i class="fas {{ $item->status_lowongan == 'aktif' ? 'fa-lock' : 'fa-lock-open' }}"></i>
                            </button>

                        </form>

                        <form action="{{ route('admin.lowongan.delete', $item->id) }}"
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
                    <td colspan="8" style="text-align:center;padding:30px;">
                        Data lowongan belum tersedia
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    @if($lowongan->hasPages())
    <div class="table-pagination">
        <div class="pagination-info">
            Menampilkan {{ $lowongan->firstItem() ?? 0 }} - {{ $lowongan->lastItem() ?? 0 }}
            dari {{ $lowongan->total() }} data
        </div>

        <div class="pagination-links">
            {{ $lowongan->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif

</div>

<x-modal-success />
<x-modal-konfirmasi-hapus />
<x-modal-konfirmasi />

<style>
    .pelamar-count-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        background: #eef6f3;
        color: #2f8f6e;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        white-space: nowrap;
        transition: background 0.15s ease;
    }

    .pelamar-count-link:hover {
        background: #dcf0e8;
    }

    .btn-icon.lock {
        color: #b45309;
        background: rgba(217, 119, 6, 0.1);
    }
    .btn-icon.lock:hover {
        background: rgba(217, 119, 6, 0.18);
    }

    .btn-icon.unlock {
        color: #2f8f6e;
        background: rgba(47, 143, 110, 0.1);
    }
    .btn-icon.unlock:hover {
        background: rgba(47, 143, 110, 0.18);
    }

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

<script>
    function pshToggleDropdown() {
        document.getElementById('pshDropdownStatus').classList.toggle('is-open');
    }

    function pshPilihStatus(value, label) {
        document.getElementById('pshStatusInput').value = value;
        document.getElementById('pshDropdownStatus').closest('form').submit();
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('pshDropdownStatus');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('is-open');
        }
    });
</script>