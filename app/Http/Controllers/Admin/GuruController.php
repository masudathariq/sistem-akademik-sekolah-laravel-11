<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Tampilkan semua data guru
     */
    public function index()
    {
        $gurus = Guru::with('user')->orderBy('nama')->get();

        return view('admin.guru.index', compact('gurus'));
    }

    /**
     * Tampilkan form edit guru
     */
    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * Update data guru
     */
    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nuptk' => 'nullable|string|max:20',
            'nbm' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
            'tmt' => 'nullable|date',
            'jabatan' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100'
        ]);

        $guru->update($validated);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
 * Tampilkan detail guru tertentu untuk admin
 */
public function show(Guru $guru)
{
    // Hitung masa kerja dari TMT
    $masaKerja = '-';
    if ($guru->tmt) {
        $tmt = \Carbon\Carbon::parse($guru->tmt);
        $sekarang = \Carbon\Carbon::now();
        $diff = $tmt->diff($sekarang);
        $masaKerja = $diff->y . ' tahun, ' . $diff->m . ' bulan';
    }

    return view('admin.guru.show', compact('guru', 'masaKerja'));
}

}
