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
        Schema::create('surat_aktif_siswas', function (Blueprint $table) {
    $table->id();

    $table->string('nomor_surat');
    $table->foreignId('siswa_id')
          ->constrained('siswas')
          ->cascadeOnDelete();

    $table->date('tanggal_surat');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_aktif_siswas');
    }
};
