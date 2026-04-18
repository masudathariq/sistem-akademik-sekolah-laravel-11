<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;

class TahfidzGuru extends Model
{
    protected $table = 'tahfidz_guru';

    protected $fillable = [
        'guru_id',
        'bulan',
        'tahun',
        'jumlah_hadir',
        'total'
    ];

    public function guru()
    {
        return $this->belongsTo(\App\Models\Guru::class);
    }
}

