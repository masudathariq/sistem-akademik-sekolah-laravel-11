<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // pastikan data aman (string → integer)
        DB::statement("
            UPDATE rombels
            SET tingkat = CASE
                WHEN tingkat = 'VII' THEN 7
                WHEN tingkat = 'VIII' THEN 8
                WHEN tingkat = 'IX' THEN 9
                ELSE tingkat
            END
        ");

        Schema::table('rombels', function (Blueprint $table) {
            $table->unsignedTinyInteger('tingkat')->change();
        });
    }

    public function down(): void
    {
        Schema::table('rombels', function (Blueprint $table) {
            $table->string('tingkat')->change();
        });
    }
};

