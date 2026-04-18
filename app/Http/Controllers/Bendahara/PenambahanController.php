<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Bendahara\Penambahan;

class PenambahanController extends Controller
{
    public function index()
    {
        $penambahans = Penambahan::latest()->get();
        // ambil semua guru, biar tidak query berulang di blade
        $guruMap = Guru::pluck('nama', 'id'); // [id => nama]
        return view('bendahara.penambahan.index', compact('penambahans', 'guruMap'));
    }

    public function create()
    {
        $guruList = Guru::orderBy('nama')->get();
        return view('bendahara.penambahan.create', compact('guruList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'tipe'   => 'required|in:semua,pilihan',
        ]);

        Penambahan::create([
            'judul'   => $request->judul,
            'jumlah'  => $request->jumlah,
            'tipe'    => $request->tipe,
            'guru_id' => $request->tipe === 'pilihan'
                ? $request->guru_id
                : null,
        ]);

        return redirect()->route('bendahara.penambahan.index')
            ->with('success', 'Tunjangan berhasil ditambahkan');
    }

    public function edit(Penambahan $penambahan)
    {
        $guruList = Guru::orderBy('nama')->get();
        return view('bendahara.penambahan.edit', compact('penambahan', 'guruList'));
    }

    public function update(Request $request, Penambahan $penambahan)
    {
        $request->validate([
            'judul' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'tipe'   => 'required|in:semua,pilihan',
        ]);

        $penambahan->update([
            'judul'   => $request->judul,
            'jumlah'  => $request->jumlah,
            'tipe'    => $request->tipe,
            'guru_id' => $request->tipe === 'pilihan'
                ? $request->guru_id
                : null,
        ]);

        return redirect()->route('bendahara.penambahan.index')
            ->with('success', 'Tunjangan berhasil diperbarui');
    }

    public function destroy(Penambahan $penambahan)
    {
        $penambahan->delete();
        return back()->with('success', 'Tunjangan dihapus');
    }
}
