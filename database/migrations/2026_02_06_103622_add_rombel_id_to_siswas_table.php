<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('rombel_id')
                ->nullable()
                ->after('id') // atau sesuaikan posisi kolom
                ->constrained('rombels')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['rombel_id']);
            $table->dropColumn('rombel_id');
        });
    }
};
