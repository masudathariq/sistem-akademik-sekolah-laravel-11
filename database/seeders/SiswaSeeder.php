<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tatausaha\Siswa;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Misal kita bikin 10 siswa untuk tes
        for ($i = 1; $i <= 20; $i++) {
            Siswa::create([
                'nisn' => '00000' . $i,
                'nis' => '1000' . $i,
                'nama_siswa' => "Siswa Test $i",
                'tempat_lahir' => "Kota Test",
                'tanggal_lahir' => now()->subYears(12)->addDays($i), // tanggal lahir beda-beda
                'jenis_kelamin' => $i % 2 == 0 ? 'L' : 'P',
                'alamat' => "Alamat Test $i",
                'ayah' => "Ayah Test $i",
                'ibu' => "Ibu Test $i",
                'wali' => null,
            ]);
        }
    }
}
