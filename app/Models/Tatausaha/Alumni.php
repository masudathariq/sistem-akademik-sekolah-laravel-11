<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tatausaha\Siswa;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumnis';

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
        'tahun_lulus',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function siswa()
{
    return $this->belongsTo(Siswa::class, 'nisn', 'nisn'); // asumsi NISN sebagai penghubung
}

}
