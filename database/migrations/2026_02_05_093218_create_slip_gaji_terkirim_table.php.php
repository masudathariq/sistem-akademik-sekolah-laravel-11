<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slip_gaji_terkirim', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('bulan'); // 1-12
            $table->smallInteger('tahun'); // 2024, 2025, dst
            
            // Data slip (snapshot saat dikirim)
            $table->decimal('gaji_pokok', 12, 2)->default(0);
            $table->integer('hadir_asli')->default(0);
            $table->integer('koreksi')->default(0);
            $table->integer('hadir_final')->default(0);
            $table->decimal('transport', 12, 2)->default(0);
            $table->decimal('total_penambahan', 12, 2)->default(0);
            $table->decimal('total_pengurangan', 12, 2)->default(0);
            $table->decimal('total_gaji', 12, 2)->default(0);
            
            // Detail penambahan & pengurangan (JSON)
            $table->json('detail_penambahan')->nullable();
            $table->json('detail_pengurangan')->nullable();
            
            // Status
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamp('dibaca_pada')->nullable();
            
            $table->timestamps();
            
            // 1 guru hanya bisa punya 1 slip per bulan
            $table->unique(['guru_id', 'bulan', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slip_gaji_terkirim');
    }
};
