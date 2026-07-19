{{--
    Component modal konfirmasi GENERIK — untuk aksi SELAIN hapus
    (tutup/aktifkan, nonaktifkan akun, batalkan lamaran, dll).

    Untuk hapus data, tetap pakai <x-modal-konfirmasi-hapus /> + konfirmasiHapus(),
    itu komponen terpisah dan tidak digantikan oleh ini.

    Cara pakai:
    1. Taruh SEKALI saja di dalam halaman (di luar loop):
       <x-modal-konfirmasi />

    2. Di tombol aksi, panggil fungsi konfirmasi() dengan konfigurasi:

       <form action="..." method="POST" id="form-tutup-{{ $item->id }}">
           @csrf
           @method('PATCH')
           <button type="button" class="btn-icon lock"
               onclick="konfirmasi('form-tutup-{{ $item->id }}', {
                   icon: 'fa-lock',
                   title: 'Tutup Lowongan?',
                   message: 'Lowongan tidak akan tampil untuk pelamar baru. Yakin ingin melanjutkan?',
                   buttonText: 'Ya, Tutup',
                   variant: 'warning'
               })">
               <i class="fas fa-lock"></i>
           </button>
       </form>

    Variant yang tersedia (menentukan warna ikon & tombol):
    - 'danger'  -> merah   (batalkan, tolak)
    - 'warning' -> amber   (tutup, nonaktifkan, peringatan)
    - 'success' -> hijau   (aktifkan, terima, konfirmasi positif)
    - 'primary' -> charcoal/gelap (aksi netral/default)

    Shortcut siap pakai untuk tutup/aktifkan lowongan:

    - konfirmasiToggleStatus(formId, aksi, namaData)
      aksi: 'menutup' atau 'mengaktifkan kembali'
      Contoh: onclick="konfirmasiToggleStatus('form-toggle-{{ $item->id }}', 'menutup', '{{ addslashes($item->judul_lowongan) }}')"

    Untuk aksi lain, langsung pakai konfirmasi() dengan konfigurasi custom
    seperti contoh di atas.
--}}

<div class="modal-overlay" id="modalKonfirmasi" style="display:none;">
    <div class="modal-box">
        <div class="modal-icon modal-icon-primary" id="modalKonfirmasiIcon">
            <i class="fas fa-question-circle" id="modalKonfirmasiIconInner"></i>
        </div>
        <h3 class="modal-title" id="modalKonfirmasiTitle">Konfirmasi Aksi</h3>
        <p class="modal-message" id="modalKonfirmasiMessage">
            Yakin ingin melanjutkan aksi ini?
        </p>
        <div class="modal-actions">
            <button type="button" class="btn-secondary" onclick="tutupModalKonfirmasi()">
                Batal
            </button>
            <button type="button" class="btn-confirm btn-confirm-primary" id="btnKonfirmasiAksi">
                <i class="fas fa-question-circle" id="btnKonfirmasiIcon"></i>
                <span id="btnKonfirmasiLabel">Ya, Lanjutkan</span>
            </button>
        </div>
    </div>
</div>

<style>
    #modalKonfirmasi.modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    #modalKonfirmasi .modal-box {
        background: #fff;
        border-radius: 14px;
        padding: 32px 28px;
        max-width: 360px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        transform: scale(0.9);
        opacity: 0;
        animation: popInModalKonfirmasi 0.2s ease forwards;
    }

    #modalKonfirmasi .modal-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        font-size: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    #modalKonfirmasi .modal-icon-danger  { background: #fee2e2; color: #dc2626; }
    #modalKonfirmasi .modal-icon-warning { background: #fef3c7; color: #b45309; }
    #modalKonfirmasi .modal-icon-success { background: #dcfce7; color: #15803d; }
    #modalKonfirmasi .modal-icon-primary { background: #e2e8f0; color: #1e293b; }

    #modalKonfirmasi .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    #modalKonfirmasi .modal-message {
        color: #64748b;
        font-size: 14px;
        margin: 0 0 24px;
        line-height: 1.5;
    }

    #modalKonfirmasi .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .btn-confirm {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.15s ease;
        color: #fff;
    }

    .btn-confirm-danger  { background: #dc2626; }
    .btn-confirm-danger:hover  { background: #b91c1c; }

    .btn-confirm-warning { background: #d97706; }
    .btn-confirm-warning:hover { background: #b45309; }

    .btn-confirm-success { background: #16a34a; }
    .btn-confirm-success:hover { background: #15803d; }

    .btn-confirm-primary { background: #1e293b; }
    .btn-confirm-primary:hover { background: #0f172a; }

    @keyframes popInModalKonfirmasi {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<script>
    let formTargetKonfirmasi = null;

    /**
     * Fungsi generik: buka modal konfirmasi untuk form apa pun.
     *
     * @param {string} formId  id form yang akan disubmit kalau dikonfirmasi
     * @param {object} opsi    { icon, title, message, buttonText, variant }
     *                         variant: 'danger' | 'warning' | 'success' | 'primary'
     */
    function konfirmasi(formId, opsi = {}) {
        formTargetKonfirmasi = document.getElementById(formId);

        const config = {
            icon: opsi.icon || 'fa-question-circle',
            title: opsi.title || 'Konfirmasi Aksi',
            message: opsi.message || 'Yakin ingin melanjutkan aksi ini?',
            buttonText: opsi.buttonText || 'Ya, Lanjutkan',
            variant: opsi.variant || 'primary',
        };

        const icon = document.getElementById('modalKonfirmasiIcon');
        icon.className = 'modal-icon modal-icon-' + config.variant;
        document.getElementById('modalKonfirmasiIconInner').className = 'fas ' + config.icon;

        document.getElementById('modalKonfirmasiTitle').textContent = config.title;
        document.getElementById('modalKonfirmasiMessage').textContent = config.message;

        const btn = document.getElementById('btnKonfirmasiAksi');
        btn.className = 'btn-confirm btn-confirm-' + config.variant;
        document.getElementById('btnKonfirmasiIcon').className = 'fas ' + config.icon;
        document.getElementById('btnKonfirmasiLabel').textContent = config.buttonText;

        document.getElementById('modalKonfirmasi').style.display = 'flex';
    }

    function tutupModalKonfirmasi() {
        document.getElementById('modalKonfirmasi').style.display = 'none';
        formTargetKonfirmasi = null;
    }

    document.getElementById('btnKonfirmasiAksi').addEventListener('click', function () {
        if (formTargetKonfirmasi) {
            formTargetKonfirmasi.submit();
        }
    });

    // Klik di luar box juga menutup modal
    document.getElementById('modalKonfirmasi').addEventListener('click', function (e) {
        if (e.target === this) {
            tutupModalKonfirmasi();
        }
    });

    /* -----------------------------------------------------------------
       SHORTCUT: preset untuk kasus yang paling sering dipakai
       (di luar hapus — hapus tetap pakai modal-konfirmasi-hapus)
    ----------------------------------------------------------------- */

    /**
     * Shortcut untuk konfirmasi tutup / aktifkan kembali.
     * @param {string} formId
     * @param {string} aksi   'menutup' atau 'mengaktifkan kembali'
     * @param {string} namaData
     */
    function konfirmasiToggleStatus(formId, aksi, namaData) {
        const isTutup = aksi === 'menutup';

        konfirmasi(formId, {
            icon: isTutup ? 'fa-lock' : 'fa-lock-open',
            title: isTutup ? 'Tutup Lowongan?' : 'Aktifkan Kembali Lowongan?',
            message: isTutup
                ? `Lowongan "${namaData}" tidak akan tampil untuk pelamar baru sampai kamu aktifkan kembali. Yakin ingin melanjutkan?`
                : `Lowongan "${namaData}" akan tampil kembali dan bisa dilamar oleh pelamar baru. Yakin ingin melanjutkan?`,
            buttonText: isTutup ? 'Ya, Tutup' : 'Ya, Aktifkan',
            variant: isTutup ? 'warning' : 'success',
        });
    }
</script>