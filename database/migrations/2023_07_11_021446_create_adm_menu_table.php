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
        Schema::create('adm_menu', function (Blueprint $table) {
            $table->id();
            $table->char('uuid',100);
            $table->string("induk",20);
            $table->string("kode_menu",20);
            $table->string("nama_menu",20);
            $table->string("icon",100);
            $table->string("urut",20);
            $table->string("route",30);
            $table->string("remark",100);
            $table->string("create_by",20);
            $table->string("update_by",20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_menu');
    }
};
