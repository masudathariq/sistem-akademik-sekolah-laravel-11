<?php

// app/Models/RombelKategori.php
namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Model;

class RombelKategori extends Model
{
    protected $table = 'rombel_kategori';

    protected $fillable = [
        'rombel_id',
        'kategori',
    ];

public function rombel()
{
    return $this->belongsTo(Rombel::class, 'rombel_id');
}

}
