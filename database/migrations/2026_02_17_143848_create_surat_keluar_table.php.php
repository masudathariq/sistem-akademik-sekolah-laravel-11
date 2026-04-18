<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->date('tanggal_keluar');
            $table->string('tujuan');
            $table->string('perihal');
            $table->string('jenis')->nullable();
            $table->text('isi')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('penandatangan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status')->default('Draf'); // Draf, Terkirim, Arsip
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};