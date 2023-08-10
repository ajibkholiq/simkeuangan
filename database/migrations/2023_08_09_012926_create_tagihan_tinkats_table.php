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
        Schema::create('tagihan_tinkats', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',20);
            $table->unsignedBigInteger('thn_ajaran_id');
            $table->unsignedBigInteger('tagihan_id');
            $table->unsignedBigInteger('tingkat_id');
            $table->bigInteger('nominal')->default(0);
            $table->string('remark',20);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('thn_ajaran_id')->references('id')->on('tahun_pelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tingkat_id')->references('id')->on('master_tingkat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tagihan_id')->references('id')->on('tagihans')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_tinkats');
    }
};
