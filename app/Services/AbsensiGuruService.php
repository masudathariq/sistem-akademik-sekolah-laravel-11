<?php

namespace App\Services;

use App\Models\AbsensiGuru;
use App\Models\PengaturanAbsensi;
use App\Helpers\LocationHelper;
use Carbon\Carbon;

class AbsensiGuruService
{
    private float $latSekolah = -5.286945641596192;
    private float $lngSekolah = 105.23101107301207;

    public function getAbsensiHariIni($guru)
    {
        $tanggalIni = Carbon::today()->toDateString();

        return AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $tanggalIni)
            ->first();
    }

    public function absenMasuk($guru, $foto, $latitude = null, $longitude = null)
    {
        $now = Carbon::now();
        [$tanggalIni, $hariIni] = $this->tanggalHariIni($now);

        // cek boleh absen
        if (!AbsensiService::bolehAbsen($guru, $tanggalIni, $hariIni)) {
            return ['error' => 'Anda tidak memiliki jadwal hari ini', 'status' => 403];
        }

        $setting = PengaturanAbsensi::first();
        if (!$setting) return ['error' => 'Pengaturan absensi belum ada', 'status' => 403];

        $jamMulai = $this->parseJam($tanggalIni, $setting->jam_masuk_mulai);
        $jamSelesai = $this->parseJam($tanggalIni, $setting->jam_masuk_selesai);

        if ($now->lt($jamMulai) || $now->gt($jamSelesai)) {
            return ['error' => 'Absen masuk di luar jam yang ditentukan', 'status' => 403];
        }

        $path = $foto->store('absensi/foto', 'public');
        $jarak = LocationHelper::hitungJarakMeter($this->latSekolah, $this->lngSekolah, $latitude, $longitude);
        $zona = LocationHelper::hitungZona($jarak);
        $namaLokasi = $zona === 0 ? 'Area Sekolah' : "Zona $zona";

        $absensi = AbsensiGuru::updateOrCreate(
            ['guru_id' => $guru->id, 'tanggal' => $tanggalIni],
            [
                'status' => 'hadir',
                'jam_masuk' => $now->format('H:i:s'),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'lokasi' => $namaLokasi,
                'foto' => $path,
            ]
        );

        return ['success' => true, 'absensi' => $absensi, 'namaLokasi' => $namaLokasi, 'jarak' => round($jarak, 2)];
    }

    public function absenPulang($guru, $foto, $latitude = null, $longitude = null)
    {
        $now = Carbon::now();
        [$tanggalIni, $hariIni] = $this->tanggalHariIni($now);

        if (!AbsensiService::bolehAbsen($guru, $tanggalIni, $hariIni)) {
            return ['error' => 'Anda tidak memiliki jadwal hari ini', 'status' => 403];
        }

        $setting = PengaturanAbsensi::first();
        if (!$setting) return ['error' => 'Pengaturan absensi belum ada', 'status' => 403];

        $absensi = AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $tanggalIni)
            ->first();

        if (!$absensi || !$absensi->jam_masuk) {
            return ['error' => 'Anda belum absen masuk', 'status' => 403];
        }

        if ($absensi->jam_pulang) {
            return ['error' => 'Anda sudah absen pulang', 'status' => 403];
        }

        $path = $foto->store('absensi/foto', 'public');
        $jarak = LocationHelper::hitungJarakMeter($this->latSekolah, $this->lngSekolah, $latitude, $longitude);
        $zona = LocationHelper::hitungZona($jarak);
        $namaLokasi = $zona === 0 ? 'Area Sekolah' : "Zona $zona";

        $absensi->update([
            'jam_pulang' => $now->format('H:i:s'),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'lokasi' => $namaLokasi,
            'foto' => $path,
        ]);

        return ['success' => true, 'absensi' => $absensi, 'namaLokasi' => $namaLokasi, 'jarak' => round($jarak, 2)];
    }

    public function submitKeterangan($guru, $status, $keterangan)
    {
        $tanggalIni = Carbon::now()->toDateString();

        if (AbsensiGuru::where('guru_id', $guru->id)->where('tanggal', $tanggalIni)->exists()) {
            return ['error' => 'Anda sudah melakukan absensi hari ini', 'status' => 403];
        }

        $absensi = AbsensiGuru::create([
            'guru_id' => $guru->id,
            'tanggal' => $tanggalIni,
            'status' => $status,
            'keterangan' => $keterangan,
        ]);

        return ['success' => true, 'absensi' => $absensi];
    }

    /*** Helper private ***/
    private function parseJam($tanggal, $jam)
    {
        return Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $tanggal . ' ' . (strlen($jam) == 5 ? $jam . ':00' : $jam)
        );
    }

    private function tanggalHariIni($now)
    {
        $tanggalIni = $now->toDateString();
        $mapHari = [
            'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis', 'Friday' => 'Jumat',
            'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'
        ];
        $hariIni = $mapHari[$now->format('l')];
        return [$tanggalIni, $hariIni];
    }
}
