<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\SuratPindahSiswa;

class SuratPindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $surats = SuratPindahSiswa::latest()->get();

    return view('staff_tu.surat.surat_pindah.index', compact('surats'));
}


    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    return view('staff_tu.surat.surat_pindah.create');
}


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'nomor_surat' => 'required',
        'tanggal_surat' => 'required|date',
        'nama_siswa' => 'required',
    ]);

    SuratPindahSiswa::create($request->all());

    return redirect()
        ->route('staff_tu.surat-pindah.index')
        ->with('success', 'Surat pindah berhasil dibuat');
}


    /**
     * Display the specified resource.
     */
public function show($id)
{
    $surat = SuratPindahSiswa::findOrFail($id);

    // Tampilkan view detail surat pindah
    return view('staff_tu.surat.surat_pindah.show', compact('surat'));
}


    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $surat = SuratPindahSiswa::findOrFail($id);
    return view('staff_tu.surat.surat_pindah.edit', compact('surat'));
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $surat = SuratPindahSiswa::findOrFail($id);

    $surat->update($request->all());

    return redirect()
        ->route('staff_tu.surat.surat-pindah.index')
        ->with('success', 'Surat berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $surat = SuratPindahSiswa::findOrFail($id);
    $surat->delete();

    return redirect()
        ->route('staff_tu.surat.surat-pindah.index')
        ->with('success', 'Surat berhasil dihapus');
}


    public function cetak($id)
{
    $surat = \App\Models\Tatausaha\SuratPindahSiswa::findOrFail($id);

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'staff_tu.surat.surat_pindah.cetak',
        compact('surat')
    );

    return $pdf->stream('surat_pindah.pdf');
}

}
