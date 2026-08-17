<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuesioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->nullable()->constrained('program')->nullOnDelete();
            $table->foreignId('sesi_belajar_id')->nullable()->constrained('sesi_belajar')->nullOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('tipe', ['pra_kelas', 'pasca_kelas', 'kepuasan', 'ujian', 'umum'])->default('umum');
            $table->datetime('dibuka_pada')->nullable();
            $table->datetime('ditutup_pada')->nullable();
            $table->integer('batas_waktu_menit')->default(0)->comment('0 = tidak terbatas');
            $table->boolean('wajib')->default(false);
            $table->boolean('acak_soal')->default(false);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuesioner_id')->constrained('kuesioner')->cascadeOnDelete();
            $table->integer('urutan')->default(0);
            $table->text('teks_pertanyaan');
            $table->enum('tipe', ['pilihan_ganda', 'esai', 'benar_salah', 'skala', 'centang'])->default('pilihan_ganda');
            $table->json('opsi')->nullable()->comment('Opsi jawaban untuk pilihan ganda/centang');
            $table->boolean('wajib')->default(true);
            $table->integer('bobot')->default(1)->comment('Bobot nilai pertanyaan');
            $table->timestamps();
        });

        Schema::create('respons_kuesioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuesioner_id')->constrained('kuesioner')->cascadeOnDelete();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->decimal('nilai_total', 5, 2)->nullable();
            $table->datetime('mulai_pada')->nullable();
            $table->datetime('selesai_pada')->nullable();
            $table->boolean('selesai')->default(false);
            $table->timestamps();
            $table->unique(['kuesioner_id', 'pengguna_id']);
        });

        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('respons_id')->constrained('respons_kuesioner')->cascadeOnDelete();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->cascadeOnDelete();
            $table->text('jawaban')->nullable();
            $table->decimal('nilai', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban');
        Schema::dropIfExists('respons_kuesioner');
        Schema::dropIfExists('pertanyaan');
        Schema::dropIfExists('kuesioner');
    }
};
