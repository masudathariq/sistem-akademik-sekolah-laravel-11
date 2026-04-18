<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JadwalGuru;

class Hari extends Model
{
    protected $table = 'hari';

    protected $fillable = ['nama_hari'];

    public function jadwalGuru()
    {
        return $this->hasMany(JadwalGuru::class, 'hari_id');
    }
}

