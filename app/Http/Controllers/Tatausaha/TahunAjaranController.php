<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\TahunAjaran;


class TahunAjaranController extends Controller
{
    public function index()
    {
        $data = TahunAjaran::orderBy('id', 'desc')->get();
        return view('staff_tu.tahun_ajaran.index', compact('data'));
    }

    public function create()
    {
        return view('staff_tu.tahun_ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required'
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'is_active' => false
        ]);

        return redirect('/staff_tu/tahun-ajaran')
            ->with('success', 'Tahun ajaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return view('staff_tu.tahun_ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required'
        ]);

        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester
        ]);

        return redirect('/staff_tu/tahun-ajaran')
            ->with('success', 'Tahun ajaran berhasil diupdate');
    }

    public function setAktif($id)
    {
        TahunAjaran::where('is_active', true)->update(['is_active' => false]);
        TahunAjaran::where('id', $id)->update(['is_active' => true]);

        return back()->with('success', 'Tahun ajaran diaktifkan');
    }
}


