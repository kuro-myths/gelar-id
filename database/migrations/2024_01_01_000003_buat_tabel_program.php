<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_gelar_id')->constrained('jenis_gelar')->cascadeOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('kurikulum')->nullable();
            $table->text('tujuan')->nullable();
            $table->decimal('harga', 12, 2)->default(0);
            $table->integer('maks_peserta')->default(0)->comment('0 = tidak terbatas');
            $table->string('gambar')->nullable();
            $table->boolean('aktif')->default(true);
            $table->boolean('unggulan')->default(false);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
