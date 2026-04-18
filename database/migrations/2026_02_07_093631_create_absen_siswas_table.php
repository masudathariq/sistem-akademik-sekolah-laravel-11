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
        Schema::create('absen_siswas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('rombel_id')->constrained('rombels')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->cascadeOnDelete();

            $table->date('tanggal');
            $table->enum('status', ['H', 'I', 'S', 'A', 'B']); // Hadir, Izin, Sakit, Alpha, Bolos
            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->unique(['siswa_id', 'tanggal']); // 1 siswa 1 absen per hari
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_siswas');
    }
};
