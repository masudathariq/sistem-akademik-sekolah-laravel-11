<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;

class Penambahan extends Model
{
    protected $table = 'penambahans';

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
