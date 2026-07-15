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
        <div class="lowongan-info-box">
            <div class="lowongan-info-item">
                <span class="lowongan-info-label">Lokasi</span>
                <span class="lowongan-info-value">{{ $lowongan->lokasi }}</span>
            </div>

            <div class="lowongan-info-item">
                <span class="lowongan-info-label">Batas Akhir</span>
                <span class="lowongan-info-value">
                    {{ \Carbon\Carbon::parse($lowongan->deadline)->translatedFormat('d F Y') }}
                </span>
            </div>

            <div class="lowongan-info-item">
                <span class="lowongan-info-label">Status</span>
                <span class="lowongan-info-value">
                    @if($lowongan->status_lowongan == 'aktif')
                        <span class="badge success">Aktif</span>
                    @else
                        <span class="badge warning">Ditutup</span>
                    @endif
                </span>
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

        <!-- TABLE PELAMAR -->
        <div class="table-wrapper pelamar-table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelamar</th>
                        <th>Email</th>
                        <th>Dokumen</th>
                        <th>Tanggal Melamar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($daftarLamaran as $item)
                    <tr>
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
                            <span class="badge {{ $statusBadge }}">{{ $statusLabel }}</span>
                        </td>

                        <td>
                            <form action="{{ route('admin.lamaran.status', $item->id) }}"
                                method="POST"
                                class="form-update-status">
                                @csrf
                                @method('PATCH')

                                <select name="status" class="status-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="interview" {{ $item->status == 'interview' ? 'selected' : '' }}>Interview</option>
                                    <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </form>
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

    </div>
</div>

<x-modal-success />

@endsection