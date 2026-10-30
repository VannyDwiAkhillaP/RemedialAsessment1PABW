<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') | AgriVision Kabupaten Garut</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/agrivision.css') }}">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-logo">🌿</span>
            <span class="brand-text">
                <strong>AgriVision Kabupaten Garut</strong>
                <small>Deteksi Hama Berbasis Computer Vision</small>
            </span>
        </a>

        {{-- Navigasi (partial) --}}
        @include('partials.navbar')
    </div>
</header>

<main class="main">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container">
        <p>© 2026 AgriVision – Kelompok Tani Makmur Kabupaten Garut</p>
    </div>
</footer>

<script src="{{ asset('js/agrivision.js') }}"></script>
@stack('scripts')
</body>
</html>
