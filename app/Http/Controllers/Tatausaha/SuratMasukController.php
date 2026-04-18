<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Tatausaha\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = SuratMasuk::query()->orderBy('created_at', 'desc');

    // Filter berdasarkan status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter berdasarkan jenis
    if ($request->filled('jenis')) {
        $query->where('jenis', $request->jenis);
    }

    // Pencarian
    if ($request->filled('search')) {
        $query->search($request->search);
    }

    $suratMasuk = $query->paginate(10)->withQueryString();

    // =============================
    // STATUS CARD (RINGKASAN DATA)
    // =============================

    $totalSurat = SuratMasuk::count();
    $totalBelumDibaca = SuratMasuk::where('status', 'Belum Dibaca')->count();
    $totalSudahDibaca = SuratMasuk::where('status', 'Sudah Dibaca')->count();

    return view('staff_tu.surat.surat_masuk.index', compact(
        'suratMasuk',
        'totalSurat',
        'totalBelumDibaca',
        'totalSudahDibaca'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff_tu.surat.surat_masuk.create');
    }

    /**
     * Upload lampiran file
     */
    private function uploadLampiran($file)
    {
        return $file->store('surat_masuk', 'public');
    }

    /**
     * Delete lampiran file
     */
    private function deleteLampiran($filename)
    {
        if ($filename && Storage::disk('public')->exists('surat_masuk/' . $filename)) {
            Storage::disk('public')->delete('surat_masuk/' . $filename);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk,nomor_surat',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'isi' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // max 5MB
            'diteruskan_ke' => 'nullable|string|max:255',
            'status' => 'required|in:Belum Dibaca,Sudah Dibaca',
            'catatan' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('lampiran')) {
            $path = $this->uploadLampiran($request->file('lampiran'));
            $validated['lampiran'] = basename($path);
        }

        SuratMasuk::create($validated);

        return redirect()
            ->route('staff_tu.surat_masuk.index')
            ->with('success', 'Surat masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratMasuk $suratMasuk)
    {
        // Update status menjadi "Sudah Dibaca" ketika surat dibuka
        if ($suratMasuk->status === 'Belum Dibaca') {
            $suratMasuk->update(['status' => 'Sudah Dibaca']);
        }

        return view('staff_tu.surat.surat_masuk.show', compact('suratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('staff_tu.surat.surat_masuk.edit', compact('suratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk,nomor_surat,' . $suratMasuk->id,
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'isi' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'diteruskan_ke' => 'nullable|string|max:255',
            'status' => 'required|in:Belum Dibaca,Sudah Dibaca',
            'catatan' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('lampiran')) {
            // Hapus file lama
            $this->deleteLampiran($suratMasuk->lampiran);
            
            // Upload file baru
            $path = $this->uploadLampiran($request->file('lampiran'));
            $validated['lampiran'] = basename($path);
        }

        $suratMasuk->update($validated);

        return redirect()
            ->route('staff_tu.surat_masuk.index')
            ->with('success', 'Surat masuk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        // Hapus file lampiran jika ada
        $this->deleteLampiran($suratMasuk->lampiran);

        $suratMasuk->delete();

        return redirect()
            ->route('staff_tu.surat_masuk.index')
            ->with('success', 'Surat masuk berhasil dihapus');
    }

    /**
     * Download lampiran surat
     */
public function downloadLampiran(SuratMasuk $surat_masuk)
{
    if (!$surat_masuk->lampiran) {
        return back()->with('error', 'Lampiran tidak tersedia');
    }

    $path = storage_path('app/public/surat_masuk/' . $surat_masuk->lampiran);

    if (!file_exists($path)) {
        return back()->with('error', 'File tidak ditemukan');
    }

    return response()->download(
        $path,
        $surat_masuk->lampiran_nama ?? $surat_masuk->lampiran
    );
}


}