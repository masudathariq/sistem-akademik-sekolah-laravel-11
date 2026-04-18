<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Model;

class SuratAktifSiswa extends Model
{
    protected $fillable = [
        'nomor_surat',
        'siswa_id',
        'tanggal_surat'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}


