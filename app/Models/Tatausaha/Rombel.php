<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tatausaha\TahunAjaran;
use App\Models\Tatausaha\RombelKategori;
use App\Models\Tatausaha\Siswa; // ✅ INI YANG KURANG
use App\Models\Guru;


class Rombel extends Model
{
    protected $fillable = [
        'tahun_ajaran_id',
        'tingkat',
        'kode_rombel',
        'nama_rombel',
        'guru_id',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function walikelas()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'rombel_id');
    }

    public function kategori()
    {
        return $this->hasOne(RombelKategori::class, 'rombel_id');
    }

    public function getJumlahSiswaAttribute()
    {
        return $this->siswas()->count();
    }

    public function getNamaLengkapAttribute()
    {
        return "Kelas {$this->tingkat} - {$this->kode_rombel} ({$this->nama_rombel})";
    }
}
