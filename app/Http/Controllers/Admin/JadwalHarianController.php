<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalHarian;
use App\Models\JadwalHarianGuru;
use App\Models\Guru;

class JadwalHarianController extends Controller
{
    public function index()
    {
        $jadwal = JadwalHarian::latest()->get();
        return view('admin.jadwal-harian.index', compact('jadwal'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama')->get();
        return view('admin.jadwal-harian.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:jadwal_harian,tanggal',
            'mode' => 'required|in:SEMUA,TERBATAS',
        ]);

        $hari = \Carbon\Carbon::parse($request->tanggal)
            ->locale('id')->dayName;

        $jadwal = JadwalHarian::create([
            'tanggal' => $request->tanggal,
            'hari' => ucfirst($hari),
            'mode' => $request->mode,
            'keterangan' => $request->keterangan,
        ]);

        if ($request->mode === 'TERBATAS') {
            foreach ($request->guru_id as $guruId) {
                JadwalHarianGuru::create([
                    'jadwal_harian_id' => $jadwal->id,
                    'guru_id' => $guruId,
                ]);
            }
        }

        return redirect()
            ->route('admin.jadwal-harian.index')
            ->with('success', 'Jadwal harian berhasil disimpan');
    }

        public function edit($id)
    {
        $jadwal = JadwalHarian::with('gurus')->findOrFail($id);
        $gurus = Guru::orderBy('nama')->get();

        return view('admin.jadwal-harian.edit', compact('jadwal', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalHarian::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date|unique:jadwal_harian,tanggal,' . $jadwal->id,
            'mode' => 'required|in:SEMUA,TERBATAS',
        ]);

        $hari = \Carbon\Carbon::parse($request->tanggal)
            ->locale('id')->dayName;

        $jadwal->update([
            'tanggal' => $request->tanggal,
            'hari' => ucfirst($hari),
            'mode' => $request->mode,
            'keterangan' => $request->keterangan,
        ]);

        // hapus relasi guru lama
        JadwalHarianGuru::where('jadwal_harian_id', $jadwal->id)->delete();

        // simpan ulang jika TERBATAS
        if ($request->mode === 'TERBATAS' && $request->guru_id) {
            foreach ($request->guru_id as $guruId) {
                JadwalHarianGuru::create([
                    'jadwal_harian_id' => $jadwal->id,
                    'guru_id' => $guruId,
                ]);
            }
        }

        return redirect()
            ->route('admin.jadwal-harian.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        JadwalHarian::findOrFail($id)->delete();

        return back()->with('success', 'Jadwal dihapus');
    }

}

