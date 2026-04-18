<?php

namespace App\Http\Controllers\Tatausaha;

use App\Http\Controllers\Controller;
use App\Models\Tatausaha\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    // =====================
    // FILE HELPERS
    // =====================

    private function uploadLampiran($file)
    {
        return $file->store('lampiran_surat', 'public');
    }

    private function deleteLampiran($filename)
    {
        if ($filename && Storage::disk('public')->exists('lampiran_surat/' . $filename)) {
            Storage::disk('public')->delete('lampiran_surat/' . $filename);
        }
    }

    // =====================
    // CRUD
    // =====================

    public function index(Request $request)
    {
        $query = SuratKeluar::query()->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $suratKeluar = $query->paginate(10)->withQueryString();

        // Hitung per status untuk badge
        $countDraf     = SuratKeluar::draf()->count();
        $countTerkirim = SuratKeluar::terkirim()->count();
        $countArsip    = SuratKeluar::arsip()->count();

        return view('staff_tu.surat.surat_keluar.index', compact(
            'suratKeluar',
            'countDraf',
            'countTerkirim',
            'countArsip'
        ));
    }

    public function create()
    {
        return view('staff_tu.surat.surat_keluar.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat'    => 'required|string|max:255|unique:surat_keluar,nomor_surat',
            'tanggal_surat'  => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_surat',
            'tujuan'         => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'jenis'          => 'nullable|string|max:255',
            'isi'            => 'nullable|string',
            'lampiran'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'penandatangan'  => 'nullable|string|max:255',
            'keterangan'     => 'nullable|string',
            'status'         => 'required|in:Draf,Terkirim,Arsip',
        ]);

        if ($request->hasFile('lampiran')) {
            $path = $this->uploadLampiran($request->file('lampiran'));
            $validated['lampiran'] = basename($path);
        }

        SuratKeluar::create($validated);

        return redirect()
            ->route('staff_tu.surat_keluar.index')
            ->with('success', 'Surat keluar berhasil ditambahkan');
    }

    public function show(SuratKeluar $suratKeluar)
    {
        return view('staff_tu.surat.surat_keluar.show', compact('suratKeluar'));
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        // Surat ARSIP tidak bisa diedit
        if ($suratKeluar->isArsip()) {
            return redirect()
                ->route('staff_tu.surat_keluar.show', $suratKeluar)
                ->with('error', 'Surat yang sudah diarsipkan tidak dapat diedit');
        }

        return view('staff_tu.surat.surat_keluar.edit', compact('suratKeluar'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        // Surat ARSIP tidak bisa diupdate
        if ($suratKeluar->isArsip()) {
            return redirect()
                ->route('staff_tu.surat_keluar.show', $suratKeluar)
                ->with('error', 'Surat yang sudah diarsipkan tidak dapat diedit');
        }

        $validated = $request->validate([
            'nomor_surat'    => 'required|string|max:255|unique:surat_keluar,nomor_surat,' . $suratKeluar->id,
            'tanggal_surat'  => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_surat',
            'tujuan'         => 'required|string|max:255',
            'perihal'        => 'required|string|max:255',
            'jenis'          => 'nullable|string|max:255',
            'isi'            => 'nullable|string',
            'lampiran'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'penandatangan'  => 'nullable|string|max:255',
            'keterangan'     => 'nullable|string',
            'status'         => 'required|in:Draf,Terkirim,Arsip',
        ]);

        if ($request->hasFile('lampiran')) {
            $this->deleteLampiran($suratKeluar->lampiran);
            $path = $this->uploadLampiran($request->file('lampiran'));
            $validated['lampiran'] = basename($path);
        }

        $suratKeluar->update($validated);

        return redirect()
            ->route('staff_tu.surat_keluar.index')
            ->with('success', 'Surat keluar berhasil diperbarui');
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        // Surat ARSIP tidak bisa dihapus
        if ($suratKeluar->isArsip()) {
            return redirect()
                ->route('staff_tu.surat_keluar.index')
                ->with('error', 'Surat yang sudah diarsipkan tidak dapat dihapus');
        }

        $this->deleteLampiran($suratKeluar->lampiran);
        $suratKeluar->delete();

        return redirect()
            ->route('staff_tu.surat_keluar.index')
            ->with('success', 'Surat keluar berhasil dihapus');
    }

    // =====================
    // STATUS TRANSITIONS
    // =====================

    public function kirim(SuratKeluar $suratKeluar)
    {
        if (!$suratKeluar->isDraf()) {
            return redirect()
                ->back()
                ->with('error', 'Hanya surat berstatus Draf yang dapat dikirim');
        }

        $suratKeluar->update(['status' => 'Terkirim']);

        return redirect()
            ->route('staff_tu.surat_keluar.show', $suratKeluar)
            ->with('success', 'Surat berhasil ditandai sebagai Terkirim');
    }

    public function arsip(SuratKeluar $suratKeluar)
    {
        if (!$suratKeluar->isTerkirim()) {
            return redirect()
                ->back()
                ->with('error', 'Hanya surat berstatus Terkirim yang dapat diarsipkan');
        }

        $suratKeluar->update(['status' => 'Arsip']);

        return redirect()
            ->route('staff_tu.surat_keluar.show', $suratKeluar)
            ->with('success', 'Surat berhasil diarsipkan');
    }

    // =====================
    // DOWNLOAD
    // =====================

    public function downloadLampiran(SuratKeluar $suratKeluar)
    {
        if (!$suratKeluar->lampiran) {
            return redirect()->back()->with('error', 'Lampiran tidak tersedia');
        }

        $path = storage_path('app/public/lampiran_surat/' . $suratKeluar->lampiran);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }
}