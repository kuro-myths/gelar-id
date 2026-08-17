<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->cascadeOnDelete();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->foreignId('jenis_gelar_id')->constrained('jenis_gelar')->cascadeOnDelete();
            $table->string('nomor_sertifikat')->unique();
            $table->string('nama_tercetak');
            $table->date('tanggal_terbit');
            $table->string('jalur_berkas')->nullable();
            $table->string('kode_verifikasi')->unique();
            $table->boolean('valid')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
