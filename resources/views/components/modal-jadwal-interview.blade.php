@props([
    'lowongan',
    'ringkasanInterview' => 0,
    'jadwalTerakhir' => null,
])

<!-- MODAL SET JADWAL INTERVIEW -->
<div id="jadwalInterviewOverlay" class="jadwal-modal-overlay">
    <div class="jadwal-modal-box">
        <div class="jadwal-modal-header">
            <h3 class="jadwal-modal-title">Set Jadwal Interview</h3>
            <button type="button" class="jadwal-modal-close" id="btnCloseJadwalInterview" aria-label="Tutup">
                &times;
            </button>
        </div>

        <p class="jadwal-modal-desc">
            Jadwal ini akan diterapkan untuk semua pelamar dengan status
            <strong>Interview</strong> pada lowongan ini
            ({{ $ringkasanInterview }} pelamar). Pelamar dengan status lain tidak akan berubah.
        </p>

        <form id="jadwalInterviewForm"
            action="{{ route('admin.lamaran.setJadwalInterview', $lowongan->id) }}"
            method="POST">
            @csrf
            @method('PATCH')

            <div class="jadwal-form-group">
                <label for="jadwal_interview">Tanggal &amp; Jam Interview</label>
                <input type="datetime-local"
                    name="jadwal_interview"
                    id="jadwal_interview"
                    value="{{ optional($jadwalTerakhir?->jadwal_interview)->format('Y-m-d\TH:i') }}"
                    required>
            </div>

            <div class="jadwal-form-group">
                <label for="lokasi_interview">Lokasi / Link Meeting</label>
                <input type="text"
                    name="lokasi_interview"
                    id="lokasi_interview"
                    value="{{ $jadwalTerakhir->lokasi_interview ?? '' }}"
                    placeholder="Contoh: Kantor Pusat Lt. 3, atau link Zoom/Google Meet">
            </div>

            <div class="jadwal-form-group">
                <label for="catatan_interview">Catatan Tambahan</label>
                <textarea name="catatan_interview"
                    id="catatan_interview"
                    rows="3"
                    placeholder="Opsional">{{ $jadwalTerakhir->catatan_interview ?? '' }}</textarea>
            </div>

            <div class="jadwal-modal-actions">
                <button type="button" class="btn-secondary" id="btnBatalJadwalInterview">
                    Batal
                </button>
                <button type="submit" class="btn-primary">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .jadwal-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .jadwal-modal-overlay.is-open {
        display: flex;
    }

    .jadwal-modal-box {
        background: #fff;
        border-radius: 14px;
        padding: 24px 26px;
        max-width: 440px;
        width: 90%;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .jadwal-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .jadwal-modal-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }

    .jadwal-modal-close {
        background: none;
        border: none;
        font-size: 22px;
        line-height: 1;
        color: #94a3b8;
        cursor: pointer;
        padding: 0;
    }

    .jadwal-modal-close:hover {
        color: #475569;
    }

    .jadwal-modal-desc {
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
        margin: 0 0 18px;
    }

    .jadwal-form-group {
        margin-bottom: 14px;
    }

    .jadwal-form-group label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #334155;
        margin-bottom: 6px;
    }

    .jadwal-form-group input,
    .jadwal-form-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 9px 12px;
        border: 1px solid #d5d7db;
        border-radius: 8px;
        font-size: 13px;
        font-family: inherit;
        color: #1e293b;
    }

    .jadwal-form-group textarea {
        resize: vertical;
    }

    .jadwal-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // MODAL SET JADWAL INTERVIEW
    const btnOpenJadwal = document.getElementById('btnSetJadwalInterview');
    const jadwalOverlay = document.getElementById('jadwalInterviewOverlay');
    const btnCloseJadwal = document.getElementById('btnCloseJadwalInterview');
    const btnBatalJadwal = document.getElementById('btnBatalJadwalInterview');

    function openJadwalModal() {
        jadwalOverlay?.classList.add('is-open');
    }

    function closeJadwalModal() {
        jadwalOverlay?.classList.remove('is-open');
    }

    btnOpenJadwal?.addEventListener('click', openJadwalModal);
    btnCloseJadwal?.addEventListener('click', closeJadwalModal);
    btnBatalJadwal?.addEventListener('click', closeJadwalModal);

    jadwalOverlay?.addEventListener('click', function (e) {
        if (e.target === jadwalOverlay) {
            closeJadwalModal();
        }
    });
});
</script>
@endpush