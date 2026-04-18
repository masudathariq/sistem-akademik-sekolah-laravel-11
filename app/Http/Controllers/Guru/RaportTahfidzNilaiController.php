<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportTahfidzAspek;
use App\Models\Guru\RaportTahfidzNilai;
use App\Models\Tatausaha\Siswa;
use App\Models\Guru\RaportTahfidzSiswaGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportTahfidzNilaiController extends Controller
{

public function index()
{
    // Ambil semua aspek yang bisa diinput nilainya
    $aspeks = RaportTahfidzAspek::orderBy('id', 'desc')->get();

    return view('guru.raport_tahfidz.nilai.index', compact('aspeks'));
}



    // Form input nilai untuk satu aspek
    public function create($aspek_id)
    {
        $aspek = RaportTahfidzAspek::findOrFail($aspek_id);

        // Ambil siswa yang menjadi tanggung jawab guru ini
        $guru_id = Auth::id();
        $siswa_ids = RaportTahfidzSiswaGuru::where('guru_id', $guru_id)
                        ->pluck('siswa_id')
                        ->toArray();

        $siswas = Siswa::whereIn('id', $siswa_ids)
                        ->orderBy('nama_siswa')
                        ->get();

        // Ambil nilai yang sudah ada untuk aspek ini
        $nilai = RaportTahfidzNilai::where('aspek_id', $aspek->id)
                    ->whereIn('siswa_id', $siswa_ids)
                    ->pluck('nilai','siswa_id')->toArray();

        return view('guru.raport_tahfidz.nilai.create', compact('aspek','siswas','nilai'));
    }

    // Simpan nilai siswa untuk aspek ini
    public function store(Request $request, $aspek_id)
    {
        $aspek = RaportTahfidzAspek::findOrFail($aspek_id);

        $request->validate([
            'siswa_id' => 'required|array',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:4'
        ]);

        foreach ($request->siswa_id as $index => $siswa_id) {
            RaportTahfidzNilai::updateOrCreate(
                [
                    'aspek_id' => $aspek->id,
                    'siswa_id' => $siswa_id
                ],
                [
                    'nilai' => $request->nilai[$index]
                ]
            );
        }

        return redirect()->route('guru.raport-nilai.index')
                         ->with('success','Nilai siswa berhasil disimpan.');
    }

    // Reuse create untuk edit
    public function edit($aspek_id)
    {
        return $this->create($aspek_id);
    }

    // Reuse store untuk update
    public function update(Request $request, $aspek_id)
    {
        return $this->store($request, $aspek_id);
    }
}
