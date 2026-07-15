// home.js
// Diekstrak dari <script> inline pada home.blade.php

// Scroll reveal
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); }
  });
}, { threshold: 0.12 });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Hero stagger — set initial state first, then trigger on next paint
const heroEls = document.querySelectorAll('.hero-label, .hero-title, .hero-desc, .hero-btns, .hero-card');
heroEls.forEach((el, i) => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(24px)';
  el.style.transition = `opacity 0.8s ease ${i * 0.15}s, transform 0.8s ease ${i * 0.15}s`;
});
// Double rAF ensures styles are painted before transition starts
requestAnimationFrame(() => {
  requestAnimationFrame(() => {
    heroEls.forEach(el => {
      el.style.opacity = '1';
      el.style.transform = 'none';
    });
  });
});

// Stat counter animation
const animateCounters = () => {
  document.querySelectorAll('.stat-number').forEach(el => {
    const text = el.textContent;
    const num = parseFloat(text.replace(/[^0-9.]/g, ''));
    const suffix = text.replace(/[0-9.,]/g, '');
    let start = 0;
    const duration = 1800;
    const step = (timestamp) => {
      if (!start) start = timestamp;
      const progress = Math.min((timestamp - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const val = eased * num;
      el.textContent = (val >= 1000 ? (val/1000).toFixed(val >= 10000 ? 0 : 1) + 'k' : Math.round(val)) + suffix.replace('k','').trim();
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = text;
    };
    requestAnimationFrame(step);
  });
};

const statsObserver = new IntersectionObserver((entries) => {
  if (entries[0].isIntersecting) {
    animateCounters();
    statsObserver.disconnect();
  }
}, { threshold: 0.5 });

const statsBand = document.querySelector('.stats-band');
if (statsBand) statsObserver.observe(statsBand);