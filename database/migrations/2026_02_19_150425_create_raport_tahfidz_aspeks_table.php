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
        // database/migrations/xxxx_create_raport_tahfidz_aspeks_table.php
        Schema::create('raport_tahfidz_aspeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aspek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport_tahfidz_aspeks');
    }
};
