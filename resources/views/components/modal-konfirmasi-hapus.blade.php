{{--
    Component modal konfirmasi hapus.
    Cara pakai: taruh SEKALI saja di dalam halaman (di luar loop),
    lalu ubah <form onsubmit="return confirm(...)"> jadi cukup:

    <form action="..." method="POST" id="form-hapus-{{ $item->id }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn-icon delete" onclick="konfirmasiHapus('form-hapus-{{ $item->id }}')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
--}}

<div class="modal-overlay" id="modalKonfirmasiHapus" style="display:none;">
    <div class="modal-box">
        <div class="modal-icon modal-icon-danger">
            <i class="fas fa-trash"></i>
        </div>
        <h3 class="modal-title">Hapus Data?</h3>
        <p class="modal-message">
            Data yang sudah dihapus tidak dapat dikembalikan. Yakin ingin melanjutkan?
        </p>
        <div class="modal-actions">
            <button type="button" class="btn-secondary" onclick="tutupModalHapus()">
                Batal
            </button>
            <button type="button" class="btn-danger" id="btnKonfirmasiHapus">
                <i class="fas fa-trash"></i>
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<style>
    #modalKonfirmasiHapus.modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    #modalKonfirmasiHapus .modal-box {
        background: #fff;
        border-radius: 14px;
        padding: 32px 28px;
        max-width: 360px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        transform: scale(0.9);
        opacity: 0;
        animation: popInModalHapus 0.2s ease forwards;
    }

    .modal-icon-danger {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #fee2e2;
        color: #dc2626;
        font-size: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    #modalKonfirmasiHapus .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    #modalKonfirmasiHapus .modal-message {
        color: #64748b;
        font-size: 14px;
        margin: 0 0 24px;
        line-height: 1.5;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #dc2626;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }

    @keyframes popInModalHapus {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<script>
    let formTargetHapus = null;

    function konfirmasiHapus(formId) {
        formTargetHapus = document.getElementById(formId);
        document.getElementById('modalKonfirmasiHapus').style.display = 'flex';
    }

    function tutupModalHapus() {
        document.getElementById('modalKonfirmasiHapus').style.display = 'none';
        formTargetHapus = null;
    }

    document.getElementById('btnKonfirmasiHapus').addEventListener('click', function () {
        if (formTargetHapus) {
            formTargetHapus.submit();
        }
    });

    // Klik di luar box juga menutup modal
    document.getElementById('modalKonfirmasiHapus').addEventListener('click', function (e) {
        if (e.target === this) {
            tutupModalHapus();
        }
    });
</script>