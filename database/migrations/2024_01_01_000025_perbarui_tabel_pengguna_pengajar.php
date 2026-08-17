<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan kolom pengajar ke tabel pengguna (jika belum ada)
        Schema::table('pengguna', function (Blueprint $table) {
            if (!Schema::hasColumn('pengguna', 'keahlian')) {
                $table->string('keahlian')->nullable()->after('institusi');
            }
            if (!Schema::hasColumn('pengguna', 'bio')) {
                $table->text('bio')->nullable()->after('keahlian');
            }
            if (!Schema::hasColumn('pengguna', 'linkedin')) {
                $table->string('linkedin')->nullable()->after('bio');
            }
            if (!Schema::hasColumn('pengguna', 'github')) {
                $table->string('github')->nullable()->after('linkedin');
            }
            if (!Schema::hasColumn('pengguna', 'tampilkan_profil')) {
                $table->boolean('tampilkan_profil')->default(false)->after('github');
            }
            if (!Schema::hasColumn('pengguna', 'rating')) {
                $table->integer('rating')->default(0)->after('tampilkan_profil');
            }
            if (!Schema::hasColumn('pengguna', 'total_pelajar')) {
                $table->integer('total_pelajar')->default(0)->after('rating');
            }
        });

        // Tabel kelas dan peserta_kelas sudah dibuat di migrasi 000006 dan 000007
        // Tambahkan kolom warna ke kelas jika belum ada (migrasi lama tidak punya default warna)
        if (Schema::hasTable('kelas') && !Schema::hasColumn('kelas', 'warna')) {
            Schema::table('kelas', function (Blueprint $table) {
                $table->string('warna')->default('#4361ee')->after('ikon');
            });
        }
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
