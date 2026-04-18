<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bendahara\SettingGajiTransport;

class SettingGajiTransportController extends Controller
{
    public function index()
    {
        $setting = SettingGajiTransport::first();
        return view('bendahara.setting-transport.index', compact('setting'));
    }

    public function edit()
    {
        $setting = SettingGajiTransport::first();
        return view('bendahara.setting-transport.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'transport_per_hari' => 'required|numeric|min:0',
        ]);

        $setting = SettingGajiTransport::first();
        if (!$setting) {
            $setting = new SettingGajiTransport();
        }

        $setting->transport_per_hari = $request->transport_per_hari;
        $setting->save();

        return redirect()->route('bendahara.setting-transport.index')
                         ->with('success', 'Gaji transport berhasil diupdate');
    }
}

