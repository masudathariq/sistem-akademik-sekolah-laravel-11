<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_guru', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hari_id')
                ->constrained('hari')
                ->onDelete('cascade');

            $table->foreignId('guru_id')
                ->constrained('gurus')
                ->onDelete('cascade');

            $table->timestamps();

            // cegah guru yang sama masuk hari yang sama 2x
            $table->unique(['hari_id', 'guru_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_guru');
    }
};
