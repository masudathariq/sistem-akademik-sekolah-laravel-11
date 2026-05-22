<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportIqroAspek;
use Illuminate\Http\Request;

class RaportIqroAspekController extends Controller
{
    public function index()
    {
        $aspeks = RaportIqroAspek::orderBy('id', 'desc')->get();
        return view('guru.raport_iqro.aspeks.index', compact('aspeks'));
    }

    public function create()
    {
        return view('guru.raport_iqro.aspeks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aspek' => 'required|string|max:255'
        ]);

        RaportIqroAspek::create([
            'nama_aspek' => $request->nama_aspek,
        ]);

        return redirect()->route('guru.raport-iqro-aspeks.index')
                         ->with('success','Aspek berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $aspek = RaportIqroAspek::findOrFail($id);
        return view('guru.raport_iqro.aspeks.edit', compact('aspek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_aspek' => 'required|string|max:255'
        ]);

        $aspek = RaportIqroAspek::findOrFail($id);
        $aspek->update([
            'nama_aspek' => $request->nama_aspek,
        ]);

        return redirect()->route('guru.raport-iqro-aspeks.index')
                         ->with('success','Aspek berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aspek = RaportIqroAspek::findOrFail($id);
        $aspek->delete();

        return redirect()->route('guru.raport-iqro-aspeks.index')
                         ->with('success','Aspek berhasil dihapus.');
    }
}
