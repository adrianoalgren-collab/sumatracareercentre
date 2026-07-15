// ===== Script khusus halaman register =====

function initRegisterAnimations() {
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
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'all 0.6s ease';

            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 150 + index * 120);
        }
    });
}

document.addEventListener('DOMContentLoaded', initRegisterAnimations);