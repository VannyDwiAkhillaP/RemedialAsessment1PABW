@extends('layouts.main')
@section('title', 'Tentang')
@section('content')
<section class="page-banner">
    <div class="container">
        <h1>Tentang AgriVision Garut</h1>
        <p>Sistem pencatatan hasil deteksi hama tanaman untuk Kelompok Tani Makmur, Kabupaten Garut.</p>
    </div>
</section>

<div class="container section">

    <div class="two-col">
        <article class="panel reveal">
            <h2>🎯 Tujuan Sistem</h2>
            <ul class="check-list">
                <li>Mempercepat penanganan serangan hama pada lahan pertanian.</li>
                <li>Mencatat jenis hama, tingkat kerusakan daun, dan riwayat serangan secara teratur.</li>
                <li>Menentukan status deteksi dan rekomendasi penanganan dari nilai confidence score.</li>
                <li>Menjadi dasar pemantauan serangan hama di setiap kecamatan.</li>
            </ul>
        </article>

        <article class="panel reveal">
            <h2>🧠 Model Klasifikasi</h2>
            <p>
                Sistem memakai model <strong>EfficientNet-B0</strong>, yaitu arsitektur Convolutional Neural Network
                yang ringan namun akurat, dilatih untuk mengklasifikasikan jenis hama dari foto daun tanaman.
                Keluaran model berupa <em>jenis hama</em> beserta <em>confidence score</em>.
            </p>
            <p class="note">Pada prototipe ini hasil prediksi dimasukkan manual oleh pengguna (simulasi), tanpa koneksi langsung ke model.</p>
        </article>
    </div>

    <div class="section-head reveal">
        <h2>📍 Lokasi Deteksi</h2>
    </div>
    <div class="card-grid">
        <article class="card reveal"><div class="card-icon">🏙️</div><h3>Garut Kota</h3><p>Wilayah pusat kabupaten dengan lahan pertanian di sekitar kota.</p></article>
        <article class="card reveal"><div class="card-icon">🌄</div><h3>Tarogong Kaler</h3><p>Kawasan persawahan dan kebun sayur yang rutin dipantau.</p></article>
        <article class="card reveal"><div class="card-icon">🌾</div><h3>Samarang</h3><p>Kawasan dataran tinggi dengan komoditas sayuran dan palawija.</p></article>
    </div>

    <div class="section-head reveal">
        <h2>📊 Parameter yang Dicatat</h2>
    </div>
    <div class="card-grid">
        <article class="card reveal"><div class="card-icon">🐛</div><h3>Jenis Hama</h3><p>Hasil prediksi model: Wereng Cokelat, Ulat Grayak, atau Kutu Daun.</p></article>
        <article class="card reveal"><div class="card-icon">🎯</div><h3>Confidence Score</h3><p>Tingkat keyakinan model terhadap prediksinya, dalam persen.</p></article>
        <article class="card reveal"><div class="card-icon">🍂</div><h3>Tingkat Kerusakan Daun</h3><p>Persentase kerusakan daun akibat serangan hama.</p></article>
    </div>

    <div class="section-head reveal">
        <h2>🚦 Kriteria Status Deteksi</h2>
    </div>
    <div class="table-wrap reveal">
        <table class="table">
            <thead>
                <tr><th>Confidence Score</th><th>Status Deteksi</th><th>Rekomendasi</th></tr>
            </thead>
            <tbody>
                <tr><td>Kurang dari 50%</td><td><span class="badge badge-neutral">Tidak Pasti</span></td><td>Perlu verifikasi manual oleh petugas</td></tr>
                <tr><td>50 – 80%</td><td><span class="badge badge-warning">Indikasi Hama</span></td><td>Lakukan pemantauan intensif</td></tr>
                <tr><td>Lebih dari 80%</td><td><span class="badge badge-danger">Hama Terkonfirmasi</span></td><td>Segera lakukan pengendalian hama</td></tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
