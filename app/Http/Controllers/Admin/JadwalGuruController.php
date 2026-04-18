<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hari;
use App\Models\Guru;
use App\Models\JadwalGuru;
use Illuminate\Http\Request;

class JadwalGuruController extends Controller
{
    /**
     * Tampilkan daftar hari
     */
    public function index()
    {
        $hari = Hari::withCount('jadwalGuru')
            ->orderBy('id')
            ->get();
        return view('admin.jadwal.hari', compact('hari'));
    }

    /**
     * Detail hari + guru terjadwal
     */
    public function show($hariId)
    {
        $hari = Hari::findOrFail($hariId);

        $guruTerjadwal = JadwalGuru::with('guru')
            ->where('hari_id', $hariId)
            ->get();

        $guru = Guru::orderBy('nama')->get();

        return view('admin.jadwal.detail', compact(
            'hari',
            'guruTerjadwal',
            'guru'
        ));
    }

    /**
     * Simpan guru ke hari
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari_id' => 'required|exists:hari,id',
            'guru_id' => 'required|array',
            'guru_id.*' => 'exists:gurus,id'
        ]);

        foreach ($request->guru_id as $guruId) {
            JadwalGuru::firstOrCreate([
                'hari_id' => $request->hari_id,
                'guru_id' => $guruId
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Guru berhasil ditambahkan ke hari ini');
    }

    /**
     * Hapus guru dari hari
     */
    public function destroy($id)
    {
        JadwalGuru::findOrFail($id)->delete();

        return redirect()
            ->back()
            ->with('success', 'Guru berhasil dihapus dari hari');
    }
}
