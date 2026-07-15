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
    <div class="table-toolbar">
        <div class="toolbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari lowongan pekerjaan...">
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
                    <td>{{ $loop->iteration }}</td>

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

</div>

<x-modal-success />
<x-modal-konfirmasi-hapus />

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
</style>

@endsection

<script>
    function pshToggleDropdown() {
        document.getElementById('pshDropdownStatus').classList.toggle('is-open');
    }

    function pshPilihStatus(value, label) {
        const url = new URL(window.location.href);
        url.searchParams.set('status', value);
        window.location.href = url.toString();
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('pshDropdownStatus');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('is-open');
        }
    });
</script>