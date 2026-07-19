@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pelamar.css'])
@endpush

@section('content')

<div class="content-card">
    <div class="pelamar-content">

        <!-- HEADER -->
        <div class="pelamar-header">
            <div>
                <h2 class="section-title">Data Pelamar</h2>
                <p class="section-subtitle">
                    Daftar pelamar untuk lowongan
                    <strong>{{ $lowongan->judul_lowongan }}</strong>
                    @if($lowongan->perusahaan)
                        &mdash; {{ $lowongan->perusahaan->nama_perusahaan }}
                    @endif
                </p>
            </div>

            <a href="{{ route('LowonganPekerjaan.indexLowonganPekerjaan') }}"
                class="btn-primary"
                style="text-decoration:none;">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <!-- INFO LOWONGAN -->
        <div class="lowongan-info-box" style="display:flex; align-items:center; width:100%; box-sizing:border-box;">
            <div class="lowongan-info-item" style="flex:0 0 auto;">
                <span class="lowongan-info-label">Lokasi</span>
                <span class="lowongan-info-value">{{ $lowongan->lokasi }}</span>
            </div>

            <div class="lowongan-info-item" style="flex:0 0 auto;">
                <span class="lowongan-info-label">Batas Akhir</span>
                <span class="lowongan-info-value">
                    {{ \Carbon\Carbon::parse($lowongan->deadline)->translatedFormat('d F Y') }}
                </span>
            </div>

            <div class="lowongan-info-item" style="flex:0 0 auto;">
                <span class="lowongan-info-label">Status</span>
                <span class="lowongan-info-value">
                    @if($lowongan->status_lowongan == 'aktif')
                        <span class="badge success">Aktif</span>
                    @else
                        <span class="badge warning">Ditutup</span>
                    @endif
                </span>
            </div>

            <div class="lowongan-info-item" style="flex:0 0 auto; margin-left:auto; margin-right:0; padding-right:0;">
                <button type="button" class="btn-primary" id="btnSetJadwalInterview" style="white-space:nowrap;">
                    <i class="fas fa-calendar-check"></i>
                    Set Jadwal Interview
                </button>
            </div>
        </div>

        <!-- RINGKASAN -->
        <div class="ringkasan-strip">
            <div class="ringkasan-item">
                <span class="ringkasan-angka">{{ $ringkasan['total'] }}</span>
                <span class="ringkasan-label">Total Pelamar</span>
            </div>
            <div class="ringkasan-item is-pending">
                <span class="ringkasan-angka">{{ $ringkasan['pending'] }}</span>
                <span class="ringkasan-label">Pending</span>
            </div>
            <div class="ringkasan-item is-interview">
                <span class="ringkasan-angka">{{ $ringkasan['interview'] }}</span>
                <span class="ringkasan-label">Interview</span>
            </div>
            <div class="ringkasan-item is-diterima">
                <span class="ringkasan-angka">{{ $ringkasan['diterima'] }}</span>
                <span class="ringkasan-label">Diterima</span>
            </div>
            <div class="ringkasan-item is-ditolak">
                <span class="ringkasan-angka">{{ $ringkasan['ditolak'] }}</span>
                <span class="ringkasan-label">Ditolak</span>
            </div>
        </div>

        <!-- BULK ACTION BAR -->
        <form id="bulkStatusForm" action="{{ route('admin.lamaran.bulkStatus') }}" method="POST">
            @csrf
            @method('PATCH')
            <div id="bulkActionBar" class="bulk-action-bar" style="display:none; align-items:center; gap:12px; margin-bottom:14px; padding:10px 14px; background:#f5f6f8; border-radius:8px;">
                <span id="bulkSelectedCount" style="font-size:0.85rem; color:#555;">0 dipilih</span>

                <select name="status" id="bulkStatusSelect" required style="padding:8px 12px; border-radius:6px; border:1px solid #d5d7db;">
                    <option value="">Ubah status menjadi...</option>
                    <option value="pending">Pending</option>
                    <option value="interview">Interview</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>

                <button type="submit" class="btn-primary" style="padding:8px 16px;">
                    Terapkan
                </button>

                <button type="button" id="btnBatalPilih" class="btn-secondary" style="padding:8px 16px; background:transparent; border:1px solid #d5d7db;">
                    Batalkan
                </button>
            </div>

            <!-- TABLE PELAMAR -->
            <div class="table-wrapper pelamar-table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width:36px;">
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th>No</th>
                            <th>Nama Pelamar</th>
                            <th>Email</th>
                            <th>Dokumen</th>
                            <th>Tanggal Melamar</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($daftarLamaran as $item)
                        <tr>
                            <td>
                                <input type="checkbox"
                                    class="row-check"
                                    name="lamaran_ids[]"
                                    value="{{ $item->id }}"
                                    form="bulkStatusForm">
                            </td>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->user?->name ?? '-' }}</td>

                            <td>{{ $item->user?->email ?? '-' }}</td>

                            <td>
                                @if($item->document)
                                    <a href="{{ asset('storage/' . $item->document->file_path) }}"
                                        target="_blank"
                                        class="pelamar-count-link">
                                        <i class="fas fa-file-alt"></i>
                                        Lihat Dokumen
                                    </a>
                                @else
                                    <span style="color:#9aa1ab;">Belum ada</span>
                                @endif
                            </td>

                            <td>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                            </td>

                            <td>
                                @php
                                    $statusBadge = match($item->status) {
                                        'diterima' => 'success',
                                        'interview' => 'info',
                                        'ditolak' => 'danger',
                                        default => 'warning',
                                    };
                                    $statusLabel = match($item->status) {
                                        'diterima' => 'Diterima',
                                        'interview' => 'Interview',
                                        'ditolak' => 'Ditolak',
                                        default => 'Pending',
                                    };
                                @endphp
                                <span class="badge status-badge {{ $statusBadge }}">{{ $statusLabel }}</span>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:30px;">
                                Belum ada pelamar untuk lowongan ini
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div>

@php
    // Ambil satu pelamar berstatus interview yang sudah punya jadwal,
    // dipakai untuk mengisi ulang (prefill) form modal saat dibuka kembali.
    $jadwalInterviewTerakhir = $daftarLamaran
        ->where('status', 'interview')
        ->firstWhere('jadwal_interview', '!=', null);
@endphp

<x-modal-jadwal-interview
    :lowongan="$lowongan"
    :ringkasan-interview="$ringkasan['interview']"
    :jadwal-terakhir="$jadwalInterviewTerakhir"
/>

@if(session('success'))
    <x-modal-success />
@endif

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkAll = document.getElementById('checkAll');
    const rowChecks = document.querySelectorAll('.row-check');
    const bulkBar = document.getElementById('bulkActionBar');
    const selectedCount = document.getElementById('bulkSelectedCount');
    const bulkForm = document.getElementById('bulkStatusForm');
    const btnBatal = document.getElementById('btnBatalPilih');

    function updateBulkBar() {
        const checked = document.querySelectorAll('.row-check:checked');
        selectedCount.textContent = checked.length + ' dipilih';
        bulkBar.style.display = checked.length > 0 ? 'flex' : 'none';

        checkAll.checked = checked.length === rowChecks.length && rowChecks.length > 0;
        checkAll.indeterminate = checked.length > 0 && checked.length < rowChecks.length;
    }

    checkAll?.addEventListener('change', function () {
        rowChecks.forEach(cb => cb.checked = checkAll.checked);
        updateBulkBar();
    });

    rowChecks.forEach(cb => cb.addEventListener('change', updateBulkBar));

    btnBatal?.addEventListener('click', function () {
        rowChecks.forEach(cb => cb.checked = false);
        checkAll.checked = false;
        updateBulkBar();
    });

    bulkForm?.addEventListener('submit', function (e) {
        const checked = document.querySelectorAll('.row-check:checked');
        const status = document.getElementById('bulkStatusSelect').value;

        if (checked.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu pelamar terlebih dahulu.');
            return;
        }

        if (!status) {
            e.preventDefault();
            alert('Pilih status yang ingin diterapkan.');
            return;
        }
    });
});
</script>
@endpush