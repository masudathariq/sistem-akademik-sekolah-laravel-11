<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raport_iqro_aspeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aspek');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raport_iqro_aspeks');
    }
};
