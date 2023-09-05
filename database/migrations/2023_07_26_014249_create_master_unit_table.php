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
        Schema::create('master_unit', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('unit');
            $table->string('nama_unit');
            $table->string('alamat_unit');
            $table->string('no_tlp');
            $table->string('logo');
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
        Schema::dropIfExists('master_unit');
    }
};
