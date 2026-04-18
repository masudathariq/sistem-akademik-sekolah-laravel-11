<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Tatausaha\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapels = MataPelajaran::latest()->get();
        return view('staff_tu.mata_pelajaran.index', compact('mapels'));
    }

    public function create()
    {
        return view('staff_tu.mata_pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required'
        ]);

        MataPelajaran::create($request->all());

        return redirect()->route('staff_tu.mata_pelajaran.index')
                         ->with('success','Mata pelajaran berhasil ditambahkan');
    }

    public function edit(MataPelajaran $mata_pelajaran)
    {
        return view('staff_tu.mata_pelajaran.edit', compact('mata_pelajaran'));
    }

    public function update(Request $request, MataPelajaran $mata_pelajaran)
    {
        $request->validate([
            'nama_mapel' => 'required'
        ]);

        $mata_pelajaran->update($request->all());

        return redirect()->route('staff_tu.mata_pelajaran.index')
                         ->with('success','Mata pelajaran berhasil diupdate');
    }

    public function destroy(MataPelajaran $mata_pelajaran)
    {
        $mata_pelajaran->delete();

        return redirect()->route('staff_tu.mata_pelajaran.index')
                         ->with('success','Mata pelajaran berhasil dihapus');
    }
}