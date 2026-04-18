<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportTahfidzUjian extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'raport_tahfidz_ujian';

    // Field yang boleh diisi massal
    protected $fillable = [
        'siswa_id',
        'nilai_ujian',
        'nama_ujian',
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(\App\Models\Tatausaha\Siswa::class, 'siswa_id');
    }
}
