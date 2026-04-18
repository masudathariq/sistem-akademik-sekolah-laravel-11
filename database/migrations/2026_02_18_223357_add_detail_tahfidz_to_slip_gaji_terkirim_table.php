<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('slip_gaji_terkirim', function (Blueprint $table) {
        $table->integer('hadir_tahfidz')->default(0)->after('transport');
        $table->decimal('tarif_tahfidz', 15, 2)->default(0)->after('hadir_tahfidz');
    });
}

public function down(): void
{
    Schema::table('slip_gaji_terkirim', function (Blueprint $table) {
        $table->dropColumn(['hadir_tahfidz', 'tarif_tahfidz']);
    });
}

};
