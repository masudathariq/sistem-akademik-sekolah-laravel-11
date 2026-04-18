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
        Schema::create('koreksi_hadir', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guru_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->tinyInteger('bulan');
            $table->smallInteger('tahun');

            // bisa + atau -
            $table->integer('jumlah');

            $table->string('keterangan')->nullable();

            $table->timestamps();

            // 1 guru cuma boleh punya 1 koreksi per bulan
            $table->unique(['guru_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koreksi_hadir');
    }
};
