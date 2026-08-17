<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->enum('status', ['aktif', 'selesai', 'berhenti'])->default('aktif');
            $table->unsignedTinyInteger('kemajuan')->default(0);
            $table->timestamp('bergabung_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();

            $table->unique(['kelas_id', 'pengguna_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta_kelas');
    }
};
