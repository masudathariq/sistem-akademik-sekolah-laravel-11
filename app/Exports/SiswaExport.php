<?php

namespace App\Exports;

use App\Models\Tatausaha\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        // Return collection kosong untuk template
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'NISN',
            'NIS',
            'Nama Siswa',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Ayah',
            'Ibu',
            'Wali',
            'Rombel ID'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk header row
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D1E7DD']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ],
        ];
    }
}