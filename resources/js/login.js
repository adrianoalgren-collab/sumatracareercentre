// ===== Script khusus halaman login =====

function setTab(el) {
    document.querySelectorAll('.role-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    el.classList.add('active');
}

// Diperlukan karena tombol role masih memakai atribut onclick="setTab(this)"
// di Blade, sementara Vite membungkus file ini sebagai module (tidak otomatis
// global). Kalau nanti onclick diganti dengan addEventListener, baris ini
// bisa dihapus.
window.setTab = setTab;

function initLoginAnimations() {
    const animatedItems = [
        '.hero-label',
        '.hero-title',
        '.hero-desc',
        '.stats-row',
        '.hero-card',
    ];

    animatedItems.forEach((selector, index) => {
        const el = document.querySelector(selector);

        if (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(40px)';
            el.style.transition = 'all 0.8s ease';

            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 200 + index * 180);
        }
    });
}

document.addEventListener('DOMContentLoaded', initLoginAnimations);