<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportTahfidzSiswaGuru;
use App\Models\Tatausaha\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportTahfidzSiswaController extends Controller
{
    // Form pilih siswa untuk guru
    public function create()
    {
        $siswas = Siswa::orderBy('nama_siswa')->get();
        $selected_siswa = RaportTahfidzSiswaGuru::where('guru_id', Auth::id())->pluck('siswa_id')->toArray();

        return view('guru.raport_tahfidz.siswa.create', compact('siswas','selected_siswa'));
    }

    // Simpan siswa guru
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array'
        ]);

        $guru_id = Auth::id();

        // Hapus siswa lama
        RaportTahfidzSiswaGuru::where('guru_id', $guru_id)->delete();

        // Simpan siswa baru
        foreach($request->siswa_id as $siswa_id){
            RaportTahfidzSiswaGuru::create([
                'guru_id' => $guru_id,
                'siswa_id' => $siswa_id
            ]);
        }

        return redirect()->route('guru.raport-tahfidz-siswa.create')
                         ->with('success','Siswa berhasil disimpan untuk raport.');
    }
}
