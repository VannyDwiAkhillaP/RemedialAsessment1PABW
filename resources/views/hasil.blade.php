@extends('layouts.main')
@section('title', 'Hasil Deteksi')
@section('content')

<section class="page-banner">
    <div class="container">
        <h1>Hasil Deteksi Hama</h1>
        <p>Data berhasil disimpan ke database.</p>
    </div>
</section>

<div class="container section narrow">
    {{-- Kartu status: dibedakan dengan @if / @elseif / @else --}}
    @if ($status === 'Hama Terkonfirmasi')
        <div class="status-card status-danger reveal">
            <div class="status-icon">🚨</div>
            <div>
                <h2>{{ $status }}</h2>
                <p>{{ $rekomendasi }}</p>
            </div>
        </div>
    @elseif ($status === 'Indikasi Hama')
        <div class="status-card status-warning reveal">
            <div class="status-icon">⚠️</div>
            <div>
                <h2>{{ $status }}</h2>
                <p>{{ $rekomendasi }}</p>
            </div>
        </div>
    @else
        <div class="status-card status-neutral reveal">
            <div class="status-icon">❓</div>
            <div>
                <h2>{{ $status }}</h2>
                <p>{{ $rekomendasi }}</p>
            </div>
        </div>
    @endif

    <div class="table-wrap reveal">
        <table class="table table-detail">
            <tbody>
                <tr><th>Lokasi Lahan</th><td>{{ $data->lokasi }}</td></tr>
                <tr><th>Nama Tanaman</th><td>{{ $data->nama_tanaman }}</td></tr>
                <tr><th>Jenis Hama Hasil Prediksi</th><td>{{ $data->jenis_hama }}</td></tr>
                <tr><th>Confidence Score</th><td>{{ $data->confidence_score }}%</td></tr>
                <tr><th>Tingkat Kerusakan Daun</th><td>{{ rtrim(rtrim(number_format($data->tingkat_kerusakan, 1, ',', '.'), '0'), ',') }}%</td></tr>
                <tr>
                    <th>Status Deteksi</th>
                    <td>
                        @if ($status === 'Hama Terkonfirmasi')
                            <span class="badge badge-danger">{{ $status }}</span>
                        @elseif ($status === 'Indikasi Hama')
                            <span class="badge badge-warning">{{ $status }}</span>
                        @else
                            <span class="badge badge-neutral">{{ $status }}</span>
                        @endif
                    </td>
                </tr>
                <tr><th>Rekomendasi Penanganan</th><td>{{ $rekomendasi }}</td></tr>
                <tr><th>Waktu Pencatatan</th><td>{{ $data->created_at->format('d-m-Y H:i') }}</td></tr>
            </tbody>
        </table>
    </div>

    <div class="hero-actions center reveal">
        <a href="{{ route('deteksi') }}" class="btn btn-primary">➕ Input Lagi</a>
        <a href="{{ route('riwayat') }}" class="btn btn-ghost-dark">📋 Lihat Riwayat</a>
    </div>
</div>

@endsection
