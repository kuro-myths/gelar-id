<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diskon', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique()->comment('Kode voucher diskon');
            $table->string('nama')->comment('Nama promosi');
            $table->text('deskripsi')->nullable();
            $table->enum('tipe', ['persen', 'nominal', 'gratis'])->default('persen');
            $table->decimal('nilai', 10, 2)->default(0)->comment('Nilai diskon: % atau nominal Rp');
            $table->integer('maks_penggunaan')->default(0)->comment('0 = tidak terbatas');
            $table->integer('total_digunakan')->default(0);
            $table->decimal('min_pembelian', 12, 2)->default(0)->comment('Minimal harga transaksi');
            $table->datetime('berlaku_mulai')->nullable();
            $table->datetime('berlaku_hingga')->nullable();
            $table->boolean('aktif')->default(true);
            $table->json('program_ids')->nullable()->comment('null = berlaku semua program');
            $table->timestamps();
        });

        // Tambah kolom ke tabel program
        Schema::table('program', function (Blueprint $table) {
            $table->decimal('harga_coret', 12, 2)->nullable()->after('harga')->comment('Harga asli sebelum diskon');
            $table->boolean('jalur_gratis')->default(false)->after('harga_coret')->comment('Program dapat diakses gratis dengan syarat');
            $table->text('syarat_gratis')->nullable()->after('jalur_gratis')->comment('Syarat untuk jalur gratis');
            $table->string('label_badge')->nullable()->after('syarat_gratis')->comment('Label badge misal: POPULER, BARU, TERBATAS');
            $table->string('warna_badge')->nullable()->after('label_badge');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diskon');
        Schema::table('program', function (Blueprint $table) {
            $table->dropColumn(['harga_coret','jalur_gratis','syarat_gratis','label_badge','warna_badge']);
        });
    }
};
