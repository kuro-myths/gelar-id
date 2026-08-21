<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pencapaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->string('ikon')->default('🏆'); // emoji atau nama ikon
            $table->string('warna')->default('#ffd60a');
            $table->enum('kategori', [
                'akademik',   // nilai, kelulusan, sertifikat
                'kehadiran',  // absensi, pertemuan
                'kuesioner',  // mengisi survei
                'game',       // Minecraft achievements, storytelling
                'sosial',     // referral, komunitas
                'khusus',     // manual oleh admin
            ])->default('akademik');
            $table->enum('tipe_syarat', [
                'otomatis',   // dicek sistem secara otomatis
                'manual',     // admin yang verifikasi
                'upload',     // user upload bukti (screenshot, sertifikat game)
            ])->default('otomatis');
            $table->json('syarat')->nullable()->comment('{"tipe":"xp_min","nilai":100} atau {"tipe":"selesai_program"} dll');
            $table->integer('poin')->default(0)->comment('Poin/XP yang diperoleh');
            $table->boolean('adalah_prasyarat_beasiswa')->default(false);
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('pencapaian_pengguna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->foreignId('pencapaian_id')->constrained('pencapaian')->cascadeOnDelete();
            $table->enum('status', ['menunggu', 'diverifikasi', 'ditolak'])->default('menunggu');
            $table->text('bukti')->nullable()->comment('URL screenshot, deskripsi, atau data JSON bukti');
            $table->text('catatan_pengguna')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->timestamp('diverifikasi_pada')->nullable();
            $table->timestamp('diraih_pada')->nullable();
            $table->timestamps();

            $table->unique(['pengguna_id', 'pencapaian_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pencapaian_pengguna');
        Schema::dropIfExists('pencapaian');
    }
};
