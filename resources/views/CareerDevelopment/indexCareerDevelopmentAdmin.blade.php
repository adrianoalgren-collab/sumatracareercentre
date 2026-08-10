@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Data Career Development</h2>
            <p class="section-subtitle">Kelola seluruh kelas Career Development</p>
        </div>

        <a href="{{ route('admin.career.tambah') }}"
            class="btn-primary"
            style="text-decoration:none;">

            <i class="fas fa-plus"></i>
            Tambah Kelas

        </a>
    </div>

    <!-- TOOLBAR -->
    <div class="table-toolbar">
        <div class="toolbar-search">
            <i class="fas fa-search"></i>
            <input type="text"
                   id="ccdSearchInput"
                   placeholder="Cari judul kelas..."
                   value="{{ request('search') }}"
                   onkeydown="ccdHandleSearchEnter(event)">
        </div>

        <!-- CUSTOM DROPDOWN STATUS (CSS ada di content.css, cari prefix .psh-) -->
        @php
            $statusAktif = request('status', 'semua');
            $labelStatus = match($statusAktif) {
                'published' => 'Published',
                'draft' => 'Draft',
                default => 'Semua Status',
            };
        @endphp

        <div class="psh-dropdown" id="ccdDropdownStatus">
            <button type="button" class="psh-dropdown-toggle" onclick="ccdToggleDropdown()">
                <i class="fas fa-filter psh-dropdown-icon-left"></i>
                <span id="ccdDropdownLabel">{{ $labelStatus }}</span>
                <i class="fas fa-chevron-down psh-dropdown-icon-right"></i>
            </button>

            <div class="psh-dropdown-menu" id="ccdDropdownMenu">
                <div class="psh-dropdown-item {{ $statusAktif == 'semua' ? 'is-active' : '' }}"
                    onclick="ccdPilihStatus('semua', 'Semua Status')">
                    <span>Semua Status</span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
                <div class="psh-dropdown-item {{ $statusAktif == 'published' ? 'is-active' : '' }}"
                    onclick="ccdPilihStatus('published', 'Published')">
                    <span>
                        <span class="psh-dot psh-dot-success"></span>
                        Published
                    </span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
                <div class="psh-dropdown-item {{ $statusAktif == 'draft' ? 'is-active' : '' }}"
                    onclick="ccdPilihStatus('draft', 'Draft')">
                    <span>
                        <span class="psh-dot psh-dot-warning"></span>
                        Draft
                    </span>
                    <i class="fas fa-check psh-dropdown-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- SKELETON LOADING (tampil sebelum tabel asli muncul) -->
    <div class="table-wrapper" id="ccdSkeletonWrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kelas</th>
                    <th>Jumlah Lesson</th>
                    <th>Peserta</th>
                    <th>Dibuat Oleh</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td><div class="skeleton skeleton-text" style="width:20px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:180px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:60px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:60px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:120px;"></div></td>
                    <td><div class="skeleton skeleton-badge"></div></td>
                    <td>
                        <div style="display:flex; gap:8px;">
                            <div class="skeleton skeleton-icon"></div>
                            <div class="skeleton skeleton-icon"></div>
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
    <div class="table-wrapper" id="ccdTableWrapper" style="display:none;">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kelas</th>
                    <th>Jumlah Lesson</th>
                    <th>Peserta</th>
                    <th>Dibuat Oleh</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($classes as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->judul }}</td>

                    <td>{{ $item->lessons_count }} Lesson</td>

                    <td>{{ $item->enrollments_count ?? 0 }} Peserta</td>

                    <td>{{ $item->pembuat->name ?? '-' }}</td>

                    <td>
                        @if($item->status == 'published')
                            <span class="badge success">Published</span>
                        @else
                            <span class="badge warning">Draft</span>
                        @endif
                    </td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        <a href="{{ route('admin.career.lesson.index', $item->id) }}"
                        class="btn-icon"
                        title="Kelola Lesson"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-list"></i>
                        </a>

                        <a href="{{ route('admin.career.enrollment.index', $item->id) }}"
                        class="btn-icon"
                        title="Kelola Peserta"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-users"></i>
                        </a>

                        <a href="{{ route('admin.career.edit', $item->id) }}"
                        class="btn-icon edit"
                        title="Edit Kelas"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.career.delete', $item->id) }}"
                            method="POST"
                            id="form-hapus-{{ $item->id }}"
                            style="margin:0;">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn-icon delete"
                                    title="Hapus Kelas"
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
                        Data kelas Career Development belum tersedia
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

        @if($classes->hasPages())
            <div style="padding:16px;">
                {{ $classes->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>

<x-modal-success />
<x-modal-konfirmasi-hapus />

@endsection

<style>
    .skeleton {
        background: linear-gradient(90deg, #eceff1 25%, #e0e3e6 37%, #eceff1 63%);
        background-size: 400% 100%;
        animation: ccdShimmer 1.4s ease infinite;
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

    @keyframes ccdShimmer {
        0% { background-position: 100% 0; }
        100% { background-position: -100% 0; }
    }
</style>

<script>
    function ccdToggleDropdown() {
        document.getElementById('ccdDropdownStatus').classList.toggle('is-open');
    }

    function ccdPilihStatus(value, label) {
        const url = new URL(window.location.href);
        url.searchParams.set('status', value);
        window.location.href = url.toString();
    }

    function ccdHandleSearchEnter(event) {
        if (event.key === 'Enter') {
            const url = new URL(window.location.href);
            const value = document.getElementById('ccdSearchInput').value;
            if (value) {
                url.searchParams.set('search', value);
            } else {
                url.searchParams.delete('search');
            }
            window.location.href = url.toString();
        }
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('ccdDropdownStatus');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('is-open');
        }
    });

    window.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            document.getElementById('ccdSkeletonWrapper').style.display = 'none';
            document.getElementById('ccdTableWrapper').style.display = 'block';
        }, 400);
    });
</script>