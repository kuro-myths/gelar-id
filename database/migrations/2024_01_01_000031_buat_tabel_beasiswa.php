<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->text('syarat')->nullable()->comment('Syarat umum dalam teks');
            $table->json('pencapaian_wajib')->nullable()->comment('Array ID pencapaian yang harus diraih');
            $table->enum('tipe_manfaat', ['penuh', 'sebagian', 'subsidi'])->default('penuh');
            $table->decimal('nilai_manfaat', 12, 2)->default(0)->comment('0 = gratis penuh, >0 = subsidi sejumlah ini');
            $table->integer('kuota')->default(0)->comment('0 = tidak terbatas');
            $table->integer('total_diterima')->default(0);
            $table->date('buka_pada')->nullable();
            $table->date('tutup_pada')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('pendaftar_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->foreignId('beasiswa_id')->constrained('beasiswa')->cascadeOnDelete();
            $table->foreignId('program_id')->nullable()->constrained('program')->nullOnDelete()
                  ->comment('Program studi yang ingin diambil dengan beasiswa ini');
            $table->string('nomor_pendaftaran_beasiswa')->unique();
            $table->enum('status', ['menunggu', 'diproses', 'diterima', 'ditolak'])->default('menunggu');
            $table->json('dokumen')->nullable()->comment('{"motivasi":"...","prestasi":"...","screenshot_game":"url"}');
            $table->text('surat_motivasi')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->timestamp('diverifikasi_pada')->nullable();
            $table->boolean('email_terkirim')->default(false);
            $table->timestamps();

            $table->unique(['pengguna_id', 'beasiswa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_beasiswa');
        Schema::dropIfExists('beasiswa');
    }
};
