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
        Schema::create('master_akun_head_sub', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',20);
            $table->unsignedBigInteger('akun_head_id');
            $table->string('akun_head_sub');
            $table->string('urut');
            $table->string('remark',20);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('akun_head_id')->references('id')->on('akun_head')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_akun_head_sub');
    }
};
