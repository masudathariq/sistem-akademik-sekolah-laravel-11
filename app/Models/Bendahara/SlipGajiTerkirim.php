<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;



class SlipGajiTerkirim extends Model
{
    protected $table = 'slip_gaji_terkirim';

    protected $fillable = [
        'guru_id',
        'bulan',
        'tahun',
        'gaji_pokok',
        'hadir_asli',
        'koreksi',
        'hadir_final',
        'transport',
        // 🔥 TAMBAHKAN INI
        'tahfidz',
        'hadir_tahfidz',
        'tarif_tahfidz',
        'total_penambahan',
        'total_pengurangan',
        'total_gaji',
        'detail_penambahan',
        'detail_pengurangan',
        'sudah_dibaca',
        'dibaca_pada',
    ];

    protected $casts = [
        'detail_penambahan' => 'array',
        'detail_pengurangan' => 'array',
        'sudah_dibaca' => 'boolean',
        'dibaca_pada' => 'datetime',
        'gaji_pokok' => 'decimal:2',
        'transport' => 'decimal:2',
        'tahfidz' => 'decimal:2',          // 🔥 TAMBAH
        'tarif_tahfidz' => 'decimal:2',    // 🔥 TAMBAH
        'total_penambahan' => 'decimal:2',
        'total_pengurangan' => 'decimal:2',
        'total_gaji' => 'decimal:2',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Helper: Tandai sebagai sudah dibaca
    public function tandaiDibaca()
    {
        if (!$this->sudah_dibaca) {
            $this->update([
                'sudah_dibaca' => true,
                'dibaca_pada' => now(),
            ]);
        }
    }
}
