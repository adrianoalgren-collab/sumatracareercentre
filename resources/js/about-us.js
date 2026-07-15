// about.js
// Diekstrak dari <script> inline pada about.blade.php

document.addEventListener("DOMContentLoaded", function () {
    const animatedItems = [
        /* HERO */
        ".section-eyebrow",
        ".section-title",
        ".section-sub",
        ".hero-btns",
        ".hero img",

        /* TIMELINE */
        ".job-card:nth-child(1)",
        ".job-card:nth-child(2)",
        ".job-card:nth-child(3)",

        /* VALUES */
        ".news-card:nth-child(1)",
        ".news-card:nth-child(2)",
        ".news-card:nth-child(3)",
        ".news-card:nth-child(4)",
        ".news-card:nth-child(5)",

        /* TESTIMONIAL */
        ".section-header",
        ".job-card",
        "form",

        /* CTA */
        ".cta-band-inner"
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