<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->string('ttd_nama')->nullable()->after('jalur_berkas')->comment('Nama penandatangan');
            $table->string('ttd_jabatan')->nullable()->after('ttd_nama')->comment('Jabatan penandatangan');
            $table->decimal('ipk', 3, 2)->nullable()->after('ttd_jabatan')->comment('IPK/nilai akhir');
            $table->string('predikat')->nullable()->after('ipk')->comment('Dengan pujian, Memuaskan, dst');
        });
    }

    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropColumn(['ttd_nama','ttd_jabatan','ipk','predikat']);
        });
    }
};
