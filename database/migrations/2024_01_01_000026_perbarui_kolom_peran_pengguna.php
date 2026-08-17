<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah ENUM peran agar support 'pengajar'
        DB::statement("ALTER TABLE `pengguna` MODIFY `peran` ENUM('admin', 'pengguna', 'pengajar') NOT NULL DEFAULT 'pengguna'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `pengguna` MODIFY `peran` ENUM('admin', 'pengguna') NOT NULL DEFAULT 'pengguna'");
    }
};
