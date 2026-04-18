<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AbsensiGuru;
use App\Models\Guru;
use Carbon\Carbon;

class AbsensiGuruSeeder extends Seeder
{
    public function run()
    {
        $guruList = Guru::all();

        $jumlahBulan = rand(1, 3); // 1-3 bulan terakhir

        for ($b = 0; $b < $jumlahBulan; $b++) {
            $bulan = Carbon::now()->subMonths($b)->month;
            $tahun = Carbon::now()->subMonths($b)->year;

            $jumlahHari = rand(20, 30); // maksimal 30 hari per bulan

            foreach ($guruList as $guru) {
                $hariAbsen = collect(range(1, Carbon::create($tahun, $bulan, 1)->daysInMonth))
                    ->shuffle()
                    ->take($jumlahHari);

                foreach ($hariAbsen as $hari) {
                    AbsensiGuru::factory()->create([
                        'guru_id' => $guru->id,
                        'tanggal' => Carbon::create($tahun, $bulan, $hari)->format('Y-m-d'),
                        'status'  => ['hadir','izin','sakit'][array_rand(['hadir','izin','sakit'])],
                    ]);
                }
            }
        }
    }
}
