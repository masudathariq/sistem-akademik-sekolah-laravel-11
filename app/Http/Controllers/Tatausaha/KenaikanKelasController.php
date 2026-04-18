<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Tatausaha\TahunAjaran;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\Siswa;
use Illuminate\Http\Request;

class KenaikanKelasController extends Controller
{
    public function index()
    {
        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAktif) {
            return back()->with('error', 'Belum ada tahun ajaran aktif');
        }

        // semua tahun kecuali yang aktif
        $tahunTujuanList = TahunAjaran::where('id', '!=', $tahunAktif->id)
            ->orderBy('tahun_ajaran')
            ->get();

        if ($tahunTujuanList->isEmpty()) {
            return back()->with('error', 'Belum ada tahun ajaran tujuan');
        }

        return view('staff_tu.kenaikan.index', compact(
            'tahunAktif',
            'tahunTujuanList'
        ));
    }

public function proses(Request $request)
{

    $request->validate([
        'tahun_tujuan_id' => 'required|exists:tahun_ajarans,id'
    ]);

    $tahunAktif = TahunAjaran::where('is_active', true)->first();
    $tahunTujuan = TahunAjaran::findOrFail($request->tahun_tujuan_id);

    $rombels = Rombel::where('tahun_ajaran_id', $tahunAktif->id)->get();

    foreach ($rombels as $rombel) {

    

        // kelas 9 = lulus
        if ((int)$rombel->tingkat === 9) {
            continue;
        }

        $rombelTujuan = Rombel::where('tahun_ajaran_id', $tahunTujuan->id)
            ->where('tingkat', (string)((int)$rombel->tingkat + 1))
            ->where('kode_rombel', $rombel->kode_rombel)
            ->first();

        if (!$rombelTujuan) {
            return back()->with(
                'error',
                "Rombel tujuan TIDAK ADA:
                dari {$rombel->tingkat}{$rombel->kode_rombel}
                ke tingkat ".((int)$rombel->tingkat + 1)."
                di tahun {$tahunTujuan->tahun_ajaran}"
            );
        }

        Siswa::where('rombel_id', $rombel->id)
            ->update([
                'rombel_id' => $rombelTujuan->id
            ]);
    }

    return back()->with('success', 'Proses kenaikan kelas berhasil');
}

}
