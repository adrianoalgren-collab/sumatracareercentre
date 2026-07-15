// modal-konfirmasi-hapus.js
// Diekstrak dari <script> inline pada modal-konfirmasi-hapus.blade.php

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