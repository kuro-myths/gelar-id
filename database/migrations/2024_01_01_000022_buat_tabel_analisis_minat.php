<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('analisis_minat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->string('sesi_id')->nullable()->comment('ID sesi untuk non-login');
            $table->json('jawaban_kuis')->comment('JSON array jawaban 10 pertanyaan');
            $table->json('hasil_skor')->comment('JSON skor per kategori');
            $table->foreignId('jenis_gelar_rekomendasi_id')->nullable()->constrained('jenis_gelar')->nullOnDelete();
            $table->foreignId('program_rekomendasi_id')->nullable()->constrained('program')->nullOnDelete();
            $table->text('alasan_rekomendasi')->nullable();
            $table->integer('skor_tertinggi')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('analisis_minat'); }
};
