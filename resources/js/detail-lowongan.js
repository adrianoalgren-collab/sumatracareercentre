// detail-lowongan.js
// Diekstrak dari <script> inline pada detail-lowongan.blade.php

// Tampilkan skeleton dulu, lalu swap ke konten asli
// setelah SEMUA resource (termasuk gambar banner besar) selesai dimuat.
window.addEventListener('load', function () {
    const skeleton = document.getElementById('skeletonWrap');
    const real = document.getElementById('realContent');

    skeleton.style.display = 'none';
    real.style.display = 'block';

    // Beri jeda 1 frame supaya transisi opacity kerasa
    requestAnimationFrame(() => real.classList.add('show'));
});

// Fallback: kalau karena suatu hal event 'load' lama/tidak terpicu,
// paksa tampilkan konten asli setelah 4 detik supaya user tidak
// terjebak di skeleton selamanya.
setTimeout(function () {
    const skeleton = document.getElementById('skeletonWrap');
    const real = document.getElementById('realContent');

    if (real.style.display !== 'block') {
        skeleton.style.display = 'none';
        real.style.display = 'block';
        real.classList.add('show');
    }
}, 4000);