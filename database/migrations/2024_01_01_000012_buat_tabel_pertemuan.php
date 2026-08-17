<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertemuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_belajar_id')->nullable()->constrained('sesi_belajar')->nullOnDelete();
            $table->foreignId('program_id')->constrained('program')->cascadeOnDelete();
            $table->foreignId('dibuat_oleh')->constrained('pengguna')->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('id_ruangan')->unique()->comment('ID ruangan meeting unik');
            $table->string('kata_sandi')->nullable()->comment('Password join meeting');
            $table->string('tautan_gabung')->nullable()->comment('Link join langsung');
            $table->enum('platform', ['zoom', 'meet', 'teams', 'internal'])->default('internal');
            $table->datetime('dijadwalkan_pada');
            $table->integer('durasi_menit')->default(90);
            $table->integer('maks_peserta')->default(100);
            $table->enum('status', ['terjadwal', 'berlangsung', 'selesai', 'batal'])->default('terjadwal');
            $table->text('catatan')->nullable();
            $table->boolean('rekam_otomatis')->default(false);
            $table->string('tautan_rekaman')->nullable();
            $table->timestamps();
        });

        Schema::create('peserta_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained('pertemuan')->cascadeOnDelete();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->datetime('bergabung_pada')->nullable();
            $table->datetime('keluar_pada')->nullable();
            $table->boolean('hadir')->default(false);
            $table->integer('durasi_hadir_menit')->default(0);
            $table->timestamps();
            $table->unique(['pertemuan_id', 'pengguna_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta_pertemuan');
        Schema::dropIfExists('pertemuan');
    }
};
