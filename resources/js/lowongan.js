// lowongan.js
// Diekstrak dari <script> inline pada lowongan.blade.php

// ===== SKELETON LOADING SAAT FILTER DISUBMIT =====
document.getElementById('filterForm').addEventListener('submit', function () {
    document.getElementById('realContent').style.display = 'none';
    document.getElementById('skeletonGrid').style.display = 'grid';

    const btn = document.getElementById('btnCari');
    btn.disabled = true;
    btn.textContent = 'Mencari...';
    btn.style.opacity = '0.7';
    btn.style.cursor = 'not-allowed';
    // form tetap lanjut submit secara normal (reload halaman)
});

document.addEventListener("DOMContentLoaded", function () {
    const animatedItems = [
        /* HERO HEADER */
        ".section-eyebrow",
        ".section-title",
        ".section-sub",

        /* FILTER SECTION */
        "input[type='text']",
        "select:nth-of-type(1)",
        "select:nth-of-type(2)",
        "select:nth-of-type(3)",

        /* JOB CARDS */
        ".job-card:nth-child(1)",
        ".job-card:nth-child(2)",
        ".job-card:nth-child(3)",

        /* FOOTER */
        "footer"
    ];

    animatedItems.forEach((selector, index) => {
        const elements = document.querySelectorAll(selector);

        elements.forEach((el) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(40px)";
            el.style.transition = "all 0.8s ease";

            setTimeout(() => {
                el.style.opacity = "1";
                el.style.transform = "translateY(0)";
            }, 200 + (index * 180));
        });
    });
});