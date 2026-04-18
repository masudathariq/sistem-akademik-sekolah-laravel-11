<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportTahfidzUjian;
use App\Models\Guru\RaportTahfidzSiswaGuru;
use App\Models\Tatausaha\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportTahfidzUjianController extends Controller
{
    // Form input nilai ujian
    public function create()
    {
        $guru_id = Auth::id();

        $siswa_ids = RaportTahfidzSiswaGuru::where('guru_id', $guru_id)
            ->pluck('siswa_id')
            ->toArray();

        $siswas = Siswa::whereIn('id', $siswa_ids)
            ->orderBy('nama_siswa')
            ->get();

        // Ambil semua nilai ujian yang sudah ada
        $nilai_ujian = RaportTahfidzUjian::whereIn('siswa_id', $siswa_ids)
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('nama_ujian') // group berdasarkan nama ujian
            ->map(function ($group) {
                return $group->keyBy('siswa_id'); // key by siswa_id
            });

        // Ambil nama ujian terakhir untuk ditampilkan default di form
        $nama_ujian_terakhir = RaportTahfidzUjian::whereIn('siswa_id', $siswa_ids)
            ->latest()
            ->value('nama_ujian');

        return view('guru.raport_tahfidz.ujian.create', compact('siswas', 'nilai_ujian', 'nama_ujian_terakhir'));
    }


    // Simpan atau update nilai ujian
    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'siswa_id' => 'required|array',
            'nilai_ujian' => 'required|array',
            'nilai_ujian.*' => 'required|integer|min:1|max:100',
        ]);

        foreach ($request->siswa_id as $index => $siswa_id) {
            RaportTahfidzUjian::updateOrCreate(
                [
                    'siswa_id' => $siswa_id,
                    'nama_ujian' => $request->nama_ujian
                ],
                [
                    'nilai_ujian' => $request->nilai_ujian[$index]
                ]
            );
        }

        return redirect()->route('guru.raport-ujian.create')
            ->with('success', 'Nilai ujian berhasil disimpan.');
    }
}
