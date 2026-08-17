<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('semester', function (Blueprint $table) {
            $table->boolean('terkunci')->default(true)->after('aktif')->comment('Semester terkunci hingga semester sebelumnya selesai');
            $table->integer('min_kemajuan_buka')->default(80)->after('terkunci')->comment('% kemajuan semester sebelumnya untuk membuka');
            $table->json('alat_yang_digunakan')->nullable()->after('min_kemajuan_buka')->comment('Tools: VS Code, Figma, CapCut, dll');
            $table->json('prasyarat_semester_id')->nullable()->after('alat_yang_digunakan')->comment('ID semester yang harus diselesaikan dulu');
        });
        
        Schema::table('sesi_belajar', function (Blueprint $table) {
            $table->json('alat_dipakai')->nullable()->after('materi')->comment('Tools spesifik di sesi ini');
            $table->string('tautan_unduh_alat')->nullable()->after('alat_dipakai')->comment('Link download tools');
            $table->integer('xp_reward')->default(10)->after('tautan_unduh_alat')->comment('XP points untuk gamifikasi');
        });
        
        // Tambah XP ke kemajuan akademik
        Schema::table('kemajuan_akademik', function (Blueprint $table) {
            $table->integer('xp_diperoleh')->default(0)->after('nilai');
        });
        
        // Tambah total XP ke pendaftaran
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->integer('total_xp')->default(0)->after('kemajuan');
        });
    }
    
    public function down(): void {
        Schema::table('semester', function (Blueprint $table) {
            $table->dropColumn(['terkunci','min_kemajuan_buka','alat_yang_digunakan','prasyarat_semester_id']);
        });
        Schema::table('sesi_belajar', function (Blueprint $table) {
            $table->dropColumn(['alat_dipakai','tautan_unduh_alat','xp_reward']);
        });
        Schema::table('kemajuan_akademik', function (Blueprint $table) {
            $table->dropColumn('xp_diperoleh');
        });
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn('total_xp');
        });
    }
};
