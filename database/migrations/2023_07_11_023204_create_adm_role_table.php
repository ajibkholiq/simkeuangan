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
        Schema::create('adm_role', function (Blueprint $table) {
            $table->id();
            $table->char('uuid',100);
            $table->string("nama_role",);
            $table->string("remark",20);
            $table->string("create_by",20)->nullable();
            $table->string("update_by",20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_role');
    }
};
