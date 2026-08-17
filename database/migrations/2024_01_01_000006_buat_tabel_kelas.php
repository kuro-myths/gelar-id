<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->enum('tingkat', ['sd', 'smp', 'sma', 'umum'])->default('umum');
            $table->string('kategori')->nullable();
            $table->string('ikon')->nullable();
            $table->string('warna')->nullable();
            $table->string('label_badge')->nullable();
            $table->decimal('harga', 12, 2)->default(0);
            $table->boolean('jalur_gratis')->default(false);
            $table->unsignedInteger('durasi_jam')->default(0);
            $table->unsignedInteger('jumlah_sesi')->default(0);
            $table->boolean('aktif')->default(true);
            $table->boolean('unggulan')->default(false);
            $table->json('kurikulum')->nullable();
            $table->json('yang_dipelajari')->nullable();
            $table->foreignId('pengajar_id')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
