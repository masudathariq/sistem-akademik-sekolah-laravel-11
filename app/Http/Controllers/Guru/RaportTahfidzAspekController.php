<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportTahfidzAspek;
use Illuminate\Http\Request;

class RaportTahfidzAspekController extends Controller
{
    // Tampilkan semua aspek
    public function index()
    {
        $aspeks = RaportTahfidzAspek::orderBy('id', 'desc')->get();
        return view('guru.raport_tahfidz.aspeks.index', compact('aspeks'));
    }

    // Form tambah aspek
    public function create()
    {
        return view('guru.raport_tahfidz.aspeks.create');
    }

    // Simpan aspek baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_aspek' => 'required|string|max:255'
        ]);

        RaportTahfidzAspek::create([
            'nama_aspek' => $request->nama_aspek
        ]);

        return redirect()->route('guru.raport-aspeks.index')
                         ->with('success','Aspek berhasil ditambahkan.');
    }

    // Form edit aspek
    public function edit($id)
    {
        $aspek = RaportTahfidzAspek::findOrFail($id);
        return view('guru.raport_tahfidz.aspeks.edit', compact('aspek'));
    }

    // Update aspek
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_aspek' => 'required|string|max:255'
        ]);

        $aspek = RaportTahfidzAspek::findOrFail($id);
        $aspek->update([
            'nama_aspek' => $request->nama_aspek
        ]);

        return redirect()->route('guru.raport-aspeks.index')
                         ->with('success','Aspek berhasil diperbarui.');
    }

    // Hapus aspek
    public function destroy($id)
    {
        $aspek = RaportTahfidzAspek::findOrFail($id);
        $aspek->delete();

        return redirect()->route('guru.raport-aspeks.index')
                         ->with('success','Aspek berhasil dihapus.');
    }
}
