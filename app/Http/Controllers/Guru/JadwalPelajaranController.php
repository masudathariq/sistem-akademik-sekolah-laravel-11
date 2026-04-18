<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tatausaha\JadwalPelajaran;
use App\Models\Tatausaha\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class JadwalPelajaranController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAktif) {
            return back()->with('error', 'Tidak ada tahun ajaran aktif');
        }

        $jadwals = JadwalPelajaran::with(['rombel','mataPelajaran'])
            ->where('guru_id', $guru->id)
            ->where('tahun_ajaran', $tahunAktif->tahun_ajaran)
            ->where('semester', $tahunAktif->semester)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        return view('guru.jadwal_pelajaran.index', compact(
            'jadwals',
            'tahunAktif'
        ));
    }

    public function hariIni()
{
     $guru = Auth::user()->guru;

    $tahunAktif = \App\Models\Tatausaha\TahunAjaran::where('is_active', true)->first();

    if (!$tahunAktif) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif');
    }

    // 🔥 Ambil hari sekarang dalam bahasa Indonesia
    $hariInggris = strtolower(now()->format('l'));

    $konversiHari = [
        'monday' => 'senin',
        'tuesday' => 'selasa',
        'wednesday' => 'rabu',
        'thursday' => 'kamis',
        'friday' => 'jumat',
        'saturday' => 'sabtu',
        'sunday' => 'minggu',
    ];

    $hari = $konversiHari[$hariInggris] ?? null;

    $jadwals = \App\Models\Tatausaha\JadwalPelajaran::with(['rombel','mataPelajaran'])
        ->where('guru_id', $guru->id)
        ->where('hari', $hari)
        ->where('tahun_ajaran', $tahunAktif->tahun_ajaran)
        ->where('semester', $tahunAktif->semester)
        ->orderBy('jam_mulai')
        ->get();

    return view('guru.jadwal_pelajaran.hari_ini', compact(
        'jadwals',
        'hari',
        'tahunAktif'
    ));
}
}