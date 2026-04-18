<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru\RaportTahfidzAspek;
use App\Models\Guru\RaportTahfidzNilai;
use App\Models\Guru\RaportTahfidzHafalan;
use App\Models\Guru\RaportTahfidzUjian;
use App\Models\Guru\RaportTahfidzSiswaGuru;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RaportTahfidzController extends Controller
{
    // =========================================================
    // INDEX — Daftar semua siswa
    // =========================================================
    public function index()
    {
        $guru_id = Auth::id();

        $siswas = RaportTahfidzSiswaGuru::with('siswa')
            ->where('guru_id', $guru_id)
            ->get()
            ->pluck('siswa');

        if ($siswas->isEmpty()) {
            return view('guru.raport_tahfidz.index', [
                'siswas'     => collect(),
                'aspeks'     => collect(),
                'nilai'      => [],
                'keterangan' => [],
                'hafalan'    => [],
                'ujian'      => [],
            ]);
        }

        $aspeks    = RaportTahfidzAspek::orderBy('id')->get();
        $siswa_ids = $siswas->pluck('id')->toArray();
        $nilai_raw = RaportTahfidzNilai::whereIn('siswa_id', $siswa_ids)->get();

        $keterangan_map = [
            1 => 'Belum baik / Belum berkembang',
            2 => 'Cukup baik / Mulai berkembang',
            3 => 'Baik / Berkembang sesuai harapan',
            4 => 'Sangat baik / Berkembang sangat baik',
        ];

        $nilai      = [];
        $keterangan = [];

        foreach ($nilai_raw as $n) {
            $nilai[$n->siswa_id][$n->aspek_id]      = $n->nilai;
            $keterangan[$n->siswa_id][$n->aspek_id] = $keterangan_map[$n->nilai] ?? '-';
        }

        $hafalan = RaportTahfidzHafalan::whereIn('siswa_id', $siswa_ids)
            ->get()
            ->keyBy('siswa_id');

        $ujian = RaportTahfidzUjian::whereIn('siswa_id', $siswa_ids)
            ->get()
            ->groupBy('siswa_id');

        foreach ($ujian as $siswa_id => $ujian_siswa) {
            foreach ($ujian_siswa as $key => $n) {
                $ujian[$siswa_id][$key]->keterangan = $this->keteranganUjian($n->nilai_ujian);
            }
        }

        return view('guru.raport_tahfidz.index', compact(
            'siswas',
            'aspeks',
            'nilai',
            'keterangan',
            'hafalan',
            'ujian'
        ));
    }

    // =========================================================
    // SHOW — Detail lengkap 1 siswa
    // =========================================================
    public function show($siswa_id)
    {
        $data = $this->buildRaportData($siswa_id);
        return view('guru.raport_tahfidz.show', $data);
    }

    // =========================================================
    // CETAK — Preview A4 di browser
    // =========================================================
    public function cetakRaport($siswa_id)
    {
        $data = $this->buildRaportData($siswa_id);
        return view('guru.raport_tahfidz.cetak', $data);
    }

    // =========================================================
    // DOWNLOAD PDF — Generate via DomPDF
    // =========================================================
    public function downloadPdf($siswa_id)
    {
        $data = $this->buildRaportData($siswa_id);

        $pdf = Pdf::loadView('guru.raport_tahfidz.cetak_pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont'          => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false,
                'dpi'                  => 150,
            ]);

        $namaFile = 'Raport_Tahfidz_' . str_replace(' ', '_', $data['siswa']->nama_siswa) . '.pdf';

        return $pdf->download($namaFile);
    }

    // =========================================================
    // PRIVATE: Bangun data raport
    // =========================================================
    private function buildRaportData($siswa_id): array
    {
        $guru_id = Auth::id();

        $siswa = RaportTahfidzSiswaGuru::with('siswa.rombel')
            ->where('guru_id', $guru_id)
            ->where('siswa_id', $siswa_id)
            ->firstOrFail()
            ->siswa;

        $aspeks = RaportTahfidzAspek::all();

        $keterangan_map = [
            1 => 'Belum baik',
            2 => 'Cukup baik',
            3 => 'Baik',
            4 => 'Sangat baik',
        ];

        $nilai      = [];
        $keterangan = [];

        foreach ($aspeks as $aspek) {
            $record = RaportTahfidzNilai::where('siswa_id', $siswa->id)
                ->where('aspek_id', $aspek->id)
                ->first();

            $nilai[$aspek->id]      = $record->nilai ?? 0;
            $keterangan[$aspek->id] = $keterangan_map[$nilai[$aspek->id]] ?? '-';
        }

        $hafalan    = RaportTahfidzHafalan::where('siswa_id', $siswa->id)->first();
        // Hitung rata-rata nilai aspek
        $nilaiValues = array_filter($nilai, fn($v) => $v > 0); // abaikan yang 0
        $rataRata = count($nilaiValues) > 0 ? array_sum($nilaiValues) / count($nilaiValues) : 0;

        // Konversi rata-rata (skala 1-4) ke persentase
        $pencapaian = round(($rataRata / 4) * 100);

        // Status berdasarkan rata-rata
        if ($rataRata >= 3.5) {
            $status = 'Berkembang Sangat Baik';
        } elseif ($rataRata >= 2.5) {
            $status = 'Berkembang Sesuai Harapan';
        } elseif ($rataRata >= 1.5) {
            $status = 'Mulai Berkembang';
        } elseif ($rataRata > 0) {
            $status = 'Belum Berkembang';
        } else {
            $status = '-';
        }

        $ujian = RaportTahfidzUjian::where('siswa_id', $siswa->id)->get();
        foreach ($ujian as $u) {
            $u->keterangan = $this->keteranganUjian($u->nilai_ujian);
        }

        // Susun kalimat per aspek
        $kalimatAspek = '';
        foreach ($aspeks as $aspek) {
            $namaAspek   = $aspek->nama_aspek;
            $ket         = $keterangan[$aspek->id] ?? '-';
            $kalimatAspek .= "Pada aspek {$namaAspek}, Ananda berada pada kategori \"{$ket}\". ";
        }

        $catatan = $hafalan
            ? "Ananda {$siswa->nama_siswa} menunjukkan perkembangan yang menggembirakan dalam program Tahfidz Al-Qur'an dengan pencapaian pada kategori \"{$status}\". {$kalimatAspek}Saat ini, Ananda telah berhasil menyelesaikan sampai Surah {$hafalan->surah_terakhir} Ayat {$hafalan->ayat_terakhir} dan diharapkan dapat meneruskan hingga Surah {$hafalan->surah_lanjut} Ayat {$hafalan->ayat_lanjut} pada periode berikutnya. Dukungan orang tua/wali sangat penting agar Ananda konsisten muraja'ah setiap hari, sehingga keberhasilan program Tahfidz dapat tercapai dengan lancar dan berkualitas. Semoga Allah SWT senantiasa memudahkan Ananda dalam menghafal, memahami, dan mengamalkan Al-Qur'an. Aamiin."
            : null;


        $namaGuru = Auth::user()->name ?? '-';
        $nuptk    = Auth::user()->guru->nuptk ?? '-';

        return compact(
            'siswa',
            'aspeks',
            'nilai',
            'keterangan',
            'hafalan',
            'pencapaian',
            'status',
            'ujian',
            'catatan',
            'namaGuru',
            'nuptk'
        );
    }

    // =========================================================
    // PRIVATE: Konversi nilai ujian ke keterangan
    // =========================================================
    private function keteranganUjian($nilai): string
    {
        if ($nilai >= 1  && $nilai <= 75)  return 'Cukup';
        if ($nilai >= 76 && $nilai <= 80)  return 'Baik';
        if ($nilai >= 81 && $nilai <= 100) return 'Sangat Baik';
        return '-';
    }
}
