<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('persetujuan_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->cascadeOnDelete();
            $table->enum('tipe_wali', ['orang_tua', 'wali', 'mandiri'])->comment('Tipe persetujuan: orang tua, wali, atau mandiri (yatim/piatu/dewasa)');
            $table->string('nama_wali')->nullable()->comment('Nama orang tua/wali jika bukan mandiri');
            $table->string('hubungan_wali')->nullable()->comment('Ayah/Ibu/Paman/dll');
            $table->string('telepon_wali')->nullable();
            $table->string('email_wali')->nullable();
            $table->text('pernyataan_mandiri')->nullable()->comment('Alasan jika tidak punya wali');
            $table->boolean('setuju_syarat')->default(false);
            $table->boolean('setuju_independen')->default(false)->comment('Menyetujui status kampus independen');
            $table->boolean('setuju_swadaya')->default(false)->comment('Menyetujui mencari pekerjaan mandiri');
            $table->string('tanda_tangan_digital')->nullable()->comment('Hash digital signature');
            $table->timestamp('disetujui_pada')->nullable();
            $table->string('alamat_ip')->nullable();
            $table->timestamps();
        });
        
        // Tambah kolom status persetujuan di tabel pendaftaran
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->boolean('persetujuan_lengkap')->default(false)->after('status');
        });
    }
    public function down(): void {
        Schema::dropIfExists('persetujuan_pendaftaran');
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn('persetujuan_lengkap');
        });
    }
};
