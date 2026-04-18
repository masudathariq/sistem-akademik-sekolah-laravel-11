<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('absensi_guru', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('status');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->string('lokasi')->nullable()->after('longitude');
            $table->string('foto')->nullable()->after('lokasi');
        });
    }

    public function down(): void
    {
        Schema::table('absensi_guru', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'lokasi', 'foto']);
        });
    }
};
