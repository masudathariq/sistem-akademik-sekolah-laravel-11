<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\User;

class GuruProfileController extends Controller
{

public function index()
{
    // Ambil user login
    $user = Auth::user();
    if (!$user) {
        abort(403); // pastikan login
    }

    // Memberitahu IDE bahwa $user pasti instance User
    assert($user instanceof User);

    // Ambil data guru, buat otomatis jika belum ada
    $guru = $user->guru ?? Guru::create([
        'user_id' => $user->id,
        'nama' => $user->name
    ]);

    return view('guru.profile.index', compact('guru'));
}
    /**
     * Tampilkan halaman edit profil guru
     */
    public function edit()
    {
        // Ambil user login
        $user = Auth::user();
        if (!$user) abort(403); // pastikan user login

        // Memberi tahu IDE bahwa $user adalah App\Models\User
        /** @var User $user */

        // Ambil data guru, buat otomatis jika belum ada
        $guru = $user->guru;
        if (!$guru) {
            $guru = Guru::create([
                'user_id' => $user->id,
                'nama' => $user->name
            ]);
        }

        return view('guru.profile.edit', compact('guru'));
    }

    /**
     * Update data profil guru
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) abort(403);

        /** @var User $user */

        $guru = $user->guru;
        if (!$guru) {
            $guru = Guru::create([
                'user_id' => $user->id,
                'nama' => $user->name
            ]);
        }

        // Validasi data
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

        return redirect()->route('guru.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
}
