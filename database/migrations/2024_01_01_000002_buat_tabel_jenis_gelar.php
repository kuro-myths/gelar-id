<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_gelar', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique()->comment('Kode gelar: KVT.Kom, VT.Kom, VTA.Kom, V.Com, K1-K6');
            $table->string('nama');
            $table->string('kategori')->comment('sarjana/diploma/vokasi');
            $table->text('deskripsi')->nullable();
            $table->integer('durasi_bulan')->comment('Durasi studi dalam bulan');
            $table->integer('sks_dibutuhkan')->comment('Jumlah SKS yang dibutuhkan');
            $table->string('ikon')->nullable();
            $table->string('warna')->default('#3B82F6');
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_gelar');
    }
};
