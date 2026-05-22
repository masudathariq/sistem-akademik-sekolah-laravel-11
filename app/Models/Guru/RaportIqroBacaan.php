<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportIqroBacaan extends Model
{
    use HasFactory;

    protected $table = 'raport_iqro_bacaan';
    protected $fillable = [
        'siswa_id',
        'iqro_terakhir',
        'halaman_terakhir',
        'iqro_lanjut',
        'halaman_lanjut',
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Tatausaha\Siswa::class, 'siswa_id');
    }
}
