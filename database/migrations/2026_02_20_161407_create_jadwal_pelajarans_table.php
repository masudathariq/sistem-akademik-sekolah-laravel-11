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
    Schema::create('jadwal_pelajarans', function (Blueprint $table) {
        $table->id();

        $table->foreignId('guru_id')->constrained()->onDelete('cascade');
        $table->foreignId('rombel_id')->constrained()->onDelete('cascade');
        $table->foreignId('mata_pelajaran_id')->constrained()->onDelete('cascade');

        $table->string('hari'); // senin, selasa, dst
        $table->time('jam_mulai');
        $table->time('jam_selesai');

        $table->string('tahun_ajaran')->nullable();
        $table->string('semester')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
    }
};
