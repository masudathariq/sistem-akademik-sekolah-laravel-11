<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;

class Pengurangan extends Model
{
    protected $fillable = [
        'judul',
        'jumlah',
        'tipe',
        'guru_id',
    ];

    protected $casts = [
        'guru_id' => 'array',
    ];
}


