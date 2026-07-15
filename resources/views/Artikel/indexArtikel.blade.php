@extends('layouts.app')

@section('content')

<div class="content-card">

    <!-- HEADER -->
    <div class="table-header">
        <div>
            <h2 class="section-title">Data Artikel</h2>
            <p class="section-subtitle">Kelola seluruh artikel yang dipublikasikan</p>
        </div>

        <a href="{{ route('admin.artikel.tambah') }}"
            class="btn-primary"
            style="text-decoration:none;">

            <i class="fas fa-plus"></i>
            Tambah Artikel

        </a>
    </div>

    <!-- TOOLBAR -->
    <div class="table-toolbar">
        <form action="{{ route('admin.artikel.index') }}" method="GET" style="display:contents;">

            <div class="toolbar-search">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel...">
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
                    <div class="psh-dropdown-item {{ $statusAktif == 'published' ? 'is-active' : '' }}"
                        onclick="pshPilihStatus('published', 'Published')">
                        <span>
                            <span class="psh-dot psh-dot-success"></span>
                            Published
                        </span>
                        <i class="fas fa-check psh-dropdown-check"></i>
                    </div>
                    <div class="psh-dropdown-item {{ $statusAktif == 'draft' ? 'is-active' : '' }}"
                        onclick="pshPilihStatus('draft', 'Draft')">
                        <span>
                            <span class="psh-dot psh-dot-warning"></span>
                            Draft
                        </span>
                        <i class="fas fa-check psh-dropdown-check"></i>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- SKELETON LOADING (tampil sebelum tabel asli muncul) -->
    <div class="table-wrapper" id="pshSkeletonWrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td><div class="skeleton skeleton-text" style="width:20px;"></div></td>
                    <td><div class="skeleton skeleton-thumb"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:180px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:100px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:120px;"></div></td>
                    <td><div class="skeleton skeleton-text" style="width:90px;"></div></td>
                    <td><div class="skeleton skeleton-badge"></div></td>
                    <td>
                        <div style="display:flex; gap:8px;">
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
    <div class="table-wrapper" id="pshTableWrapper" style="display:none;">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($artikel as $item)
                <tr>
                    <td>{{ $loop->iteration + ($artikel->currentPage() - 1) * $artikel->perPage() }}</td>

                    <td>
                        <div style="width:52px; height:38px; border-radius:6px; overflow:hidden; background:#eceff1; flex-shrink:0;">
                            @if($item->gambar_utama)
                                <img src="{{ asset('storage/'.$item->gambar_utama) }}" alt="{{ $item->judul }}"
                                     style="width:100%; height:100%; object-fit:cover; display:block;">
                            @else
                                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#9aa5ab;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </div>
                    </td>

                    <td style="max-width:260px;">
                        {{ $item->judul }}
                    </td>

                    <td>{{ $item->kategori ?? '-' }}</td>

                    <td>{{ $item->penulis_nama ?? '-' }}</td>

                    <td>{{ $item->created_at->format('d/m/Y') }}</td>

                    <td>
                        @if($item->status == 'published')
                            <span class="badge success">Published</span>
                        @else
                            <span class="badge warning">Draft</span>
                        @endif
                    </td>

                    <td style="display:flex; gap:8px; align-items:center;">

                        <a href="{{ route('admin.artikel.detail', $item->id) }}"
                        class="btn-icon"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.artikel.edit', $item->id) }}"
                        class="btn-icon edit"
                        style="display:inline-flex; align-items:center; justify-content:center;">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.artikel.delete', $item->id) }}"
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
                        Data artikel belum tersedia
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

        <!-- PAGINATION -->
        @if($artikel->hasPages())
        <div style="margin-top:24px; display:flex; justify-content:center; align-items:center; gap:8px; flex-wrap:wrap; padding-bottom:8px;">

            @if($artikel->onFirstPage())
                <span style="padding:8px 14px; border-radius:8px; border:1px solid #e0e3e6; color:#9aa5ab; font-size:0.85rem; opacity:0.6;">
                    &laquo;
                </span>
            @else
                <a href="{{ $artikel->previousPageUrl() }}"
                   style="padding:8px 14px; border-radius:8px; border:1px solid #e0e3e6; color:#374151; text-decoration:none; font-size:0.85rem;">
                    &laquo;
                </a>
            @endif

            @foreach($artikel->getUrlRange(1, $artikel->lastPage()) as $page => $url)
                @if($page == $artikel->currentPage())
                    <span style="padding:8px 14px; border-radius:8px; background:var(--forest, #004b5f); color:#fff; font-size:0.85rem; font-weight:600;">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       style="padding:8px 14px; border-radius:8px; border:1px solid #e0e3e6; color:#374151; text-decoration:none; font-size:0.85rem;">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if($artikel->hasMorePages())
                <a href="{{ $artikel->nextPageUrl() }}"
                   style="padding:8px 14px; border-radius:8px; border:1px solid #e0e3e6; color:#374151; text-decoration:none; font-size:0.85rem;">
                    &raquo;
                </a>
            @else
                <span style="padding:8px 14px; border-radius:8px; border:1px solid #e0e3e6; color:#9aa5ab; font-size:0.85rem; opacity:0.6;">
                    &raquo;
                </span>
            @endif

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

    .skeleton-thumb {
        height: 38px;
        width: 52px;
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
        }, 400);
    });
</script>