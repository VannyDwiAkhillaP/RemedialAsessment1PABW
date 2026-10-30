@extends('layouts.main')
@section('title', 'Input Deteksi')
@section('content')

<section class="page-banner">
    <div class="container">
        <h1>Input Hasil Deteksi Hama</h1>
        <p>Masukkan hasil prediksi model EfficientNet-B0 dari foto daun tanaman.</p>
    </div>
</section>

<div class="container section">
    <div class="form-layout">
        <form action="{{ route('deteksi.proses') }}" method="POST" class="panel form-card reveal" id="formDeteksi" novalidate>
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali isian Anda:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="field">
                <label for="lokasi">Lokasi Lahan</label>
                <select name="lokasi" id="lokasi" required>
                    <option value="" disabled {{ old('lokasi') ? '' : 'selected' }}>— Pilih lokasi —</option>
                    @foreach (['Garut Kota', 'Tarogong Kaler', 'Samarang'] as $lok)
                        <option value="{{ $lok }}" {{ old('lokasi') === $lok ? 'selected' : '' }}>{{ $lok }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="nama_tanaman">Nama Tanaman</label>
                    <input type="text" name="nama_tanaman" id="nama_tanaman" list="listTanaman"
                        placeholder="Contoh: Padi" value="{{ old('nama_tanaman') }}" required>
                    <datalist id="listTanaman">
                        <option value="Padi"><option value="Jagung"><option value="Cabai">
                    </datalist>
                </div>

                <div class="field">
                    <label for="jenis_hama">Jenis Hama Hasil Prediksi</label>
                    <input type="text" name="jenis_hama" id="jenis_hama" list="listHama"
                        placeholder="Contoh: Wereng Cokelat" value="{{ old('jenis_hama') }}" required>
                    <datalist id="listHama">
                        <option value="Wereng Cokelat"><option value="Ulat Grayak"><option value="Kutu Daun">
                    </datalist>
                </div>
            </div>

            <div class="field">
                <label for="confidence_score">Confidence Score (%)</label>
                <div class="slider-row">
                    <input type="range" id="scoreRange" min="0" max="100" value="{{ old('confidence_score', 70) }}">
                    <input type="number" name="confidence_score" id="confidence_score" min="0" max="100" step="1"
                        value="{{ old('confidence_score', 70) }}" required>
                    <span class="unit">%</span>
                </div>
            </div>

            <div class="field">
                <label for="tingkat_kerusakan">Tingkat Kerusakan Daun (%)</label>
                <div class="slider-row">
                    <input type="range" id="damageRange" min="0" max="100" step="0.5" value="{{ old('tingkat_kerusakan', 20) }}">
                    <input type="number" name="tingkat_kerusakan" id="tingkat_kerusakan" min="0" max="100" step="0.1"
                        value="{{ old('tingkat_kerusakan', 20) }}" required>
                    <span class="unit">%</span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block" id="btnSubmit">💾 Simpan &amp; Lihat Hasil</button>
        </form>

        {{-- Pratinjau status real-time (JavaScript) --}}
        <aside class="panel preview reveal">
            <h2>Pratinjau Status</h2>
            <div class="gauge">
                <div class="gauge-fill" id="gaugeFill"></div>
            </div>
            <p class="gauge-label"><span id="previewScore">70</span>% confidence</p>

            <span class="badge badge-lg badge-warning" id="previewStatus">Indikasi Hama</span>
            <p class="preview-reco" id="previewReco">Lakukan pemantauan intensif</p>

            <div class="damage-meter">
                <div class="damage-head"><span>Kerusakan daun</span><strong id="previewDamage">20%</strong></div>
                <div class="bar"><div class="bar-fill" id="damageFill"></div></div>
            </div>

            <ul class="legend">
                <li><i class="dot dot-neutral"></i> &lt; 50% Tidak Pasti</li>
                <li><i class="dot dot-warning"></i> 50–80% Indikasi Hama</li>
                <li><i class="dot dot-danger"></i> &gt; 80% Hama Terkonfirmasi</li>
            </ul>
        </aside>
    </div>
</div>

@endsection
