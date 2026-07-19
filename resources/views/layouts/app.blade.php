<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMA System</title>

    {{-- VITE (WAJIB) --}}
    @vite(['resources/css/sidebar.css', 'resources/js/app.js'])
    @vite(['resources/css/content.css', 'resources/js/app.js'])
    @vite(['resources/css/pelamar.css', 'resources/js/app.js'])

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- PENTING: tanpa @stack('styles') ini, semua @push('styles')
         dari child view (termasuk pelamar.blade.php) tidak pernah dirender --}}
    @stack('styles')
</head>

<body class="app-body">

    {{-- ================= SIDEBAR + TOPBAR ================= --}}
    @include('components.sidebar')

    {{-- ================= MAIN CONTENT ================= --}}
    <div
        class="main-wrapper"
        style="
            margin-top: 60px;     /* sama seperti marginTop React */
            padding: 24px;
            background: #f2f2f2;
            min-height: 100vh;
        "
    >
        @yield('content')
    </div>

    {{-- PENTING: tanpa @stack('scripts') ini, semua @push('scripts')
         dari child view (termasuk fungsi ubahStatusLangsung, handler bulk
         form, checkAll, dsb di pelamar.blade.php) tidak pernah dirender,
         sehingga tombol/dropdown ganti status terlihat ada tapi tidak
         benar-benar berfungsi sama sekali. --}}
    @stack('scripts')

</body>
</html>