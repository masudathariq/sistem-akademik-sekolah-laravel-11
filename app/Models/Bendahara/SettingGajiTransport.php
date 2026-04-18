<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;

class SettingGajiTransport extends Model
{
    protected $table = 'setting_gaji_transports'; // pastikan sesuai nama tabel
    protected $fillable = ['transport_per_hari']; // agar bisa mass-assignment
}
