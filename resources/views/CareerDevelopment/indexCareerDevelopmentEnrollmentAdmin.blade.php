@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <a href="{{ route('admin.career.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="section-title">Peserta Kelas: {{ $class->judul }}</h2>
            <p class="section-subtitle">Kelola peserta yang mengikuti kelas Career Development ini</p>
        </div>
    </div>

    <!-- TOOLBAR -->
    <div class="table-toolbar">
        <div class="toolbar-search">
            <i class="fas fa-search"></i>
            <input type="text"
                   id="cceSearchInput"
                   placeholder="Cari nama atau email peserta..."
                   onkeyup="cceFilterTable()">
        </div>

        <div class="psh-dropdown" id="cceDropdownStatus">
            <button type="button" class="psh-dropdown-toggle" onclick="cceToggleDropdown()">
                <i class="fas fa-filter psh-dropdown-icon-left"></i>
                <span id="cceDropdownLabel">Semua Status</span>
                <i class="fas fa-chevron-down psh-dropdown-icon-right"></i>
            </button>

            <div class="psh-dropdown-menu" id="cceDropdownMenu">
                <div class="psh-dropdown-item is-active" data-status="semua" onclick="ccePilihStatus('semua', 'Semua Status', this)">
                    <span>Semua Status</span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
                <div class="psh-dropdown-item" data-status="aktif" onclick="ccePilihStatus('aktif', 'Aktif', this)">
                    <span>
                        <span class="psh-dot psh-dot-warning"></span>
                        Aktif
                    </span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
                <div class="psh-dropdown-item" data-status="selesai" onclick="ccePilihStatus('selesai', 'Selesai', this)">
                    <span>
                        <span class="psh-dot psh-dot-success"></span>
                        Selesai
                    </span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
                <div class="psh-dropdown-item" data-status="nonaktif" onclick="ccePilihStatus('nonaktif', 'Nonaktif', this)">
                    <span>
                        <span class="psh-dot psh-dot-muted"></span>
                        Nonaktif
                    </span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- SKELETON LOADING -->
    <div class="table-wrapper" id="cceSkeletonWrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td><div class="skeleton skeleton-text" style="width:20px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:160px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:180px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:100px;"></div></td>
                    <td><div class="skeleton skeleton-badge"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:110px;"></div></td>
                    <td>
                        <div style="display:flex; gap:8px;">
                            <div class="skeleton skeleton-icon"></div>
                        </div>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <!-- TABLE ASLI -->
    <div class="table-wrapper" id="cceTableWrapper" style="display:none;">
        <table class="modern-table" id="cceTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($enrollments as $item)
                <tr data-status="{{ $item->status }}"
                    data-search="{{ strtolower(($item->user->name ?? '').' '.($item->user->email ?? '')) }}">
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->user->name ?? '-' }}</td>

                    <td>{{ $item->user->email ?? '-' }}</td>

                    <td>
                        <div class="progress-wrapper">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $item->progress_percent }}%;"></div>
                            </div>
                            <span class="progress-label">{{ $item->progress_percent }}%</span>
                        </div>
                    </td>

                    <td>
                        <form action="{{ route('admin.career.enrollment.update', [$class->id, $item->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="status-select status-{{ $item->status }}" onchange="this.form.submit()">
                                <option value="aktif" {{ $item->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="nonaktif" {{ $item->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </form>
                    </td>

                    <td>{{ $item->enrolled_at?->format('d M Y') ?? '-' }}</td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        <form action="{{ route('admin.career.enrollment.destroy', [$class->id, $item->id]) }}"
                            method="POST"
                            id="form-hapus-enrollment-{{ $item->id }}"
                            style="margin:0;">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn-icon delete"
                                    title="Keluarkan Peserta"
                                    onclick="konfirmasiHapus('form-hapus-enrollment-{{ $item->id }}')"
                                    style="display:inline-flex; align-items:center; justify-content:center;">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:30px;">
                        Belum ada peserta yang mendaftar di kelas ini
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
        animation: cceShimmer 1.4s ease infinite;
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

    @keyframes cceShimmer {
        0% { background-position: 100% 0; }
        100% { background-position: -100% 0; }
    }

    .progress-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 120px;
    }

    .progress-bar {
        flex: 1;
        height: 6px;
        background: #e6e9ec;
        border-radius: 100px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: #2ecc71;
        border-radius: 100px;
        transition: width 0.3s;
    }

    .progress-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #555;
        min-width: 32px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        color: #555;
        text-decoration: none;
        margin-bottom: 8px;
        background: #f1f3f5;
    }

    .btn-back:hover {
        background: #e6e9ec;
    }

    .status-select {
        border: 1px solid #dfe3e6;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        background: #fff;
    }

    .status-select.status-aktif    { color: #b7791f; border-color: #f3d9a3; }
    .status-select.status-selesai  { color: #1e8e5a; border-color: #a9e0c4; }
    .status-select.status-nonaktif { color: #6b7280; border-color: #d1d5db; }

    .psh-dot-muted { background: #9ca3af; }
</style>

<script>
    function cceToggleDropdown() {
        document.getElementById('cceDropdownStatus').classList.toggle('is-open');
    }

    function ccePilihStatus(value, label, el) {
        document.getElementById('cceDropdownLabel').textContent = label;

        document.querySelectorAll('#cceDropdownMenu .psh-dropdown-item').forEach(function (item) {
            item.classList.remove('is-active');
        });
        el.classList.add('is-active');

        document.getElementById('cceDropdownStatus').classList.remove('is-open');
        document.getElementById('cceDropdownStatus').dataset.selected = value;

        cceFilterTable();
    }

    function cceFilterTable() {
        const keyword = document.getElementById('cceSearchInput').value.toLowerCase();
        const status = document.getElementById('cceDropdownStatus').dataset.selected || 'semua';

        document.querySelectorAll('#cceTable tbody tr[data-status]').forEach(function (row) {
            const matchSearch = row.dataset.search.includes(keyword);
            const matchStatus = status === 'semua' || row.dataset.status === status;
            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('cceDropdownStatus');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('is-open');
        }
    });

    window.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            document.getElementById('cceSkeletonWrapper').style.display = 'none';
            document.getElementById('cceTableWrapper').style.display = 'block';
        }, 400);
    });
</script>