<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tatausaha\Rombel;



class TahunAjaran extends Model
{
    // tabelnya sudah sesuai nama asli
    protected $table = 'tahun_ajarans';

    // mass assignment
    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'is_active',
    ];

    // casting supaya is_active otomatis jadi boolean
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // helper
    public static function aktif()
    {
        return self::where('is_active', true)->first();
    }


    public function rombels()
    {
        return $this->hasMany(Rombel::class);
    }
}
