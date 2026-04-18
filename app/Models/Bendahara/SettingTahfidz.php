<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;

class SettingTahfidz extends Model
{
    protected $table = 'setting_tahfidz';

    protected $fillable = [
        'harga_per_hadir'
    ];
}
