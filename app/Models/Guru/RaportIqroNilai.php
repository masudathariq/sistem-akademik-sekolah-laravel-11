<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tatausaha\Siswa;

class RaportIqroNilai extends Model
{
    use HasFactory;

    protected $table = 'raport_iqro_nilai';
    protected $fillable = ['aspek_id', 'siswa_id', 'nilai', 'keterangan'];

    public function aspek()
    {
        return $this->belongsTo(RaportIqroAspek::class, 'aspek_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function setNilaiAttribute($value)
    {
        $this->attributes['nilai'] = $value;

        $keterangan = match ($value) {
            1 => 'Belum baik / Belum berkembang',
            2 => 'Cukup baik / Mulai berkembang',
            3 => 'Baik / Berkembang sesuai harapan',
            4 => 'Sangat baik / Berkembang sangat baik',
            default => null,
        };

        $this->attributes['keterangan'] = $keterangan;
    }
}
