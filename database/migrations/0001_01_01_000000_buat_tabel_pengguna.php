<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('nama_pengguna')->unique()->nullable();
            $table->string('nim')->unique()->nullable()->comment('Nomor Induk Mahasiswa Virtual');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('peran', ['admin', 'pengguna'])->default('pengguna');
            $table->string('avatar')->nullable();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('institusi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('token_reset_password', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('dibuat_pada')->nullable();
        });

        Schema::create('sesi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('alamat_ip', 45)->nullable();
            $table->text('agen_pengguna')->nullable();
            $table->longText('muatan');
            $table->integer('aktivitas_terakhir')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('token_reset_password');
        Schema::dropIfExists('sesi');
    }
};
