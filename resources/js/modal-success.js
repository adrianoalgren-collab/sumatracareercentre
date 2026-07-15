// modal-success.js
// Diekstrak dari <script> inline pada modal-success.blade.php

setTimeout(function () {
    const overlay = document.getElementById('modalSuccess');
    if (overlay) overlay.remove();
}, 2000);