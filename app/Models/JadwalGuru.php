<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalGuru extends Model
{
    protected $table = 'jadwal_guru';

    protected $fillable = [
        'hari_id',
        'guru_id'
    ];

    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}

