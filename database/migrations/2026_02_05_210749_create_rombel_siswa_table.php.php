<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ✅ TABEL PIVOT: Hubungan Siswa dengan Rombel
     * 
     * TABEL INI YANG MENYIMPAN:
     * - Siswa X ada di Rombel Y
     * - Siswa bisa punya banyak record di sini (tiap tahun ajaran beda rombel)
     * 
     * CONTOH DATA:
     * | id | siswa_id | rombel_id | created_at |
     * |----|----------|-----------|------------|
     * | 1  | 10       | 5         | 2024-07-01 | ← Budi di 7A (TA 2024/2025)
     * | 2  | 10       | 12        | 2025-07-01 | ← Budi di 8A (TA 2025/2026)
     * 
     * Lihat? Budi (siswa_id=10) punya 2 record, tidak kehilangan history!
     */
    public function up(): void
    {
        Schema::create('rombel_siswa', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel rombels
            $table->foreignId('rombel_id')
                ->constrained('rombels')
                ->cascadeOnDelete(); // Kalau rombel dihapus, pivot juga dihapus
            
            // Foreign key ke tabel siswas
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete(); // Kalau siswa dihapus, pivot juga dihapus
            
            $table->timestamps();
            
            // ✅ PENTING: Siswa tidak boleh dobel di rombel yang sama
            // Contoh: Budi tidak bisa 2x di 7A
            $table->unique(['rombel_id', 'siswa_id'], 'unique_siswa_per_rombel');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rombel_siswa');
    }
};