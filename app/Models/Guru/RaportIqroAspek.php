<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportIqroAspek extends Model
{
    use HasFactory;

    protected $table = 'raport_iqro_aspeks';
    protected $fillable = ['nama_aspek'];

    public function nilai()
    {
        return $this->hasMany(RaportIqroNilai::class, 'aspek_id');
    }
}
