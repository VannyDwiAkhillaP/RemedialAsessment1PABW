@extends('layouts.main')
@section('title', 'Riwayat Deteksi')
@section('content')
<section class="page-banner">
    <div class="container">
        <h1>Riwayat Deteksi Hama</h1>
        <p>Seluruh hasil deteksi yang tersimpan di database <code>db_agrivision</code>.</p>
    </div>
</section>

<div class="container section">

    <div class="stat-grid">
        <div class="stat-card"><span class="stat-icon">🗃️</span><strong class="count" data-count="{{ $ringkasan['total'] }}">0</strong><span>Total Deteksi</span></div>
        <div class="stat-card"><span class="stat-icon">❓</span><strong class="count" data-count="{{ $ringkasan['tidak_pasti'] }}">0</strong><span>Tidak Pasti</span></div>
        <div class="stat-card"><span class="stat-icon">⚠️</span><strong class="count" data-count="{{ $ringkasan['indikasi'] }}">0</strong><span>Indikasi Hama</span></div>
        <div class="stat-card"><span class="stat-icon">🚨</span><strong class="count" data-count="{{ $ringkasan['terkonfirmasi'] }}">0</strong><span>Hama Terkonfirmasi</span></div>
    </div>

    <div class="toolbar">
        <input type="search" id="filterCari" placeholder="🔎 Cari lokasi, tanaman, atau hama…">
        <select id="filterStatus">
            <option value="">Semua Status</option>
            <option value="Tidak Pasti">Tidak Pasti</option>
            <option value="Indikasi Hama">Indikasi Hama</option>
            <option value="Hama Terkonfirmasi">Hama Terkonfirmasi</option>
        </select>
        <a href="{{ route('deteksi') }}" class="btn btn-primary">➕ Tambah</a>
    </div>

    <div class="table-wrap">
        <table class="table" id="tabelRiwayat">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Tanaman</th>
                    <th>Jenis Hama</th>
                    <th>Confidence</th>
                    <th>Kerusakan</th>
                    <th>Status</th>
                    <th>Rekomendasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $item)
                    <tr data-status="{{ $item->status_deteksi }}"
                        data-search="{{ strtolower($item->lokasi . ' ' . $item->nama_tanaman . ' ' . $item->jenis_hama) }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="nowrap">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->nama_tanaman }}</td>
                        <td>{{ $item->jenis_hama }}</td>
                        <td>
                            <div class="mini-bar"><div class="mini-fill" style="width: {{ $item->confidence_score }}%"></div></div>
                            <small>{{ $item->confidence_score }}%</small>
                        </td>
                        <td>{{ rtrim(rtrim(number_format($item->tingkat_kerusakan, 1, ',', '.'), '0'), ',') }}%</td>
                        <td>
                            @if ($item->status_deteksi === 'Hama Terkonfirmasi')
                                <span class="badge badge-danger">{{ $item->status_deteksi }}</span>
                            @elseif ($item->status_deteksi === 'Indikasi Hama')
                                <span class="badge badge-warning">{{ $item->status_deteksi }}</span>
                            @else
                                <span class="badge badge-neutral">{{ $item->status_deteksi }}</span>
                            @endif
                        </td>
                        <td>{{ $item->rekomendasi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty">
                            Belum ada data deteksi. <a href="{{ route('deteksi') }}">Tambahkan sekarang</a>
                            atau jalankan <code>php artisan db:seed</code>.
                        </td>
                    </tr>
                @endforelse
                <tr id="barisKosong" hidden>
                    <td colspan="9" class="empty">Tidak ada data yang cocok dengan filter.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
