<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesi_belajar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained('semester')->cascadeOnDelete();
            $table->integer('pertemuan_ke')->comment('Pertemuan ke-1, ke-2, dst');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->text('materi')->nullable()->comment('Konten materi sesi');
            $table->datetime('mulai_pada');
            $table->datetime('selesai_pada');
            $table->integer('durasi_menit')->default(60);
            $table->enum('tipe', ['online', 'rekaman', 'mandiri'])->default('online');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesi_belajar');
    }
};
