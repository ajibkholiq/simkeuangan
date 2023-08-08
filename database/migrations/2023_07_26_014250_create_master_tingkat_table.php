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
        Schema::create('master_tingkat', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',20);
            $table->string('id_tingkat',20);
            $table->string('nama_tingkat',20);
            $table->string('remark',20);
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
        Schema::dropIfExists('master_tingkat_');
    }
};
