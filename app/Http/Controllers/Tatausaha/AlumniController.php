<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tatausaha\Alumni;

class AlumniController extends Controller
{
    /**
     * Tampilkan semua alumni
     */
    public function index()
    {

        $alumnis = Alumni::orderBy('tahun_lulus', 'desc')
                          ->orderBy('nama_siswa')
                          ->get();

        return view('staff_tu.alumni.index', compact('alumnis'));
    }

    /**
     * (Opsional) Bisa tambahkan show detail alumni
     */
    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);

        return view('staff_tu.alumni.show', compact('alumni'));
    }

    /**
     * Hapus data alumni
     */

public function destroy($id)
{
    $alumni = Alumni::findOrFail($id);
    $alumni->delete();

    return redirect()->route('staff_tu.alumni.index')
                     ->with('success', 'Data alumni berhasil dihapus.');
}


}
