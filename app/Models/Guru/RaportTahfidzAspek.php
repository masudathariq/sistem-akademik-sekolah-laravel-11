<?php


namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportTahfidzAspek extends Model
{
    use HasFactory;

    protected $table = 'raport_tahfidz_aspeks';
    protected $fillable = ['nama_aspek'];

    // Relasi ke nilai
    public function nilai()
    {
        return $this->hasMany(RaportTahfidzNilai::class, 'aspek_id');
    }
}

