@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

<section class="hero">
    <div class="container hero-inner">
        <div class="hero-text reveal">
            <span class="chip">🌾 Kelompok Tani Makmur · Kabupaten Garut</span>
            <h1>Selamat Datang di AgriVision Garut – Sistem Deteksi Hama Tanaman Berbasis Computer Vision</h1>
            <p>
                Catat hasil prediksi model <strong>EfficientNet-B0</strong> dari foto daun tanaman,
                tentukan status serangan hama, dan pantau riwayatnya dalam satu tempat.
            </p>
            <div class="hero-actions">
                <a href="{{ route('deteksi') }}" class="btn btn-primary">🔍 Input Deteksi</a>
                <a href="{{ route('riwayat') }}" class="btn btn-ghost">📋 Lihat Riwayat</a>
            </div>
        </div>

        <div class="hero-card reveal">
            <div class="leaf-scan">
                <div class="scan-line"></div>
                <span class="leaf">🍃</span>
                <div class="scan-tag t1">Wereng Cokelat · 91%</div>
                <div class="scan-tag t2">Kerusakan 34%</div>
            </div>
            <p class="hero-card-note">Ilustrasi simulasi pemindaian daun</p>
        </div>
    </div>
</section>

<section class="container section">
    <div class="stat-grid">
        <div class="stat-card reveal">
            <span class="stat-icon">📍</span>
            <strong class="count" data-count="3">0</strong>
            <span>Kecamatan Pemantauan</span>
        </div>
        <div class="stat-card reveal">
            <span class="stat-icon">🐛</span>
            <strong class="count" data-count="3">0</strong>
            <span>Jenis Hama Dikenali</span>
        </div>
        <div class="stat-card reveal">
            <span class="stat-icon">🌱</span>
            <strong class="count" data-count="3">0</strong>
            <span>Komoditas Tanaman</span>
        </div>
        <div class="stat-card reveal">
            <span class="stat-icon">🧠</span>
            <strong>B0</strong>
            <span>Model EfficientNet</span>
        </div>
    </div>
</section>

<section class="container section">
    <div class="section-head reveal">
        <h2>Tujuan Pengembangan Sistem</h2>
        <p>Menggantikan pencatatan manual dengan alur digital yang rapi dan mudah ditelusuri.</p>
    </div>
    <div class="card-grid">
        <article class="card reveal">
            <div class="card-icon">⚡</div>
            <h3>Penanganan Lebih Cepat</h3>
            <p>Status deteksi dan rekomendasi langsung muncul berdasarkan confidence score, sehingga tindakan tidak tertunda.</p>
        </article>
        <article class="card reveal">
            <div class="card-icon">🗂️</div>
            <h3>Dokumentasi Teratur</h3>
            <p>Setiap hasil deteksi tersimpan di database dan dapat dibuka kembali sebagai riwayat serangan hama.</p>
        </article>
        <article class="card reveal">
            <div class="card-icon">🔬</div>
            <h3>Berbasis Computer Vision</h3>
            <p>Model klasifikasi citra mengenali jenis hama dari foto daun, lengkap dengan nilai keyakinan prediksinya.</p>
        </article>
    </div>
</section>

<section class="container section">
    <div class="section-head reveal">
        <h2>Cara Kerja Singkat</h2>
    </div>
    <ol class="steps">
        <li class="reveal"><span class="step-no">1</span><div><h3>Foto &amp; Prediksi</h3><p>Foto daun diklasifikasi model EfficientNet-B0 (pada prototipe ini hasilnya dimasukkan manual).</p></div></li>
        <li class="reveal"><span class="step-no">2</span><div><h3>Input Hasil</h3><p>Operator mengisi lokasi, tanaman, jenis hama, confidence score, dan tingkat kerusakan daun.</p></div></li>
        <li class="reveal"><span class="step-no">3</span><div><h3>Status &amp; Rekomendasi</h3><p>Sistem menentukan status deteksi dan saran penanganan, lalu menyimpannya ke database.</p></div></li>
    </ol>
</section>

@endsection
