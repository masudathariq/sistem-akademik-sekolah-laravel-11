<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportIqroUjian extends Model
{
    use HasFactory;

    protected $table = 'raport_iqro_ujian';
    protected $fillable = [
        'siswa_id',
        'nama_ujian',
        'nilai_ujian',
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Tatausaha\Siswa::class, 'siswa_id');
    }
}
