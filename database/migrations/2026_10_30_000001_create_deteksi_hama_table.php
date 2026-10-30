<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deteksi_hama', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('nama_tanaman');
            $table->string('jenis_hama');
            $table->integer('confidence_score');
            $table->float('tingkat_kerusakan');
            $table->string('status_deteksi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deteksi_hama');
    }
};
