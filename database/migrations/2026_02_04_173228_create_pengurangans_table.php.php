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
        Schema::create('pengurangans', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // nama potongan
            $table->decimal('jumlah', 12, 2)->default(0); // nominal
            $table->enum('tipe', ['semua', 'pilihan'])->default('pilihan'); // berlaku semua guru atau beberapa
            $table->json('guru_id')->nullable(); // simpan array guru jika tipe = 'pilihan'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegurangans');
    }
};
