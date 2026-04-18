<?php

namespace App\Services;

use App\Models\JadwalGuru;
use App\Models\JadwalHarian;
use App\Models\JadwalHarianGuru;

class AbsensiService
{
    public static function bolehAbsen($guru, $tanggal, $hari)
    {
        $jadwalHarian = JadwalHarian::where('tanggal', $tanggal)->first();

        if ($jadwalHarian) {
            if ($jadwalHarian->mode === 'SEMUA') return true;
            if ($jadwalHarian->mode === 'TERBATAS') {
                return JadwalHarianGuru::where('jadwal_harian_id', $jadwalHarian->id)
                    ->where('guru_id', $guru->id)
                    ->exists();
            }
        }

        return JadwalGuru::where('guru_id', $guru->id)
            ->whereHas('hari', fn($q) => $q->where('nama_hari', $hari))
            ->exists();
    }
}
