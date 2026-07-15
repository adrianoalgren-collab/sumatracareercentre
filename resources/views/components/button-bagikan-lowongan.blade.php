@props(['lowongan'])

@php
    $shareId = 'share-' . $lowongan->id;
@endphp

<!-- TOMBOL BAGIKAN -->
<button type="button" class="btn-save-job share-trigger" data-share-target="{{ $shareId }}-modal">
    <span class="material-icons-round">share</span>
    Bagikan Lowongan
</button>

<!-- MODAL BAGIKAN -->
<div id="{{ $shareId }}-modal" class="share-modal-overlay">
    <div class="share-modal-card">

        <div class="share-modal-header">
            <div>
                <div class="section-eyebrow" style="margin-bottom:6px;">Bagikan</div>
                <h3 class="job-title" style="margin:0;">{{ $lowongan->judul_lowongan }}</h3>
            </div>

            <button type="button" class="share-modal-close">
                <span class="material-icons-round">close</span>
            </button>
        </div>

        <p class="section-sub" style="margin:14px 0 24px; font-size:0.9rem;">
            Bagikan lowongan ini ke rekan, komunitas, atau media sosial kamu.
        </p>

        <div class="share-modal-grid">

            <a href="#" class="share-option share-whatsapp" target="_blank" rel="noopener">
                <span class="share-option-icon" style="background:#25D366;">
                    <span class="material-icons-round">chat</span>
                </span>
                <span>WhatsApp</span>
            </a>

            <a href="#" class="share-option share-telegram" target="_blank" rel="noopener">
                <span class="share-option-icon" style="background:#26A5E4;">
                    <span class="material-icons-round">send</span>
                </span>
                <span>Telegram</span>
            </a>

            <a href="#" class="share-option share-facebook" target="_blank" rel="noopener">
                <span class="share-option-icon" style="background:#1877F2;">
                    <span class="material-icons-round">thumb_up</span>
                </span>
                <span>Facebook</span>
            </a>

            <button type="button" class="share-option share-instagram">
                <span class="share-option-icon" style="background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);">
                    <span class="material-icons-round">photo_camera</span>
                </span>
                <span>Instagram</span>
            </button>

        </div>

        <div class="share-modal-copy">
            <span class="material-icons-round" style="color:#5a7480; font-size:18px;">link</span>
            <input type="text" class="share-modal-copy-input" value="" readonly>
            <button type="button" class="share-modal-copy-btn">
                <span class="share-copy-label">Salin</span>
            </button>
        </div>

    </div>
</div>

<style>
    .share-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(11, 31, 38, 0.55);
        backdrop-filter: blur(3px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .share-modal-overlay.is-open {
        display: flex;
    }

    .share-modal-overlay.is-open.is-visible {
        opacity: 1;
    }

    .share-modal-card {
        background: #fff;
        border-radius: 24px;
        max-width: 440px;
        width: 100%;
        padding: 32px;
        box-shadow: 0 40px 100px rgba(0,0,0,.25);
        transform: translateY(16px) scale(0.98);
        transition: transform 0.25s ease;
    }

    .share-modal-overlay.is-visible .share-modal-card {
        transform: translateY(0) scale(1);
    }

    .share-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
    }

    .share-modal-close {
        background: #f2f6f8;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #004B5F;
        flex-shrink: 0;
        transition: background .15s;
    }

    .share-modal-close:hover {
        background: #e4edf0;
    }

    .share-modal-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .share-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.78rem;
        color: #1f2937;
        padding: 6px 0;
        border-radius: 14px;
        transition: background .15s;
    }

    .share-option:hover {
        background: #f7fbfc;
    }

    .share-option-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .share-option-icon .material-icons-round {
        font-size: 24px;
    }

    .share-modal-copy {
        margin-top: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f7fbfc;
        border: 1px solid #dbe5ea;
        border-radius: 12px;
        padding: 10px 14px;
    }

    .share-modal-copy-input {
        flex: 1;
        border: none;
        background: none;
        outline: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.8rem;
        color: #5a7480;
    }

    .share-modal-copy-btn {
        border: none;
        background: #004B5F;
        color: #fff;
        padding: 8px 16px;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s;
        white-space: nowrap;
    }

    .share-modal-copy-btn:hover {
        background: #003647;
    }
</style>

<script>
(function () {
    const shareId = '{{ $shareId }}-modal';
    const overlay = document.getElementById(shareId);
    const trigger = document.querySelector('.share-trigger[data-share-target="' + shareId + '"]');

    if (!overlay || !trigger) return;

    // Pindahkan modal ke akhir <body> supaya lepas dari parent manapun
    // (misal <aside style="position:sticky">) yang bisa memotong/menjebak
    // elemen position:fixed di dalamnya.
    if (overlay.parentElement !== document.body) {
        document.body.appendChild(overlay);
    }

    const pageUrl = window.location.href;
    const pageTitle = @json($lowongan->judul_lowongan) + ' - Sumatra Career Centre';
    const shareText = encodeURIComponent(pageTitle + '\n' + pageUrl);

    // Isi input link
    overlay.querySelector('.share-modal-copy-input').value = pageUrl;

    function openModal() {
        overlay.classList.add('is-open');
        requestAnimationFrame(function () {
            overlay.classList.add('is-visible');
        });
    }

    function closeModal() {
        overlay.classList.remove('is-visible');
        setTimeout(function () {
            overlay.classList.remove('is-open');
        }, 200);
    }

    trigger.addEventListener('click', openModal);
    overlay.querySelector('.share-modal-close').addEventListener('click', closeModal);

    // Tutup saat klik area luar card
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) {
            closeModal();
        }
    });

    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
            closeModal();
        }
    });

    // Set link tiap platform
    overlay.querySelector('.share-whatsapp').href =
        'https://wa.me/?text=' + shareText;

    overlay.querySelector('.share-telegram').href =
        'https://t.me/share/url?url=' + encodeURIComponent(pageUrl) + '&text=' + encodeURIComponent(pageTitle);

    overlay.querySelector('.share-facebook').href =
        'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl);

    // Instagram: copy link lalu buka IG
    overlay.querySelector('.share-instagram').addEventListener('click', function () {
        navigator.clipboard.writeText(pageUrl).then(function () {
            alert('Tautan disalin! Buka Instagram dan tempel di Story atau DM kamu.');
            window.open('https://www.instagram.com/', '_blank');
        });
    });

    // Copy link manual
    overlay.querySelector('.share-modal-copy-btn').addEventListener('click', function () {
        const label = overlay.querySelector('.share-copy-label');
        navigator.clipboard.writeText(pageUrl).then(function () {
            label.textContent = 'Tersalin!';
            setTimeout(function () { label.textContent = 'Salin'; }, 2000);
        });
    });
})();
</script>