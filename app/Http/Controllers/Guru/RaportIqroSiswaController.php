<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportIqroSiswaGuru;
use App\Models\Tatausaha\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportIqroSiswaController extends Controller
{
    public function create()
    {
        $siswas = Siswa::orderBy('nama_siswa')->get();
        $selected_siswa = RaportIqroSiswaGuru::where('guru_id', Auth::id())->pluck('siswa_id')->toArray();

        return view('guru.raport_iqro.siswa.create', compact('siswas','selected_siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array'
        ]);

        $guru_id = Auth::id();

        RaportIqroSiswaGuru::where('guru_id', $guru_id)->delete();

        foreach ($request->siswa_id as $siswa_id) {
            RaportIqroSiswaGuru::create([
                'guru_id' => $guru_id,
                'siswa_id' => $siswa_id,
            ]);
        }

        return redirect()->route('guru.raport-iqro-siswa.create')
                         ->with('success','Siswa berhasil disimpan untuk raport Iqro.');
    }
}
