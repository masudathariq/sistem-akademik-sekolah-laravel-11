<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use App\Models\TabunganSiswa;
use App\Models\User;
use App\Models\Tatausaha\Siswa;

class TabunganTransaksi extends Model
{
    protected $table = 'tabungan_transaksi';

    protected $fillable = [
        'tabungan_siswa_id',
        'tanggal',
        'jenis',
        'nominal',
        'keterangan',
        'petugas_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
    ];

    public function tabunganSiswa(): BelongsTo
    {
        return $this->belongsTo(TabunganSiswa::class, 'tabungan_siswa_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function siswa(): HasOneThrough
    {
        return $this->hasOneThrough(
            Siswa::class,
            TabunganSiswa::class,
            'id', // FK pada tabel tabungan_siswa
            'id', // FK pada tabel siswa
            'tabungan_siswa_id', // FK pada tabel tabungan_transaksi
            'siswa_id' // FK pada tabel tabungan_siswa
        );
    }
}