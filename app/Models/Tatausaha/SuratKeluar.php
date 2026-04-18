<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_keluar',
        'tujuan',
        'perihal',
        'jenis',
        'isi',
        'lampiran',
        'penandatangan',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tanggal_surat'  => 'date',
        'tanggal_keluar' => 'date',
    ];

    // =====================
    // ACCESSORS
    // =====================

    public function getLampiranUrlAttribute()
    {
        if ($this->lampiran) {
            return asset('storage/lampiran_surat/' . $this->lampiran);
        }
        return null;
    }

    public function getLampiranNamaAttribute()
    {
        if ($this->lampiran) {
            return basename($this->lampiran);
        }
        return null;
    }

    // =====================
    // HELPERS
    // =====================

    public function isDraf(): bool
    {
        return $this->status === 'Draf';
    }

    public function isTerkirim(): bool
    {
        return $this->status === 'Terkirim';
    }

    public function isArsip(): bool
    {
        return $this->status === 'Arsip';
    }

    // =====================
    // SCOPES
    // =====================

    public function scopeDraf($query)
    {
        return $query->where('status', 'Draf');
    }

    public function scopeTerkirim($query)
    {
        return $query->where('status', 'Terkirim');
    }

    public function scopeArsip($query)
    {
        return $query->where('status', 'Arsip');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nomor_surat', 'like', "%{$search}%")
                ->orWhere('tujuan', 'like', "%{$search}%")
                ->orWhere('perihal', 'like', "%{$search}%");
        });
    }
}