<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_rombel_kategori_table.php
    public function up()
    {
        Schema::create('rombel_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rombel_id')->constrained('rombels')->cascadeOnDelete();
            $table->enum('kategori', ['reguler', 'pondok']);
            $table->timestamps();

            $table->unique('rombel_id'); // 1 rombel = 1 kategori
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
