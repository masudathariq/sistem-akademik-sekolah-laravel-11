<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportTahfidzHafalan;
use App\Models\Guru\RaportTahfidzSiswaGuru;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportTahfidzHafalanController extends Controller
{
    // Daftar hafalan semua siswa guru
    public function index()
    {
        [$siswas, $hafalan] = $this->getHafalanIndexData();

        return view('guru.raport_tahfidz.hafalan.index', compact('siswas','hafalan'));
    }

    public function cetakPdf()
    {
        [$siswas, $hafalan] = $this->getHafalanIndexData();

        $pdf = Pdf::loadView('guru.raport_tahfidz.hafalan.cetak-pdf', compact('siswas', 'hafalan'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ]);

        return $pdf->stream('daftar-hafalan-siswa.pdf');
    }

    private function getHafalanIndexData(): array
    {
        $guru_id = Auth::id();

        $siswas = RaportTahfidzSiswaGuru::with('siswa')
                    ->where('guru_id', $guru_id)
                    ->get()
                    ->pluck('siswa');

        $siswa_ids = $siswas->pluck('id')->toArray();
        $hafalan = RaportTahfidzHafalan::whereIn('siswa_id', $siswa_ids)
                    ->get()
                    ->keyBy('siswa_id');

        return [$siswas, $hafalan];
    }

    // Form input hafalan
    public function create()
    {
        $guru_id = Auth::id();

        $siswas = RaportTahfidzSiswaGuru::with('siswa')
                    ->where('guru_id', $guru_id)
                    ->get()
                    ->pluck('siswa');

        $siswa_ids = $siswas->pluck('id')->toArray();
        $hafalan = RaportTahfidzHafalan::whereIn('siswa_id', $siswa_ids)
                    ->get()
                    ->keyBy('siswa_id');

        return view('guru.raport_tahfidz.hafalan.create', compact('siswas','hafalan'));
    }

    // Simpan hafalan
    public function store(Request $request)
    {
        $guru_id = Auth::id();

        $siswas = RaportTahfidzSiswaGuru::where('guru_id', $guru_id)
                    ->pluck('siswa_id')
                    ->toArray();

        $request->validate([
            'siswa_id' => 'required|array',
            'surah_terakhir' => 'required|array',
            'ayat_terakhir' => 'required|array',
            'surah_lanjut' => 'required|array',
            'ayat_lanjut' => 'required|array',
        ]);

        foreach ($request->siswa_id as $index => $siswa_id) {
            if (!in_array($siswa_id, $siswas)) continue;

            RaportTahfidzHafalan::updateOrCreate(
                ['siswa_id' => $siswa_id],
                [
                    'surah_terakhir' => $request->surah_terakhir[$index],
                    'ayat_terakhir' => $request->ayat_terakhir[$index],
                    'surah_lanjut' => $request->surah_lanjut[$index],
                    'ayat_lanjut' => $request->ayat_lanjut[$index],
                ]
            );
        }

        return redirect()->route('guru.raport-hafalan.create')
                         ->with('success','Data hafalan berhasil disimpan.');
    }
}
