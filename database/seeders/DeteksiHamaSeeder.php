<?php

namespace Database\Seeders;

use App\Models\DeteksiHama;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class DeteksiHamaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create('id_ID');
        $lokasi  = ['Garut Kota', 'Tarogong Kaler', 'Samarang'];
        $tanaman = ['Padi', 'Jagung', 'Cabai'];
        $hama    = ['Wereng Cokelat', 'Ulat Grayak', 'Kutu Daun'];
        $jumlah = 18; // m
        for ($i = 0; $i < $jumlah; $i++) {
            $score = match ($i) {
                0       => $faker->numberBetween(30, 49),
                1       => $faker->numberBetween(50, 80),
                2       => $faker->numberBetween(81, 99),
                default => $faker->numberBetween(30, 99),
            };
            if ($score < 50) {
                $status = 'Tidak Pasti';
            } elseif ($score <= 80) {
                $status = 'Indikasi Hama';
            } else {
                $status = 'Hama Terkonfirmasi';
            }
            $waktu = $faker->dateTimeBetween('-30 days', 'now');
            $data = new DeteksiHama([
                'lokasi'            => $faker->randomElement($lokasi),
                'nama_tanaman'      => $faker->randomElement($tanaman),
                'jenis_hama'        => $faker->randomElement($hama),
                'confidence_score'  => $score,
                'tingkat_kerusakan' => $faker->randomFloat(1, 0, 80),
                'status_deteksi'    => $status,
            ]);
            $data->created_at = $waktu;
            $data->updated_at = $waktu;
            $data->save();
        }
    }
}
