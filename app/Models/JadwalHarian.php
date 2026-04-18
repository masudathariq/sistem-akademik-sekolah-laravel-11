<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalHarian extends Model
{
    protected $table = 'jadwal_harian';

    protected $fillable = [
        'tanggal',
        'hari',
        'mode',
        'keterangan'
    ];

    public function gurus()
    {
        return $this->belongsToMany(
            Guru::class,
            'jadwal_harian_guru'
        );
    }
    
}



