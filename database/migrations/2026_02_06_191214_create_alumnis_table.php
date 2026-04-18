<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nis')->nullable();
            $table->string('nama_siswa');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->text('alamat')->nullable();
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->string('wali')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('rombel_terakhir')->nullable(); // bisa langsung ditambahkan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
