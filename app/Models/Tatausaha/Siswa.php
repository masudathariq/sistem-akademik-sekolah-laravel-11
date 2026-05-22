<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TabunganSiswa;
use App\Models\Tatausaha\Rombel;
use App\Models\Guru\AbsenSiswa;
use App\Models\Guru\RaportTahfidzNilai;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nis',
        'nama_siswa',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'ayah',
        'ibu',
        'wali',
        'rombel_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Hubungan rombel
    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }

    // Rombel aktif (hanya tahun ajaran aktif)
    public function rombelAktif()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id')
                    ->whereHas('tahunAjaran', function($q) {
                        $q->where('is_active', true);
                    });
    }

    public function absenSiswa()
    {
        return $this->hasMany(AbsenSiswa::class, 'siswa_id');
    }

    public function tabungan()
    {
        return $this->hasOne(TabunganSiswa::class, 'siswa_id');
    }

    // Helper
    public function getSudahDitempatkanAttribute()
    {
        return !is_null($this->rombel_id);
    }

    public function suratAktif()
{
    return $this->hasMany(SuratAktifSiswa::class);
}

    public function nilaiTahfidz()
    {
        return $this->hasMany(RaportTahfidzNilai::class, 'siswa_id', 'id');
    }

}
