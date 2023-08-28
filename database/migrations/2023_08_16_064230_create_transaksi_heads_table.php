<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_heads', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',20);
            $table->string('kode_trans');
            $table->date('tanggal');
            $table->string('kode_akun');
            $table->integer('siswa_id');
            $table->string('nama');
            $table->string('masuk');
            $table->string('keluar');
            $table->integer('total_nominal');
            $table->string('remark');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_siswas');
    }
};
