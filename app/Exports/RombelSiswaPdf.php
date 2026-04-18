<?php

namespace App\Exports;

use App\Models\Tatausaha\Rombel;
use Barryvdh\DomPDF\Facade\Pdf;

class RombelSiswaPdf
{
    protected $rombel;

    public function __construct($rombelId)
    {
        $this->rombel = Rombel::with(['siswas', 'walikelas', 'tahunAjaran'])->findOrFail($rombelId);
    }

    public function download()
    {
        $data = [
            'rombel' => $this->rombel,
            'siswas' => $this->rombel->siswas,
            'walikelas' => $this->rombel->walikelas,
            'tahunAjaran' => $this->rombel->tahunAjaran,
            'tanggalCetak' => now()->format('d F Y'),
        ];

        $pdf = Pdf::loadView('exports.rombel-siswa-pdf', $data)
            ->setPaper('a4', 'landscape');

        $namaFile = 'Siswa_' . str_replace(' ', '_', $this->rombel->nama_lengkap) . '.pdf';

        return $pdf->download($namaFile);
    }

    public function stream()
    {
        $data = [
            'rombel' => $this->rombel,
            'siswas' => $this->rombel->siswas,
            'walikelas' => $this->rombel->walikelas,
            'tahunAjaran' => $this->rombel->tahunAjaran,
            'tanggalCetak' => now()->format('d F Y'),
        ];

        $pdf = Pdf::loadView('exports.rombel-siswa-pdf', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}