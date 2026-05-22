<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportIqroBacaan;
use App\Models\Guru\RaportIqroSiswaGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportIqroBacaanController extends Controller
{
    public function index()
    {
        [$siswas, $bacaan] = $this->getBacaanIndexData();

        return view('guru.raport_iqro.bacaan.index', compact('siswas','bacaan'));
    }

    public function cetakPdf()
    {
        [$siswas, $bacaan] = $this->getBacaanIndexData();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('guru.raport_iqro.bacaan.cetak-pdf', compact('siswas', 'bacaan'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ]);

        return $pdf->stream('daftar-bacaan-iqro-siswa.pdf');
    }

    private function getBacaanIndexData(): array
    {
        $guru_id = Auth::id();

        $siswas = RaportIqroSiswaGuru::with('siswa')
                    ->where('guru_id', $guru_id)
                    ->get()
                    ->pluck('siswa');

        $siswa_ids = $siswas->pluck('id')->toArray();
        $bacaan = RaportIqroBacaan::whereIn('siswa_id', $siswa_ids)
                    ->get()
                    ->keyBy('siswa_id');

        return [$siswas, $bacaan];
    }

    public function create()
    {
        $guru_id = Auth::id();

        $siswas = RaportIqroSiswaGuru::with('siswa')
                    ->where('guru_id', $guru_id)
                    ->get()
                    ->pluck('siswa');

        $siswa_ids = $siswas->pluck('id')->toArray();
        $bacaan = RaportIqroBacaan::whereIn('siswa_id', $siswa_ids)
                    ->get()
                    ->keyBy('siswa_id');

        return view('guru.raport_iqro.bacaan.create', compact('siswas','bacaan'));
    }

    public function store(Request $request)
    {
        $guru_id = Auth::id();

        $siswas = RaportIqroSiswaGuru::where('guru_id', $guru_id)
                    ->pluck('siswa_id')
                    ->toArray();

        $request->validate([
            'siswa_id' => 'required|array',
            'iqro_terakhir' => 'required|array',
            'halaman_terakhir' => 'required|array',
            'iqro_lanjut' => 'required|array',
            'halaman_lanjut' => 'required|array',
        ]);

        foreach ($request->siswa_id as $index => $siswa_id) {
            if (!in_array($siswa_id, $siswas)) continue;

            RaportIqroBacaan::updateOrCreate(
                ['siswa_id' => $siswa_id],
                [
                    'iqro_terakhir' => $request->iqro_terakhir[$index],
                    'halaman_terakhir' => $request->halaman_terakhir[$index],
                    'iqro_lanjut' => $request->iqro_lanjut[$index],
                    'halaman_lanjut' => $request->halaman_lanjut[$index],
                ]
            );
        }

        return redirect()->route('guru.raport-iqro-bacaan.create')
                         ->with('success','Data bacaan Iqro berhasil disimpan.');
    }
}
