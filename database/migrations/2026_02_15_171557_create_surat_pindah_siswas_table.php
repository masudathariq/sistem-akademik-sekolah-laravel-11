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
        Schema::create('surat_pindah_siswas', function (Blueprint $table) {

    $table->id();

    $table->string('nomor_surat');
    $table->date('tanggal_surat');

    // data siswa (manual)
    $table->string('nama_siswa');
    $table->string('tempat_lahir')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('nis')->nullable();
    $table->string('nisn')->nullable();
    $table->string('kelas')->nullable();
    $table->string('jenis_kelamin')->nullable();
    $table->text('alamat_siswa')->nullable();

    // data wali
    $table->string('nama_wali')->nullable();
    $table->string('pekerjaan_wali')->nullable();
    $table->text('alamat_wali')->nullable();

    // tujuan
    $table->string('sekolah_tujuan')->nullable();
    $table->string('alasan_pindah')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pindah_siswas');
    }
};
