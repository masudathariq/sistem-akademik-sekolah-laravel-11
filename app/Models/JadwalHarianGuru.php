<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalHarianGuru extends Model
{
    protected $table = 'jadwal_harian_guru';

    protected $fillable = [
        'jadwal_harian_id',
        'guru_id'
    ];

    public function jadwalHarian()
    {
        return $this->belongsTo(
            JadwalHarian::class,
            'jadwal_harian_id'
        );
    }

    
}




