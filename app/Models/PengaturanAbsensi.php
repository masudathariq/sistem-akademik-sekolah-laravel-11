<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAbsensi extends Model
{
    protected $table = 'pengaturan_absensi';

    protected $fillable = [
        'jam_masuk_mulai',
        'jam_masuk_selesai',
        'jam_pulang_mulai',
        'jam_pulang_selesai',
    ];
}

