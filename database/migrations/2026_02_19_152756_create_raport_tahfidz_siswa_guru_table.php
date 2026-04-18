<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raport_tahfidz_siswa_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('users')->cascadeOnDelete(); // asumsi guru di tabel users
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['guru_id','siswa_id']); // supaya siswa tidak double untuk guru yang sama
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raport_tahfidz_siswa_guru');
    }
};
