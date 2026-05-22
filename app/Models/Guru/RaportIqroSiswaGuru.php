<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportIqroSiswaGuru extends Model
{
    use HasFactory;

    protected $table = 'raport_iqro_siswa_guru';
    protected $fillable = [
        'guru_id',
        'siswa_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Tatausaha\Siswa::class, 'siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo(\App\Models\User::class, 'guru_id');
    }
}
