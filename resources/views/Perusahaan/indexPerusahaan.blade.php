@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Data Perusahaan</h2>
            <p class="section-subtitle">Kelola seluruh data perusahaan yang terdaftar</p>
        </div>

        <a href="{{ route('admin.perusahaan.tambah') }}"
            class="btn-primary"
            style="text-decoration:none;">

            <i class="fas fa-plus"></i>
            Tambah Perusahaan

        </a>
    </div>

    <!-- TOOLBAR -->
    <div class="table-toolbar">
        <div class="toolbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari nama perusahaan...">
        </div>

        <!-- CUSTOM DROPDOWN STATUS (CSS ada di content.css, cari prefix .psh-) -->
        @php
            $statusAktif = request('status', 'semua');
            $labelStatus = match($statusAktif) {
                'aktif' => 'Aktif',
                'nonaktif' => 'Nonaktif',
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
                <div class="psh-dropdown-item {{ $statusAktif == 'nonaktif' ? 'is-active' : '' }}"
                    onclick="pshPilihStatus('nonaktif', 'Nonaktif')">
                    <span>
                        <span class="psh-dot psh-dot-warning"></span>
                        Nonaktif
                    </span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- SKELETON LOADING (tampil sebelum tabel asli muncul) -->
    <div class="table-wrapper" id="pshSkeletonWrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td><div class="skeleton skeleton-text" style="width:20px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:140px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:160px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:100px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:120px;"></div></td>
                    <td><div class="skeleton skeleton-badge"></div></td>
                    <td>
                        <div style="display:flex; gap:8px;">
                            <div class="skeleton skeleton-icon"></div>
                            <div class="skeleton skeleton-icon"></div>
                        </div>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <!-- TABLE ASLI (disembunyikan dulu) -->
    <div class="table-wrapper" id="pshTableWrapper" style="display:none;">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($perusahaan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nama_perusahaan }}</td>

                    <td>{{ $item->email_perusahaan }}</td>

                    <td>{{ $item->telepon_perusahaan ?? '-' }}</td>

                    <td>
                        @if($item->website_perusahaan)
                            <a href="{{ $item->website_perusahaan }}" target="_blank" rel="noopener">
                                {{ $item->website_perusahaan }}
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($item->status_perusahaan == 'aktif')
                            <span class="badge success">Aktif</span>
                        @else
                            <span class="badge warning">Nonaktif</span>
                        @endif
                    </td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        <a href="{{ route('admin.perusahaan.edit', $item->id) }}"
                        class="btn-icon edit"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.perusahaan.delete', $item->id) }}"
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
                        Data perusahaan belum tersedia
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

<x-modal-success />
<x-modal-konfirmasi-hapus />

@endsection

<style>
    .skeleton {
        background: linear-gradient(90deg, #eceff1 25%, #e0e3e6 37%, #eceff1 63%);
        background-size: 400% 100%;
        animation: pshShimmer 1.4s ease infinite;
        border-radius: 4px;
    }

    .skeleton-text {
        height: 14px;
    }

    .skeleton-badge {
        height: 22px;
        width: 70px;
        border-radius: 20px;
    }

    .skeleton-icon {
        height: 28px;
        width: 28px;
        border-radius: 6px;
    }

    @keyframes pshShimmer {
        0% { background-position: 100% 0; }
        100% { background-position: -100% 0; }
    }
</style>

<script>
    function pshToggleDropdown() {
        document.getElementById('pshDropdownStatus').classList.toggle('is-open');
    }

    function pshPilihStatus(value, label) {
        // Redirect dengan query string ?status=..., agar filter diproses oleh controller
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

    // Tampilkan tabel asli setelah delay singkat, sembunyikan skeleton
    window.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            document.getElementById('pshSkeletonWrapper').style.display = 'none';
            document.getElementById('pshTableWrapper').style.display = 'block';
        }, 400); // 400ms — cukup untuk kesan transisi halus, tidak lama
    });
</script>