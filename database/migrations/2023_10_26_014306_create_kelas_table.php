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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',20);
            $table->string('kode_kelas',20);
            $table->string('kelas',20);
            $table->unsignedBigInteger("tingkat_id");
            $table->unsignedBigInteger("unit_id");
            $table->unsignedBigInteger("user_id");
            $table->string('remark',20);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('master_unit')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tingkat_id')->references('id')->on('master_tingkat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
