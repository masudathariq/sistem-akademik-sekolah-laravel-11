<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TabunganTransaksi;
use App\Models\Tatausaha\Siswa;

class TabunganSiswa extends Model
{
    protected $table = 'tabungan_siswa';

    protected $fillable = [
        'siswa_id',
        'saldo',
    ];

    protected $casts = [
        'saldo' => 'decimal:2',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(TabunganTransaksi::class);
    }
}
