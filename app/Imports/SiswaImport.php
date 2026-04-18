<?php

namespace App\Imports;

use App\Models\Tatausaha\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{
    public function model(array $row)
    {
        // Skip jika NISN atau NIS kosong
        if (empty($row['nisn']) || empty($row['nis'])) {
            return null;
        }

        // Ambil jenis kelamin dari berbagai kemungkinan key
        $jenisKelamin = $row['jenis_kelamin_lp'] 
                     ?? $row['jenis_kelamin_l_p'] 
                     ?? $row['jenis_kelamin'] 
                     ?? null;

        // Ambil tanggal lahir dari berbagai kemungkinan key
        $tanggalLahir = $row['tanggal_lahir_yyyy_mm_dd'] 
                     ?? $row['tanggal_lahir'] 
                     ?? null;

        return new Siswa([
            'nisn' => trim($row['nisn']),
            'nis' => trim($row['nis']),
            'nama_siswa' => trim($row['nama_siswa']),
            'tempat_lahir' => trim($row['tempat_lahir']),
            'tanggal_lahir' => $this->parseTanggal($tanggalLahir),
            'jenis_kelamin' => trim($jenisKelamin),
            'alamat' => trim($row['alamat']),
            'ayah' => trim($row['ayah']),
            'ibu' => trim($row['ibu']),
            'wali' => !empty($row['wali']) ? trim($row['wali']) : null,
            'rombel_id' => !empty($row['rombel_id']) ? trim($row['rombel_id']) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'nisn' => 'required',
            'nis' => 'required',
            'nama_siswa' => 'required',
        ];
    }

    private function parseTanggal($value)
    {
        if (empty($value)) return null;

        // Angka Excel (serial date)
        if (is_numeric($value)) {
            try {
                return Carbon::instance(Date::excelToDateTimeObject($value))->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        // Format Y-m-d (2010-05-15)
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return $value;
        }

        // Format d-m-Y (15-05-2010)
        if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $value)) {
            try {
                return Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        // Format d/m/Y (15/05/2010)
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
            try {
                return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        // Last resort: auto parse
        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}