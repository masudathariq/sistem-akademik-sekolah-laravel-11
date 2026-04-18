<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportTahfidzHafalan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'raport_tahfidz_hafalan';

    // Field yang boleh diisi massal
    protected $fillable = [
        'siswa_id',
        'surah_terakhir',
        'ayat_terakhir',
        'surah_lanjut',
        'ayat_lanjut',
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(\App\Models\Tatausaha\Siswa::class, 'siswa_id');
    }
}
