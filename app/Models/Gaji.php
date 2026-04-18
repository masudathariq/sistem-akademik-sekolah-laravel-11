<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'jumlah_jam',
        'tarif_per_jam',
        'gaji_pokok',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
        // Tambahkan ini supaya resource route bisa resolve {gaji_pokok} otomatis
    public function getRouteKeyName()
    {
        return 'id'; // default, bisa juga 'gaji_pokok' tapi jangan
    }
}



