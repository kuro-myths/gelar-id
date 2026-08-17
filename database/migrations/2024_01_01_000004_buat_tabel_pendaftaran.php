<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('program')->cascadeOnDelete();
            $table->string('nomor_pendaftaran')->unique();
            $table->enum('status', ['menunggu', 'aktif', 'selesai', 'batal'])->default('menunggu');
            $table->decimal('jumlah_bayar', 12, 2)->default(0);
            $table->timestamp('terdaftar_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->integer('kemajuan')->default(0)->comment('Kemajuan 0-100%');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
