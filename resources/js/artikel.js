/* ====================================================
   ARTIKEL.JS
   Script untuk halaman Artikel - Sumatra Career Centre
   ==================================================== */

function setTab(el) {
    document.querySelectorAll('.role-tab').forEach(tab => {
        tab.classList.remove('active');
    });

    el.classList.add('active');
}

document.addEventListener("DOMContentLoaded", function () {
    const animatedItems = [
        ".hero-label",
        ".hero-title",
        ".hero-desc",
        ".hero-card",

        ".section-header",
        ".news-card",
        ".news-card-sm",

        ".article-search-wrapper",
        ".job-card:nth-child(1)",
        ".job-card:nth-child(2)",
        ".job-card:nth-child(3)",

        ".article-pagination",
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