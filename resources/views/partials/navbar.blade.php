<button class="nav-toggle" id="navToggle" type="button" aria-label="Buka menu" aria-expanded="false">
    <span></span><span></span><span></span>
</button>

<nav class="navbar" id="navMenu">
    <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
        <li><a href="{{ route('deteksi') }}" class="{{ request()->routeIs('deteksi', 'deteksi.proses') ? 'active' : '' }}">Input Deteksi</a></li>
        <li><a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'active' : '' }}">Riwayat Deteksi</a></li>
    </ul>
</nav>
