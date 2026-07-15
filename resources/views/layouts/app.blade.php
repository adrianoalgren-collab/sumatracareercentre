<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMA System</title>

    {{-- VITE (WAJIB) --}}
    @vite(['resources/css/sidebar.css', 'resources/js/app.js'])
    @vite(['resources/css/content.css', 'resources/js/app.js'])
    @vite(['resources/css/Pelamar.css', 'resources/js/app.js'])

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

</body>
</html>