<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_gelar', function (Blueprint $table) {
            $table->integer('jumlah_semester')->default(0)->after('sks_dibutuhkan')->comment('Total semester yang ditempuh');
            $table->json('keunggulan')->nullable()->after('jumlah_semester')->comment('Poin keunggulan gelar JSON array');
            $table->json('mata_kuliah_inti')->nullable()->after('keunggulan')->comment('Mata kuliah inti JSON array');
            $table->string('gelar_singkat')->nullable()->after('kode')->comment('Singkatan gelar misal: S.Kom, A.Md.Kom');
            $table->text('syarat')->nullable()->after('deskripsi')->comment('Syarat pendaftaran');
            $table->text('prospek_karir')->nullable()->after('syarat')->comment('Prospek karir lulusan');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_gelar', function (Blueprint $table) {
            $table->dropColumn(['jumlah_semester','keunggulan','mata_kuliah_inti','gelar_singkat','syarat','prospek_karir']);
        });
    }
};
