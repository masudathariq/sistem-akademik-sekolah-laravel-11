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
        Schema::create('tabungan_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tabungan_siswa_id')->constrained('tabungan_siswa')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('jenis', ['setor', 'tarik']);
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungan_transaksi');
    }
};
