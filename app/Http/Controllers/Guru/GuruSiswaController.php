<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Siswa;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class GuruSiswaController extends Controller
{
public function index()
{
    $guru = Auth::user()->guru; // asumsi relasi User->Guru
    $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

    if (!$tahunAjaranAktif) {
        return redirect('/guru')->with('error', 'Belum ada tahun ajaran aktif');
    }

    // Ambil rombel yang dia walikelas di tahun ajaran aktif
    $rombels = Rombel::where('guru_id', $guru->id)
        ->where('tahun_ajaran_id', $tahunAjaranAktif->id)
        ->get();

    // Ambil semua siswa di rombel tersebut
    $siswas = Siswa::whereIn('rombel_id', $rombels->pluck('id'))->get();

    return view('guru.siswa.index', compact('siswas', 'rombels', 'tahunAjaranAktif'));
}

}
