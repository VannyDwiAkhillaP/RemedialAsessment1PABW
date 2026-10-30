<?php
namespace App\Http\Controllers;
use App\Models\DeteksiHama;
use Illuminate\Http\Request;

class DeteksiController extends Controller
{
    public function prosesData(Request $request)
    {
        $validated = $request->validate([
            'lokasi'            => 'required|in:Garut Kota,Tarogong Kaler,Samarang',
            'nama_tanaman'      => 'required|string|max:100',
            'jenis_hama'        => 'required|string|max:100',
            'confidence_score'  => 'required|integer|between:0,100',
            'tingkat_kerusakan' => 'required|numeric|between:0,100',
        ], [
            'required' => ':attribute wajib diisi.',
            'between'  => ':attribute harus bernilai antara :min sampai :max.',
            'integer'  => ':attribute harus berupa bilangan bulat.',
            'numeric'  => ':attribute harus berupa angka.',
            'in'       => ':attribute tidak valid.',
        ], [
            'lokasi'            => 'Lokasi lahan',
            'nama_tanaman'      => 'Nama tanaman',
            'jenis_hama'        => 'Jenis hama',
            'confidence_score'  => 'Confidence score',
            'tingkat_kerusakan' => 'Tingkat kerusakan daun',
        ]);

        [$status, $rekomendasi] = $this->tentukanStatus((int) $validated['confidence_score']);

        $deteksi = DeteksiHama::create([
            'lokasi'            => $validated['lokasi'],
            'nama_tanaman'      => $validated['nama_tanaman'],
            'jenis_hama'        => $validated['jenis_hama'],
            'confidence_score'  => (int) $validated['confidence_score'],
            'tingkat_kerusakan' => (float) $validated['tingkat_kerusakan'],
            'status_deteksi'    => $status,
        ]);

        return view('hasil', [
            'data'        => $deteksi,
            'status'      => $status,
            'rekomendasi' => $rekomendasi,
        ]);
    }

    public function riwayat()
    {
        $riwayat = DeteksiHama::orderByDesc('created_at')->orderByDesc('id')->get();

        $ringkasan = [
            'total'        => $riwayat->count(),
            'tidak_pasti'  => $riwayat->where('status_deteksi', 'Tidak Pasti')->count(),
            'indikasi'     => $riwayat->where('status_deteksi', 'Indikasi Hama')->count(),
            'terkonfirmasi'=> $riwayat->where('status_deteksi', 'Hama Terkonfirmasi')->count(),
        ];

        return view('riwayat', compact('riwayat', 'ringkasan'));
    }

    private function tentukanStatus(int $score): array
    {
        if ($score < 50) {
            return ['Tidak Pasti', 'Perlu verifikasi manual oleh petugas'];
        } elseif ($score <= 80) {
            return ['Indikasi Hama', 'Lakukan pemantauan intensif'];
        }

        return ['Hama Terkonfirmasi', 'Segera lakukan pengendalian hama'];
    }
}
