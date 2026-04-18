<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Tatausaha\RombelKategori;
use App\Models\Tatausaha\TahunAjaran;
use App\Models\Tatausaha\Rombel;
use App\Models\Guru;
use App\Models\Tatausaha\MataPelajaran;

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
            'summary' => [
                'total' => 0,
                'L' => 0,
                'P' => 0,
            ],
            'tahunAktif' => null
        ]);
    }

    $rombels = Rombel::with(['kategori', 'siswas'])
        ->where('tahun_ajaran_id', $tahunAktif->id)
        ->whereHas('kategori')
        ->get();

    /* =========================
       1. Rekap per ROMBEL
    ========================= */
    $rekapRombel = [];

    /* =========================
       2. Rekap per Tingkat & Kategori
       3. Rekap per Tingkat
       4. Summary total
    ========================= */
    $rekapTingkatKategori = [];
    $rekapTingkat = [];
    $summary = ['total' => 0, 'L' => 0, 'P' => 0];

    foreach ($rombels as $rombel) {

        $kategori = $rombel->kategori->kategori;
        $total = $rombel->siswas->count();
        $L = $rombel->siswas->where('jenis_kelamin', 'L')->count();
        $P = $rombel->siswas->where('jenis_kelamin', 'P')->count();

        /* 1️⃣ per rombel */
        $rekapRombel[] = [
            'tingkat' => $rombel->tingkat,
            'rombel' => $rombel->kode_rombel . ' - ' . $rombel->nama_rombel,
            'kategori' => $kategori,
            'total' => $total,
            'L' => $L,
            'P' => $P,
        ];

        /* 2️⃣ tingkat + kategori */
        $rekapTingkatKategori[$rombel->tingkat][$kategori]['total'] =
            ($rekapTingkatKategori[$rombel->tingkat][$kategori]['total'] ?? 0) + $total;
        $rekapTingkatKategori[$rombel->tingkat][$kategori]['L'] =
            ($rekapTingkatKategori[$rombel->tingkat][$kategori]['L'] ?? 0) + $L;
        $rekapTingkatKategori[$rombel->tingkat][$kategori]['P'] =
            ($rekapTingkatKategori[$rombel->tingkat][$kategori]['P'] ?? 0) + $P;

        /* 3️⃣ per tingkat */
        $rekapTingkat[$rombel->tingkat]['total'] =
            ($rekapTingkat[$rombel->tingkat]['total'] ?? 0) + $total;
        $rekapTingkat[$rombel->tingkat]['L'] =
            ($rekapTingkat[$rombel->tingkat]['L'] ?? 0) + $L;
        $rekapTingkat[$rombel->tingkat]['P'] =
            ($rekapTingkat[$rombel->tingkat]['P'] ?? 0) + $P;

        /* 4️⃣ summary */
        $summary['total'] += $total;
        $summary['L'] += $L;
        $summary['P'] += $P;
    }
    
    /* =========================
   5️⃣ Total Guru
========================= */
$totalGuru = Guru::count();

    /* =========================
   5️⃣ Total Rombel
========================= */
$totalRombel = Rombel::where('tahun_ajaran_id', $tahunAktif->id)
    ->whereHas('kategori')
    ->count();

    /* =========================
   5️⃣ Total Mata Pelajaran
========================= */
$totalMapel = MataPelajaran::count();


    return view('staff_tu.dashboard', compact(
        'rekapRombel',
        'rekapTingkatKategori',
        'rekapTingkat',
        'summary',
        'tahunAktif',
        'totalGuru',
        'totalRombel',
        'totalMapel'
    ));
}

}

