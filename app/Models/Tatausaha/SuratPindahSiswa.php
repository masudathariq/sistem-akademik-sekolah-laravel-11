<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Model;

class SuratPindahSiswa extends Model
{
    protected $fillable = [
    'nomor_surat',
    'tanggal_surat',

    'nama_siswa',
    'tempat_lahir',
    'tanggal_lahir',
    'nis',
    'nisn',
    'kelas',
    'jenis_kelamin',
    'alamat_siswa',

    'nama_wali',
    'pekerjaan_wali',
    'alamat_wali',

    'sekolah_tujuan',
    'alasan_pindah',
];

}
