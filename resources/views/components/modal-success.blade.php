@props([
    'title' => 'Berhasil!',
    'message' => null,
])

@php
    // Kalau tidak dikirim manual, ambil otomatis dari flash session
    $message = $message ?? session('success');
@endphp

@if($message)
<div class="modal-overlay" id="modalSuccess">
    <div class="modal-box">
        <div class="modal-icon">
            <i class="fas fa-check"></i>
        </div>
        <h3 class="modal-title">{{ $title }}</h3>
        <p class="modal-message">{{ $message }}</p>
    </div>
</div>

<style>
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        animation:
            fadeInOverlay 0.2s ease forwards,
            fadeOutOverlay 0.3s ease forwards 1.7s;
    }

    .modal-box {
        background: #fff;
        border-radius: 14px;
        padding: 32px 28px;
        max-width: 360px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        transform: scale(0.9);
        opacity: 0;
        animation: popInModal 0.25s ease 0.05s forwards;
    }

    .modal-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #d1fae5;
        color: #16a34a;
        font-size: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .modal-message {
        color: #64748b;
        font-size: 14px;
        margin: 0;
        line-height: 1.5;
    }

    @keyframes fadeInOverlay {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeOutOverlay {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    @keyframes popInModal {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<script>
    setTimeout(function () {
        const overlay = document.getElementById('modalSuccess');
        if (overlay) overlay.remove();
    }, 2000);
</script>
@endif