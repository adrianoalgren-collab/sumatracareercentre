<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sumatra Career Centre')</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- ═══════════════ SIDEBAR ═══════════════ -->
<aside class="sidebar" id="sidebar">

    {{-- Brand --}}
    <a href="" class="sidebar-brand">
        <div class="brand-logo">S</div>
        <div class="brand-text">
            <span class="brand-name">Sumatra Career</span>
            <span class="brand-sub">Centre</span>
        </div>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        {{-- Main --}}
        <div class="nav-section-label">Main</div>

        <a href=""
           class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
           data-label="Dashboard">
            <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
            <span class="nav-label">Dashboard</span>
        </a>

        <a href="{{ route('LowonganPekerjaan.indexLowonganPekerjaan') }}"
        class="nav-item {{ request()->routeIs('LowonganPekerjaan.*', 'admin.lowongan.*') ? 'active' : '' }}"
        data-label="Lowongan Kerja">
            <span class="nav-icon"><i class="fas fa-briefcase"></i></span>
            <span class="nav-label">Lowongan Kerja</span>
            <span class="nav-badge">24</span>
        </a>

        <a href="{{ route('admin.pelamar.index') }}"
        class="nav-item {{ request()->routeIs('pelamar.*') ? 'active' : '' }}"
        data-label="Pelamar">
            <span class="nav-icon"><i class="fas fa-users"></i></span>
            <span class="nav-label">Pelamar</span>
            <span class="nav-badge gold">5</span>
        </a>

        <a href="{{ route('admin.artikel.index') }}"
        class="nav-item {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}"
        data-label="Artikel">
            <span class="nav-icon"><i class="fas fa-newspaper"></i></span>
            <span class="nav-label">Artikel</span>
        </a>

        <a href="{{ route('admin.perusahaan.index') }}"
            class="nav-item {{ request()->routeIs('admin.perusahaan.*') ? 'active' : '' }}"
            data-label="Perusahaan">
                <span class="nav-icon"><i class="fas fa-building"></i></span>
                <span class="nav-label">Perusahaan</span>
        </a>

        {{-- Career Services --}}
        <div class="nav-section-label">Layanan Karir</div>

        <div class="nav-item has-sub {{ request()->routeIs('events.*') ? 'active open' : '' }}"
             data-label="Event & Seminar"
             onclick="toggleSub(this)">
            <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
            <span class="nav-label">Event & Seminar</span>
            <span class="nav-arrow"><i class="fas fa-chevron-right"></i></span>
        </div>

        <div class="nav-submenu {{ request()->routeIs('events.*') ? 'open' : '' }}">
            <a href="" class="nav-subitem {{ request()->routeIs('events.index') ? 'active' : '' }}">Semua Event</a>
            <a href="" class="nav-subitem {{ request()->routeIs('events.create') ? 'active' : '' }}">Tambah Event</a>
            <a href="" class="nav-subitem">Pendaftaran</a>
        </div>

        <a href=""
           class="nav-item {{ request()->routeIs('counseling.*') ? 'active' : '' }}"
           data-label="Konseling Karir">
            <span class="nav-icon"><i class="fas fa-comments"></i></span>
            <span class="nav-label">Konseling Karir</span>
        </a>

        <a href=""
           class="nav-item {{ request()->routeIs('cv.*') ? 'active' : '' }}"
           data-label="CV Builder">
            <span class="nav-icon"><i class="fas fa-file-alt"></i></span>
            <span class="nav-label">CV Builder</span>
        </a>

        <a href=""
           class="nav-item {{ request()->routeIs('training.*') ? 'active' : '' }}"
           data-label="Pelatihan">
            <span class="nav-icon"><i class="fas fa-graduation-cap"></i></span>
            <span class="nav-label">Pelatihan</span>
        </a>

        {{-- Analytics --}}
        <div class="nav-section-label">Laporan</div>

        <a href=""
           class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}"
           data-label="Laporan & Analitik">
            <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
            <span class="nav-label">Laporan & Analitik</span>
        </a>

        {{-- System --}}
        <div class="nav-section-label">Sistem</div>

        <div class="nav-item has-sub {{ request()->routeIs('settings.*') ? 'active open' : '' }}"
             data-label="Pengaturan"
             onclick="toggleSub(this)">
            <span class="nav-icon"><i class="fas fa-cog"></i></span>
            <span class="nav-label">Pengaturan</span>
            <span class="nav-arrow"><i class="fas fa-chevron-right"></i></span>
        </div>

        <div class="nav-submenu {{ request()->routeIs('settings.*') ? 'open' : '' }}">
            <a href="" class="nav-subitem {{ request()->routeIs('settings.general') ? 'active' : '' }}">Umum</a>
            <a href="" class="nav-subitem {{ request()->routeIs('settings.users') ? 'active' : '' }}">Pengguna</a>
            <a href="" class="nav-subitem">Hak Akses</a>
        </div>

        {{-- Logout --}}
        <div class="nav-section-label">Akun</div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-item logout-btn" data-label="Logout">
                <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                <span class="nav-label">Logout</span>
            </button>
        </form>

    </nav>

    {{-- User card --}}
    <div class="sidebar-user">
        <div class="user-ava">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
        <div class="user-info">
            <div class="user-name">{{ auth()->user()->name ?? 'Admin Utama' }}</div>
            <div class="user-role">{{ auth()->user()->role ?? 'Administrator' }}</div>
        </div>
        <i class="fas fa-ellipsis-v user-more"></i>
    </div>

</aside>

<!-- ═══════════════ TOPBAR ═══════════════ -->
<header class="topbar" id="topbar">

    <div class="topbar-left">

        <button class="topbar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <nav class="topbar-breadcrumb">
            <span>{{ $breadcrumbRoot ?? 'Sumatra Career Centre' }}</span>

            @isset($breadcrumb)
                <span class="breadcrumb-sep">
                    <i class="fas fa-chevron-right" style="font-size:9px"></i>
                </span>
                <span class="breadcrumb-current">{{ $breadcrumb }}</span>
            @endisset
        </nav>

    </div>

    <div class="topbar-right">

        <button class="topbar-action">
            <i class="fas fa-bell"></i>
        </button>

        <button class="topbar-action">
            <i class="fas fa-envelope"></i>
        </button>

        <button class="topbar-action">
            <i class="fas fa-question-circle"></i>
        </button>

        <div class="topbar-divider"></div>

        <div class="topbar-profile">
            <div class="topbar-ava">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>

            <div class="topbar-user-info">
                <span class="topbar-user-name">{{ auth()->user()->name ?? 'Admin Utama' }}</span>
                <span class="topbar-user-role">{{ auth()->user()->role ?? 'Administrator' }}</span>
            </div>

            <i class="fas fa-chevron-down chevron"></i>
        </div>

    </div>

</header>

<!-- JS -->
<script>
document.getElementById('sidebarToggle').addEventListener('click', function () {
    document.body.classList.toggle('sidebar-collapsed');
    localStorage.setItem('sidebarCollapsed',
        document.body.classList.contains('sidebar-collapsed'));
});

if (localStorage.getItem('sidebarCollapsed') === 'true') {
    document.body.classList.add('sidebar-collapsed');
}

function toggleSub(el) {
    const isOpen = el.classList.contains('open');

    document.querySelectorAll('.nav-item.has-sub.open').forEach(i => {
        i.classList.remove('open');

        const sub = i.nextElementSibling;

        if (sub && sub.classList.contains('nav-submenu')) {
            sub.classList.remove('open');
        }
    });

    if (!isOpen) {
        el.classList.add('open');

        const sub = el.nextElementSibling;

        if (sub && sub.classList.contains('nav-submenu')) {
            sub.classList.add('open');
        }
    }
}
</script>

</body>
</html>