<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Model;

class AbsenSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'rombel_id',
        'guru_id',
        'tahun_ajaran_id',
        'tanggal',
        'status',
        'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Tatausaha\Siswa::class);
    }

    public function rombel()
    {
        return $this->belongsTo(\App\Models\Tatausaha\Rombel::class);
    }

    public function guru()
    {
        return $this->belongsTo(\App\Models\Guru::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(\App\Models\Tatausaha\TahunAjaran::class);
    }
}
