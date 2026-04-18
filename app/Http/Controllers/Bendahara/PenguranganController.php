<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Bendahara\Pengurangan;

class PenguranganController extends Controller
{
    public function index()
    {
        $pengurangans = Pengurangan::latest()->get();
        $guruMap = Guru::pluck('nama', 'id');

        return view('bendahara.pengurangan.index', compact('pengurangans', 'guruMap'));
    }

    public function create()
    {
        $guruList = Guru::orderBy('nama')->get();
        return view('bendahara.pengurangan.create', compact('guruList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'tipe'   => 'required|in:semua,pilihan',
        ]);

        Pengurangan::create([
            'judul'   => $request->judul,
            'jumlah'  => $request->jumlah,
            'tipe'    => $request->tipe,
            'guru_id' => $request->tipe === 'pilihan' ? $request->guru_id : null,
        ]);

        return redirect()->route('bendahara.pengurangan.index');
    }

    public function edit(Pengurangan $pengurangan)
    {
        $guruList = Guru::orderBy('nama')->get();
        return view('bendahara.pengurangan.edit', compact('pengurangan', 'guruList'));
    }

    public function update(Request $request, Pengurangan $pengurangan)
    {
        $pengurangan->update([
            'judul'   => $request->judul,
            'jumlah'  => $request->jumlah,
            'tipe'    => $request->tipe,
            'guru_id' => $request->tipe === 'pilihan' ? $request->guru_id : null,
        ]);

        return redirect()->route('bendahara.pengurangan.index');
    }

    public function destroy(Pengurangan $pengurangan)
    {
        $pengurangan->delete();
        return back();
    }
}
