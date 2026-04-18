<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bendahara\KoreksiHadir;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nuptk',
        'nbm',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'tmt',
        'jabatan',
        'pendidikan_terakhir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalGuru()
    {
        return $this->hasMany(JadwalGuru::class, 'guru_id');
    }
    public function jadwalHarianGuru()
    {
        return $this->hasMany(JadwalHarianGuru::class);
    }

    // Jika tabel absensi bernama "absensis" atau "absensi" dan punya "guru_id"
    // Relasi ke absensi
    public function absensi()
    {
        return $this->hasMany(\App\Models\AbsensiGuru::class, 'guru_id', 'id');
    }


    public function koreksiHadir()
    {
        return $this->hasMany(KoreksiHadir::class);
    }
}
