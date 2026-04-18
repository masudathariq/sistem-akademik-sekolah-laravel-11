<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bendahara\SlipGajiTerkirim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruSlipGajiController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru; // Asumsi relasi user->guru sudah ada

        $slipGaji = SlipGajiTerkirim::where('guru_id', $guru->id)
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->paginate(12);

        return view('guru.slip-gaji.index', compact('slipGaji'));
    }

    public function show($id)
    {
        $guru = Auth::user()->guru;

        $slip = SlipGajiTerkirim::where('id', $id)
            ->where('guru_id', $guru->id)
            ->firstOrFail();

        // Tandai sebagai sudah dibaca
        $slip->tandaiDibaca();

        $transportPerHari = \Illuminate\Support\Facades\DB::table('setting_gaji_transports')
            ->latest()
            ->value('transport_per_hari') ?? 0;

        return view('guru.slip-gaji.show', compact('slip', 'transportPerHari'));
    }

     public function print($id)
    {
        $guru = Auth::user()->guru;

        $slip = SlipGajiTerkirim::with('guru')
            ->where('id', $id)
            ->where('guru_id', $guru->id)
            ->firstOrFail();

        $transportPerHari = DB::table('setting_gaji_transports')
            ->latest()
            ->value('transport_per_hari') ?? 0;

        return view('guru.slip-gaji.print', compact(
            'slip',
            'transportPerHari'
        ));
    }
}
