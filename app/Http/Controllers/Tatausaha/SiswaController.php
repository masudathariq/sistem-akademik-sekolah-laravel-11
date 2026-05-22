<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Siswa;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\TahunAjaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use App\Exports\SiswaDataExport;
use App\Exports\SiswaDataPdf;
use App\Imports\SiswaImport;

class SiswaController extends Controller
{
    // 📋 INDEX SISWA
    public function index(Request $request)
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        $rombels = collect();
        if ($tahunAjaranAktif) {
            $rombels = Rombel::where('tahun_ajaran_id', $tahunAjaranAktif->id)
                ->orderByRaw("CASE WHEN tingkat IN ('VII','7') THEN 1 WHEN tingkat IN ('VIII','8') THEN 2 WHEN tingkat IN ('IX','9') THEN 3 ELSE 4 END")
                ->orderBy('kode_rombel')
                ->get();
        }

        $siswasQuery = Siswa::with('rombelAktif')
            ->leftJoin('rombels', 'siswas.rombel_id', '=', 'rombels.id')
            ->select('siswas.*');

        if ($request->filled('tingkat')) {
            $siswasQuery->where('rombels.tingkat', $request->tingkat);
        }

        if ($request->filled('kode_rombel')) {
            $siswasQuery->where('rombels.kode_rombel', $request->kode_rombel);
        }

        $siswas = $siswasQuery
            ->orderByRaw("CASE WHEN rombels.tingkat IN ('VII','7') THEN 1 WHEN rombels.tingkat IN ('VIII','8') THEN 2 WHEN rombels.tingkat IN ('IX','9') THEN 3 ELSE 4 END")
            ->orderBy('rombels.kode_rombel')
            ->paginate(100)
            ->withQueryString();

        return view('staff_tu.siswa.index', compact('siswas', 'tahunAjaranAktif', 'rombels'));
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

    // 📦 EXPORT TEMPLATE EXCEL
    public function export()
    {
        return Excel::download(new SiswaExport, 'TEMPLATE EXPORT DATA SISWA.xlsx');
    }

    // 📦 EXPORT DATA EXCEL
    public function exportData(Request $request)
    {
        $tingkat = $request->query('tingkat');
        $kodeRom = $request->query('kode_rombel');
        $filename = 'DATA_SISWA_' . ($tingkat ? $tingkat : 'SEMUA');
        if ($kodeRom) {
            $filename .= '_'.$kodeRom;
        }
        $filename .= '_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new SiswaDataExport($tingkat, $kodeRom), $filename);
    }

    // 📦 EXPORT DATA PDF
    public function exportDataPdf(Request $request)
    {
        $tingkat = $request->query('tingkat');
        $kodeRom = $request->query('kode_rombel');

        return (new SiswaDataPdf($tingkat, $kodeRom))->download();
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
