<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Siswa;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\TahunAjaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;

class SiswaController extends Controller
{
    // 📋 INDEX SISWA
    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('staff_tu.index')
                ->with('error', 'Belum ada tahun ajaran aktif');
        }



        $siswas = Siswa::with('rombelAktif')
            ->orderBy('nama_siswa')
                        ->paginate(20); 



        return view('staff_tu.siswa.index', compact('siswas', 'tahunAjaranAktif'));
    }

    // 📝 CREATE
    public function create()
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->route('staff_tu.index')
                ->with('error', 'Belum ada tahun ajaran aktif');
        }

        $rombels = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->orderBy('tingkat')
            ->orderBy('kode_rombel')
            ->get();

        return view('staff_tu.siswa.create', compact('rombels', 'tahunAjaranAktif'));
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nis' => 'required|unique:siswas,nis',
            'nama_siswa' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'ayah' => 'required|string',
            'ibu' => 'required|string',
            'wali' => 'nullable|string',
            'rombel_id' => 'nullable|exists:rombels,id',
        ]);

        Siswa::create($request->all());

        return redirect()->route('staff_tu.siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    // 🔎 SHOW
    public function show(Siswa $siswa)
    {
        $siswa->load('rombelAktif');

        return view('staff_tu.siswa.show', compact('siswa'));
    }

    // ✏️ EDIT
    public function edit(Siswa $siswa)
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
        $rombels = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->orderBy('tingkat')
            ->orderBy('kode_rombel')
            ->get();

        return view('staff_tu.siswa.edit', compact('siswa', 'rombels', 'tahunAjaranAktif'));
    }

    // 🔄 UPDATE
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'nama_siswa' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'ayah' => 'required|string',
            'ibu' => 'required|string',
            'wali' => 'nullable|string',
            'rombel_id' => 'nullable|exists:rombels,id',
        ]);

        $siswa->update($request->all());

        return redirect()->route('staff_tu.siswa.index')
            ->with('success', 'Siswa berhasil diupdate');
    }

    // 🗑️ DELETE
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return back()->with('success', 'Siswa berhasil dihapus');
    }

    // 📦 EXPORT EXCEL
    public function export()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    // 📥 IMPORT EXCEL
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()
            ->with('success', 'Data siswa berhasil diimport!');
    }
}
