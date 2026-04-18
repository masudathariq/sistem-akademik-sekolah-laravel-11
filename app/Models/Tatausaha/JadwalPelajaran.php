<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;
use App\Models\Tatausaha\Rombel;
use App\Models\Tatausaha\MataPelajaran;


class JadwalPelajaran extends Model
{
    protected $fillable = [
        'guru_id',
        'rombel_id',
        'mata_pelajaran_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'tahun_ajaran',
        'semester',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}