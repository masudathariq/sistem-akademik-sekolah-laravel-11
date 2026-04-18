<?php

namespace App\Exports;

use App\Models\Tatausaha\Rombel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RombelSiswaExport implements 
    FromCollection, 
    WithHeadings, 
    WithStyles, 
    WithTitle, 
    WithColumnWidths,
    ShouldAutoSize
{
    protected $rombel;

    public function __construct($rombelId)
    {
        $this->rombel = Rombel::with(['siswas', 'walikelas', 'tahunAjaran'])->findOrFail($rombelId);
    }

    public function collection()
    {
        return $this->rombel->siswas->map(function($siswa, $index) {
            return [
                $index + 1,
                $siswa->nisn,
                $siswa->nis,
                $siswa->nama_siswa,
                $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                $siswa->tempat_lahir,
                \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y'),
                $siswa->alamat,
                $siswa->ayah,
                $siswa->ibu,
                $siswa->wali ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            ['MTs MUHAMMADIYAH 1 NATAR'], // Baris 1
            ['DAFTAR SISWA'], // Baris 2
            [''], // Baris 3 kosong
            ['Rombel: ' . $this->rombel->nama_lengkap], // Baris 4
            ['Wali Kelas: ' . ($this->rombel->walikelas ? $this->rombel->walikelas->nama : '-')], // Baris 5
            ['Tahun Ajaran: ' . $this->rombel->tahunAjaran->tahun_ajaran], // Baris 6
            ['Jumlah Siswa: ' . $this->rombel->siswas->count() . ' siswa'], // Baris 7
            [''], // Baris 8 kosong
            // Baris 9: Header Tabel
            [
                'No',
                'NISN',
                'NIS',
                'Nama Siswa',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Alamat',
                'Nama Ayah',
                'Nama Ibu',
                'Nama Wali',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $totalRows = 9 + $this->rombel->siswas->count();
        
        // ========== MERGE CELLS UNTUK HEADER ==========
        $sheet->mergeCells('A1:K1'); // Nama Sekolah
        $sheet->mergeCells('A2:K2'); // Judul
        $sheet->mergeCells('A4:K4'); // Rombel
        $sheet->mergeCells('A5:K5'); // Wali Kelas
        $sheet->mergeCells('A6:K6'); // Tahun Ajaran
        $sheet->mergeCells('A7:K7'); // Jumlah Siswa
        
        // ========== ROW HEIGHT ==========
        $sheet->getRowDimension(1)->setRowHeight(30);
        $sheet->getRowDimension(2)->setRowHeight(25);
        $sheet->getRowDimension(9)->setRowHeight(22);
        
        return [
            // ========== HEADER SEKOLAH (Baris 1) ==========
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'color' => ['rgb' => '1F2937']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            
            // ========== JUDUL DAFTAR SISWA (Baris 2) ==========
            2 => [
                'font' => [
                    'bold' => true,
                    'size' => 14,
                    'color' => ['rgb' => '374151']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            
            // ========== INFO ROMBEL (Baris 4-7) - SEMUA CENTER ==========
            4 => [
                'font' => ['size' => 11, 'bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            5 => [
                'font' => ['size' => 11],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            6 => [
                'font' => ['size' => 11],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            7 => [
                'font' => ['size' => 11, 'italic' => true, 'color' => ['rgb' => '6B7280']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            
            // ========== HEADER TABEL (Baris 9) ==========
            9 => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563EB']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            
            // ========== DATA SISWA (Baris 10 dst) ==========
            '10:' . $totalRows => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'D1D5DB'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
        
        // ========== ALIGNMENT KOLOM DATA ==========
        // Nomor (center)
        $sheet->getStyle('A10:A' . $totalRows)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
        // NISN, NIS (center)
        $sheet->getStyle('B10:C' . $totalRows)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
        // Jenis Kelamin (center)
        $sheet->getStyle('E10:E' . $totalRows)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
        // Tanggal Lahir (center)
        $sheet->getStyle('G10:G' . $totalRows)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // ========== ZEBRA STRIPING ==========
        for ($row = 10; $row <= $totalRows; $row++) {
            if (($row - 10) % 2 == 0) {
                $sheet->getStyle('A' . $row . ':K' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F9FAFB']
                    ]
                ]);
            }
        }
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // NISN
            'C' => 12,  // NIS
            'D' => 25,  // Nama Siswa
            'E' => 15,  // Jenis Kelamin
            'F' => 18,  // Tempat Lahir
            'G' => 15,  // Tanggal Lahir
            'H' => 35,  // Alamat
            'I' => 20,  // Nama Ayah
            'J' => 20,  // Nama Ibu
            'K' => 20,  // Nama Wali
        ];
    }

    public function title(): string
    {
        return substr($this->rombel->kode_rombel, 0, 31);
    }
}