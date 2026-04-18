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
        Schema::create('tahfidz_guru', function (Blueprint $table) {
    $table->id();
    $table->foreignId('guru_id')->constrained()->cascadeOnDelete();
    $table->integer('bulan');
    $table->integer('tahun');
    $table->integer('jumlah_hadir')->default(0);
    $table->integer('total')->default(0);
    $table->timestamps();

    $table->unique(['guru_id', 'bulan', 'tahun']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahfidz_guru');
    }
};
