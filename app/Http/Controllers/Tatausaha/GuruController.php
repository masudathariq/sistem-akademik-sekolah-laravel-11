<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Tampilkan semua data guru
     */
    public function index()
    {
        $gurus = Guru::with('user')->orderBy('nama')->get();

        return view('staff_tu.guru.index', compact('gurus'));
    }

    /**
 * Tampilkan detail guru tertentu untuk admin
 */
public function show(Guru $guru)
{
    // Hitung masa kerja dari TMT
    $masaKerja = '-';
    if ($guru->tmt) {
        $tmt = \Carbon\Carbon::parse($guru->tmt);
        $sekarang = \Carbon\Carbon::now();
        $diff = $tmt->diff($sekarang);
        $masaKerja = $diff->y . ' tahun, ' . $diff->m . ' bulan';
    }

    return view('staff_tu.guru.show', compact('guru', 'masaKerja'));
}

}
