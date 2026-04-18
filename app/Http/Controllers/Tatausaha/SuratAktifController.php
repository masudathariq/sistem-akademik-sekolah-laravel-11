<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Siswa;
use App\Models\Tatausaha\SuratAktifSiswa;
use App\Models\Tatausaha\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratAktifController extends Controller
{
    public function index()
    {
        $surats = SuratAktifSiswa::with('siswa.rombel')->latest()->get();

        return view('staff_tu.surat.surat_aktif.index', compact('surats'));
    }

    public function create()
    {
        $tahunAktif = TahunAjaran::where('is_active', 1)->first();
        $rombels = $tahunAktif ? $tahunAktif->rombels : [];

        return view('staff_tu.surat.surat_aktif.create', compact('rombels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat'   => 'required',
            'siswa_id'      => 'required|exists:siswas,id',
            'tanggal_surat' => 'required|date',
        ]);

        SuratAktifSiswa::create($request->all());

        return redirect()
            ->route('staff_tu.surat-aktif.index')
            ->with('success', 'Surat berhasil dibuat');
    }

    public function edit($id)
    {
        $surat = SuratAktifSiswa::findOrFail($id);

        $tahunAktif = TahunAjaran::where('is_active', 1)->first();
        $rombels = $tahunAktif ? $tahunAktif->rombels : [];

        return view('staff_tu.surat.surat_aktif.edit', compact('surat', 'rombels'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat'   => 'required',
            'siswa_id'      => 'required|exists:siswas,id',
            'tanggal_surat' => 'required|date',
        ]);

        $surat = SuratAktifSiswa::findOrFail($id);
        $surat->update($request->all());

        return redirect()
            ->route('staff_tu.surat-aktif.index')
            ->with('success', 'Surat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $surat = SuratAktifSiswa::findOrFail($id);
        $surat->delete();

        return redirect()
            ->route('staff_tu.surat-aktif.index')
            ->with('success', 'Surat berhasil dihapus');
    }

    public function getSiswa($rombelId)
    {
        return Siswa::where('rombel_id', $rombelId)->get();
    }

    public function cetak($id)
    {
        $surat = SuratAktifSiswa::with('siswa.rombel')->findOrFail($id);

        $pdf = Pdf::loadView('staff_tu.surat.surat_aktif.cetak', compact('surat'));

        return $pdf->stream('surat-aktif.pdf');
    }
}