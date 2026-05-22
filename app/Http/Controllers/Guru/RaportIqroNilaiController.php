<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportIqroAspek;
use App\Models\Guru\RaportIqroNilai;
use App\Models\Guru\RaportIqroSiswaGuru;
use App\Models\Tatausaha\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportIqroNilaiController extends Controller
{
    public function index()
    {
        $aspeks = RaportIqroAspek::orderBy('id', 'desc')->get();
        return view('guru.raport_iqro.nilai.index', compact('aspeks'));
    }

    public function create($aspek_id)
    {
        $aspek = RaportIqroAspek::findOrFail($aspek_id);

        $guru_id = Auth::id();
        $siswa_ids = RaportIqroSiswaGuru::where('guru_id', $guru_id)
                        ->pluck('siswa_id')
                        ->toArray();

        $siswas = Siswa::whereIn('id', $siswa_ids)
                        ->orderBy('nama_siswa')
                        ->get();

        $nilai = RaportIqroNilai::where('aspek_id', $aspek->id)
                    ->whereIn('siswa_id', $siswa_ids)
                    ->pluck('nilai','siswa_id')->toArray();

        return view('guru.raport_iqro.nilai.create', compact('aspek','siswas','nilai'));
    }

    public function store(Request $request, $aspek_id)
    {
        $aspek = RaportIqroAspek::findOrFail($aspek_id);

        $request->validate([
            'siswa_id' => 'required|array',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:4'
        ]);

        foreach ($request->siswa_id as $index => $siswa_id) {
            RaportIqroNilai::updateOrCreate(
                [
                    'aspek_id' => $aspek->id,
                    'siswa_id' => $siswa_id,
                ],
                [
                    'nilai' => $request->nilai[$index],
                ]
            );
        }

        return redirect()->route('guru.raport-iqro-nilai.index')
                         ->with('success','Nilai siswa berhasil disimpan.');
    }

    public function edit($aspek_id)
    {
        return $this->create($aspek_id);
    }

    public function update(Request $request, $aspek_id)
    {
        return $this->store($request, $aspek_id);
    }
}
