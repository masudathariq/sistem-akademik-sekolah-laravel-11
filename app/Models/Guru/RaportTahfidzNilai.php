<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tatausaha\Siswa;

class RaportTahfidzNilai extends Model
{
    use HasFactory;

    protected $table = 'raport_tahfidz_nilai';
    protected $fillable = ['aspek_id','siswa_id','nilai','keterangan'];

    // Relasi ke aspek
    public function aspek()
    {
        return $this->belongsTo(RaportTahfidzAspek::class, 'aspek_id');
    }

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Setter otomatis keterangan dari nilai
    public function setNilaiAttribute($value)
    {
        $this->attributes['nilai'] = $value;

        $keterangan = match($value) {
            1 => 'Belum baik / Belum berkembang',
            2 => 'Cukup baik / Mulai berkembang',
            3 => 'Baik / Berkembang sesuai harapan',
            4 => 'Sangat baik / Berkembang sangat baik',
            default => null
        };

        $this->attributes['keterangan'] = $keterangan;
    }
}
