<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Tatausaha\MataPelajaran;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\TahunAjaran;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAktif) {
            return view('staff_tu.dashboard', [
                'rekapRombel' => [],
                'rekapTingkatKategori' => [],
                'rekapTingkat' => [],
                'summary' => ['total' => 0, 'L' => 0, 'P' => 0],
                'tahunAktif' => null,
                'totalGuru' => Guru::count(),
                'totalRombel' => 0,
                'totalMapel' => MataPelajaran::count(),
            ]);
        }

        $rombels = Rombel::with('kategori')
            ->withCount([
                'siswas as total_siswa',
                'siswas as total_laki_laki' => fn ($query) => $query->where('jenis_kelamin', 'L'),
                'siswas as total_perempuan' => fn ($query) => $query->where('jenis_kelamin', 'P'),
            ])
            ->where('tahun_ajaran_id', $tahunAktif->id)
            ->whereHas('kategori')
            ->orderBy('tingkat')
            ->orderBy('kode_rombel')
            ->get();

        $rekapRombel = [];
        $rekapTingkatKategori = [];
        $rekapTingkat = [];
        $summary = ['total' => 0, 'L' => 0, 'P' => 0];

        foreach ($rombels as $rombel) {
            $kategori = $rombel->kategori->kategori;
            $total = (int) $rombel->total_siswa;
            $lakiLaki = (int) $rombel->total_laki_laki;
            $perempuan = (int) $rombel->total_perempuan;

            $rekapRombel[] = [
                'tingkat' => $rombel->tingkat,
                'tingkat_label' => $rombel->tingkat_romawi,
                'rombel' => $rombel->kode_rombel . ' - ' . $rombel->nama_rombel,
                'kategori' => $kategori,
                'total' => $total,
                'L' => $lakiLaki,
                'P' => $perempuan,
            ];

            $rekapTingkatKategori[$rombel->tingkat][$kategori]['total'] =
                ($rekapTingkatKategori[$rombel->tingkat][$kategori]['total'] ?? 0) + $total;
            $rekapTingkatKategori[$rombel->tingkat][$kategori]['L'] =
                ($rekapTingkatKategori[$rombel->tingkat][$kategori]['L'] ?? 0) + $lakiLaki;
            $rekapTingkatKategori[$rombel->tingkat][$kategori]['P'] =
                ($rekapTingkatKategori[$rombel->tingkat][$kategori]['P'] ?? 0) + $perempuan;

            $rekapTingkat[$rombel->tingkat]['total'] =
                ($rekapTingkat[$rombel->tingkat]['total'] ?? 0) + $total;
            $rekapTingkat[$rombel->tingkat]['L'] =
                ($rekapTingkat[$rombel->tingkat]['L'] ?? 0) + $lakiLaki;
            $rekapTingkat[$rombel->tingkat]['P'] =
                ($rekapTingkat[$rombel->tingkat]['P'] ?? 0) + $perempuan;

            $summary['total'] += $total;
            $summary['L'] += $lakiLaki;
            $summary['P'] += $perempuan;
        }

        ksort($rekapTingkat);
        ksort($rekapTingkatKategori);

        return view('staff_tu.dashboard', [
            'rekapRombel' => $rekapRombel,
            'rekapTingkatKategori' => $rekapTingkatKategori,
            'rekapTingkat' => $rekapTingkat,
            'summary' => $summary,
            'tahunAktif' => $tahunAktif,
            'totalGuru' => Guru::count(),
            'totalRombel' => $rombels->count(),
            'totalMapel' => MataPelajaran::count(),
        ]);
    }
}
