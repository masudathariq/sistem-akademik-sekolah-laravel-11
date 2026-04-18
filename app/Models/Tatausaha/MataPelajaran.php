<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
    ];
}