<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeteksiHama extends Model
{
    protected $table = 'deteksi_hama';

    protected $fillable = [
        'lokasi',
        'nama_tanaman',
        'jenis_hama',
        'confidence_score',
        'tingkat_kerusakan',
        'status_deteksi',
    ];

    protected $casts = [
        'confidence_score'  => 'integer',
        'tingkat_kerusakan' => 'float',
    ];

    public function getRekomendasiAttribute(): string
    {
        return match ($this->status_deteksi) {
            'Hama Terkonfirmasi' => 'Segera lakukan pengendalian hama',
            'Indikasi Hama'      => 'Lakukan pemantauan intensif',
            default              => 'Perlu verifikasi manual oleh petugas',
        };
    }
}
