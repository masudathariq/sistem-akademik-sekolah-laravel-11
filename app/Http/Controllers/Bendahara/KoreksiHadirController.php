<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bendahara\KoreksiHadir;
use App\Models\Guru;


class KoreksiHadirController extends Controller
{
public function index(Request $request)
{
    $bulan = $request->get('bulan', now()->month);
    $tahun = $request->get('tahun', now()->year);

    $guruList = Guru::all();

    $data = $guruList->map(function ($guru) use ($bulan, $tahun) {

        // ✅ ABSENSI ASLI (BENAR)
        $absensi = $guru->absensi()
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $hadirAsli = $absensi->where('status', 'hadir')->count();

        // ✅ KOREKSI
        $koreksi = KoreksiHadir::where('guru_id', $guru->id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        return [
            'guru'       => $guru,
            'hadir_asli' => $hadirAsli,
            'koreksi_id' => $koreksi?->id,
            'koreksi'    => $koreksi?->jumlah ?? 0,
        ];
    });

    return view('bendahara.koreksi-hadir.index', compact(
        'data',
        'bulan',
        'tahun'
    ));
}



    public function create()
    {
        $guruList = Guru::all();
        return view('bendahara.koreksi-hadir.create', compact('guruList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required',
            'bulan'   => 'required|numeric',
            'tahun'   => 'required|numeric',
            'jumlah'  => 'required|numeric',
        ]);

        KoreksiHadir::create($request->all());

        return redirect()
            ->route('bendahara.koreksi-hadir.index')
            ->with('success','Koreksi hadir berhasil ditambahkan');
    }

    public function edit(KoreksiHadir $koreksi)
    {
        $guruList = Guru::all();
        return view('bendahara.koreksi-hadir.edit', compact('koreksi','guruList'));
    }

    public function update(Request $request, KoreksiHadir $koreksi)
    {
        $request->validate([
            'guru_id' => 'required',
            'bulan'   => 'required',
            'tahun'   => 'required',
            'jumlah'  => 'required',
        ]);

        $koreksi->update($request->all());

        return redirect()
            ->route('bendahara.koreksi-hadir.index')
            ->with('success','Koreksi hadir berhasil diupdate');
    }

    public function destroy(KoreksiHadir $koreksi)
    {
        $koreksi->delete();

        return back()->with('success','Koreksi hadir dihapus');
    }
}
