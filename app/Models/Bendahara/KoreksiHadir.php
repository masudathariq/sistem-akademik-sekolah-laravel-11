<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;

class KoreksiHadir extends Model
{
    protected $table = 'koreksi_hadir';

    protected $fillable = [
        'guru_id',
        'bulan',
        'tahun',
        'jumlah',
        'keterangan',
    ];

    

    // relasi ke guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // app/Models/KoreksiHadir.php

public static function getHadirFinal($guruId, $bulan, $tahun)
    {
        // Hitung hadir asli dari tabel absensi_guru
        $hadirAsli = DB::table('absensi_guru')
            ->where('guru_id', $guruId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'hadir')
            ->count();
        
        // Ambil koreksi (+/-) dari kolom 'jumlah'
        $koreksi = self::where('guru_id', $guruId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->value('jumlah') ?? 0; // ← Menggunakan 'jumlah' sesuai migration
        
        // Hadir final = max(0, hadir_asli + koreksi)
        return max(0, $hadirAsli + $koreksi);
    }
    



}
