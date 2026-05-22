<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raport_iqro_bacaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->string('iqro_terakhir');
            $table->string('halaman_terakhir');
            $table->string('iqro_lanjut');
            $table->string('halaman_lanjut');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raport_iqro_bacaan');
    }
};
