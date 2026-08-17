<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->string('antrean')->index();
            $table->longText('muatan');
            $table->unsignedTinyInteger('percobaan');
            $table->unsignedInteger('dicadangkan_pada')->nullable();
            $table->unsignedInteger('tersedia_pada');
            $table->unsignedInteger('dibuat_pada');
        });

        Schema::create('kelompok_antrian', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama');
            $table->integer('total_pekerjaan');
            $table->integer('pekerjaan_tertunda');
            $table->integer('pekerjaan_gagal');
            $table->longText('id_pekerjaan_gagal');
            $table->mediumText('opsi')->nullable();
            $table->integer('dibatalkan_pada')->nullable();
            $table->integer('dibuat_pada');
            $table->integer('selesai_pada')->nullable();
        });

        Schema::create('antrian_gagal', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('koneksi');
            $table->text('antrean');
            $table->longText('muatan');
            $table->longText('pengecualian');
            $table->timestamp('gagal_pada')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrian');
        Schema::dropIfExists('kelompok_antrian');
        Schema::dropIfExists('antrian_gagal');
    }
};
