<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kemajuan_akademik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->cascadeOnDelete();
            $table->foreignId('sesi_belajar_id')->constrained('sesi_belajar')->cascadeOnDelete();
            $table->boolean('selesai')->default(false);
            $table->datetime('diselesaikan_pada')->nullable();
            $table->integer('nilai')->nullable()->comment('Nilai 0-100 jika ada evaluasi');
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->unique(['pendaftaran_id', 'sesi_belajar_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kemajuan_akademik');
    }
};
