<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raport_tahfidz_hafalan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->string('hafalan_terakhir');
            $table->string('hafalan_lanjutan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raport_tahfidz_hafalan');
    }
};
