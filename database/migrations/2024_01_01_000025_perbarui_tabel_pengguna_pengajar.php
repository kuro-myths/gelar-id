<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->string('keahlian')->nullable()->after('institusi');
            $table->text('bio')->nullable()->after('keahlian');
            $table->string('linkedin')->nullable()->after('bio');
            $table->string('github')->nullable()->after('linkedin');
            $table->boolean('tampilkan_profil')->default(false)->after('github');
            $table->integer('rating')->default(0)->after('tampilkan_profil');
            $table->integer('total_pelajar')->default(0)->after('rating');
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->enum('tingkat', ['sd', 'smp', 'sma', 'umum'])->default('umum');
            $table->string('kategori')->nullable();
            $table->string('ikon')->nullable();
            $table->string('warna')->default('#4361ee');
            $table->string('label_badge')->nullable();
            $table->decimal('harga', 12, 2)->default(0);
            $table->boolean('jalur_gratis')->default(false);
            $table->integer('durasi_jam')->default(0);
            $table->integer('jumlah_sesi')->default(0);
            $table->boolean('aktif')->default(true);
            $table->boolean('unggulan')->default(false);
            $table->json('kurikulum')->nullable();
            $table->json('yang_dipelajari')->nullable();
            $table->foreignId('pengajar_id')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('peserta_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->enum('status', ['aktif', 'selesai', 'batal'])->default('aktif');
            $table->integer('kemajuan')->default(0);
            $table->timestamp('bergabung_pada')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();
            $table->unique(['kelas_id', 'pengguna_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta_kelas');
        Schema::dropIfExists('kelas');
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn(['keahlian','bio','linkedin','github','tampilkan_profil','rating','total_pelajar']);
        });
    }
};
