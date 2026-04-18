<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\Siswa;
use App\Models\Guru\AbsenSiswa; // pastikan namespace sesuai
use App\Models\Tatausaha\TahunAjaran;
use Carbon\Carbon;

class RekapAbsenSiswaController extends Controller
{
    public function rekap(Request $request)
    {
        // Ambil tahun ajaran aktif
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        // Ambil semua rombel tahun ajaran aktif
        $rombels = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->orderBy('tingkat')
            ->orderBy('kode_rombel')
            ->get();

        $rekap = collect(); // default kosong
        $bulan = $request->bulan ?? now()->format('Y-m');

        if ($request->rombel_id) {
            // Ambil semua siswa di rombel yang dipilih
            $siswaRombel = Siswa::where('rombel_id', $request->rombel_id)
                ->orderBy('nama_siswa')
                ->get();

            // Gabungkan dengan data absensi
            $rekap = $siswaRombel->map(function($siswa) use ($bulan) {
    $absensi = $siswa->absenSiswa()
        ->where('tanggal', 'like', $bulan . '%')
        ->get();

    return (object)[
        'siswa' => $siswa,
        'hadir' => $absensi->where('status','H')->count(),
        'izin' => $absensi->where('status','I')->count(),
        'sakit' => $absensi->where('status','S')->count(),
        'alpha' => $absensi->where('status','A')->count(),
        'bolos' => $absensi->where('status','B')->count(),
    ];
});

        }

        return view('staff_tu.rekap_absen.rekap_absen_siswa', compact(
    'rombels',
    'rekap',
    'bulan',
    'tahunAjaranAktif'
));

    }

public function cetak(Request $request)
{
    $bulan = $request->bulan ?? now()->format('Y-m');

    $rombel = null;
    $rekap = collect();

    if ($request->rombel_id) {
        $rombel = Rombel::find($request->rombel_id);

        $siswaRombel = $rombel->siswas()->orderBy('nama_siswa')->get();

        $rekap = $siswaRombel->map(function($siswa) use ($bulan) {
            $absensi = $siswa->absenSiswa()
                ->where('tanggal', 'like', $bulan.'%')
                ->get();

            return (object)[
                'siswa' => $siswa,
                'hadir' => $absensi->where('status','H')->count(),
                'izin' => $absensi->where('status','I')->count(),
                'sakit' => $absensi->where('status','S')->count(),
                'alpha' => $absensi->where('status','A')->count(),
                'bolos' => $absensi->where('status','B')->count(),
            ];
        });
    }

    return view('staff_tu.rekap_absen.rekap_absen_siswa_cetak', compact('rekap', 'bulan', 'rombel'));
}

}
