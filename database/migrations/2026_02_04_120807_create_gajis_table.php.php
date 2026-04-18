<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('gurus')->onDelete('cascade');
            $table->decimal('jumlah_jam', 8, 2)->default(0); // jumlah jam mengajar
            $table->decimal('tarif_per_jam', 12, 2)->default(0); // tarif per jam
            $table->decimal('gaji_pokok', 12, 2)->default(0); // jumlah_jam * tarif_per_jam
            $table->timestamps();

            $table->unique(['guru_id']); // untuk mencegah double entry
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};


