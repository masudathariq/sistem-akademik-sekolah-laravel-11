<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanAbsensi;
use Illuminate\Http\Request;

class PengaturanAbsensiController extends Controller
{
    public function index()
    {
        $setting = PengaturanAbsensi::first();

        return view('admin.absensi.setting', compact('setting'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jam_masuk_mulai' => 'required',
            'jam_masuk_selesai' => 'required',
            'jam_pulang_mulai' => 'required',
            'jam_pulang_selesai' => 'required',
        ]);

        PengaturanAbsensi::updateOrCreate(
            ['id' => 1],
            $data
        );

        return back()->with('success', 'Pengaturan jam absensi berhasil disimpan');
    }
}

