<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Bendahara\TahfidzGuru;
use App\Models\Bendahara\SettingTahfidz;

class TahfidzController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $gurus = Guru::orderBy('nama')->get();

        $setting = SettingTahfidz::latest()->first();
        $harga = $setting->harga_per_hadir ?? 0;

        $data = TahfidzGuru::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get()
            ->keyBy('guru_id');

        return view('bendahara.tahfidz.index', compact(
            'gurus',
            'bulan',
            'tahun',
            'harga',
            'data'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric|min:0',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $harga = $request->harga;

        // Update setting harga
        SettingTahfidz::updateOrCreate(
            ['id' => 1],
            ['harga_per_hadir' => $harga]
        );

        if ($request->jumlah_hadir) {
            foreach ($request->jumlah_hadir as $guruId => $jumlah) {

                $jumlah = $jumlah ?? 0;
                $total = $jumlah * $harga;

                TahfidzGuru::updateOrCreate(
                    [
                        'guru_id' => $guruId,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                    ],
                    [
                        'jumlah_hadir' => $jumlah,
                        'total' => $total,
                    ]
                );
            }
        }

        return redirect()
            ->route('bendahara.tahfidz.index', [
                'bulan' => $bulan,
                'tahun' => $tahun
            ])
            ->with('success', 'Data tahfidz berhasil disimpan.');
    }
}
