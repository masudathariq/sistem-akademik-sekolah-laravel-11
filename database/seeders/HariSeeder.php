<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariSeeder extends Seeder
{
    public function run(): void
    {
        $hari = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        ];

        foreach ($hari as $nama) {
            DB::table('hari')->insert([
                'nama_hari' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
