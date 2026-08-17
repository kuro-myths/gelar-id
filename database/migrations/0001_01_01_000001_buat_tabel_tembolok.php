<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tembolok', function (Blueprint $table) {
            $table->string('kunci')->primary();
            $table->mediumText('nilai');
            $table->integer('kedaluwarsa');
        });

        Schema::create('kunci_tembolok', function (Blueprint $table) {
            $table->string('kunci')->primary();
            $table->string('pemilik');
            $table->integer('kedaluwarsa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tembolok');
        Schema::dropIfExists('kunci_tembolok');
    }
};
