<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Guru;

class GajiPokokController extends Controller
{
    public function index(Request $request)
    {

        $gajis = Gaji::with('guru')
            ->orderBy('guru_id')
            ->get();

        return view('bendahara.gaji-pokok.index', compact('gajis'));
    }

    public function create()
    {
        $guruList = Guru::orderBy('nama')->get();
        return view('bendahara.gaji-pokok.create', compact('guruList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'jumlah_jam' => 'required|numeric|min:0',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $gajiPokok = $request->jumlah_jam * $request->tarif_per_jam;

        Gaji::create([
            'guru_id' => $request->guru_id,
            'jumlah_jam' => $request->jumlah_jam,
            'tarif_per_jam' => $request->tarif_per_jam,
            'gaji_pokok' => $gajiPokok,
        ]);

        return redirect()->route('bendahara.gaji-pokok.index')
            ->with('success', 'Gaji pokok berhasil disimpan!');
    }

    public function edit(Gaji $gaji_pokok)
    {
        $guruList = Guru::orderBy('nama')->get();
        return view('bendahara.gaji-pokok.edit', compact('gaji_pokok', 'guruList'));
    }

    public function update(Request $request, Gaji $gaji_pokok)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'jumlah_jam' => 'required|numeric|min:0',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $gajiPokok = $request->jumlah_jam * $request->tarif_per_jam;

        $gaji_pokok->update([
            'guru_id' => $request->guru_id,
            'jumlah_jam' => $request->jumlah_jam,
            'tarif_per_jam' => $request->tarif_per_jam,
            'gaji_pokok' => $gajiPokok,
        ]);

        return redirect()->route('bendahara.gaji-pokok.index')
            ->with('success', 'Gaji pokok berhasil diperbarui!');
    }

    public function destroy(Gaji $gaji_pokok)
    {
        $gaji_pokok->delete();
        return redirect()->route('bendahara.gaji-pokok.index')
            ->with('success', 'Gaji pokok berhasil dihapus!');
    }
}
