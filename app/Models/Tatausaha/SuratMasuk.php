<?php

namespace App\Models\Tatausaha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'pengirim',
        'perihal',
        'jenis',
        'isi',
        'lampiran',
        'diteruskan_ke',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_diterima' => 'date',
    ];

    // Accessor untuk URL lampiran
    public function getLampiranUrlAttribute()
    {
        if ($this->lampiran) {
            return Storage::url('lampiran/surat_masuk/' . $this->lampiran);
        }
        return null;
    }

    // Accessor untuk nama file lampiran tanpa path
    public function getLampiranNamaAttribute()
    {
        if ($this->lampiran) {
            return basename($this->lampiran);
        }
        return null;
    }

    // Scope untuk filter berdasarkan status
    public function scopeBelumDibaca($query)
    {
        return $query->where('status', 'Belum Dibaca');
    }

    public function scopeSudahDibaca($query)
    {
        return $query->where('status', 'Sudah Dibaca');
    }

    // Scope untuk filter berdasarkan jenis
    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nomor_surat', 'like', "%{$search}%")
                ->orWhere('pengirim', 'like', "%{$search}%")
                ->orWhere('perihal', 'like', "%{$search}%");
        });
    }
}