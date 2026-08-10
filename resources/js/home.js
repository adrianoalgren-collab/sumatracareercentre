// ===== Script khusus halaman home =====

function initHeroAnimations() {
    const animatedItems = [
        '.hero-label',
        '.hero-title',
        '.hero-desc',
        '.hero-btns',
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

// Animasi elemen ber-class .reveal saat masuk viewport (stats, jobs, news, cta).
// Terpisah dari hero karena hero harus langsung muncul saat load,
// sementara .reveal baru muncul ketika di-scroll ke posisinya.
function initScrollReveal() {
    const revealElements = document.querySelectorAll('.reveal');

    if (!('IntersectionObserver' in window)) {
        // Fallback untuk browser lama yang tidak mendukung IntersectionObserver
        revealElements.forEach(el => el.classList.add('visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // animasi cukup sekali per elemen
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -60px 0px',
    });

    revealElements.forEach(el => observer.observe(el));
}

document.addEventListener('DOMContentLoaded', () => {
    initHeroAnimations();
    initScrollReveal();
});