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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',20);
            $table->unsignedBigInteger('thn_ajaran_id');
            $table->unsignedBigInteger('akun_id');
            $table->string('kode');
            $table->string('nama');
            $table->date('batas_bayar');
            $table->string('remark',20);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('thn_ajaran_id')->references('id')->on('tahun_pelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('akun_id')->references('id')->on('akuns')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
