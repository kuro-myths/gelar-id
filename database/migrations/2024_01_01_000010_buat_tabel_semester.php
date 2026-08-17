<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semester', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('program')->cascadeOnDelete();
            $table->integer('nomor')->comment('Semester ke-1, ke-2, dst');
            $table->string('nama')->comment('Semester 1, Ganjil 2024, dst');
            $table->text('deskripsi')->nullable();
            $table->json('mata_kuliah')->nullable()->comment('Daftar mata kuliah JSON');
            $table->integer('jumlah_sks')->default(0);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semester');
    }
};
