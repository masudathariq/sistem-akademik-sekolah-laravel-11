<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tahun_ajaran_id')
                  ->constrained('tahun_ajarans')
                  ->cascadeOnDelete();

            $table->string('tingkat');
            $table->string('kode_rombel', 5);       // A, B, C
            $table->string('nama_rombel');       // al alim bahriyah

            $table->foreignId('wali_kelas_id')
                  ->nullable()
                  ->constrained('gurus')
                  ->nullOnDelete();

            $table->timestamps();

            // mencegah rombel dobel di tahun ajaran yang sama
            $table->unique(
                ['tahun_ajaran_id', 'tingkat', 'kode_rombel'],
                'unique_rombel_per_tahun'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};
