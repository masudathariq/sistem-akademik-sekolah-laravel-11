<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Daftar role yang DIIZINKAN di aplikasi
     * Tambah role cukup di sini saja
     */
    private array $roles = [
        'admin',
        'kepsek',
        'guru',
        'bendahara',
        'staff_tu',
    ];

    // =========================
    // TAMPILKAN SEMUA USER
    // =========================
    public function index()
    {
        // Urutkan berdasarkan role
        $users = User::orderBy('role')->get();

        return view('admin.users.index', compact('users'));
    }

    // =========================
    // FORM TAMBAH USER
    // =========================
    public function create()
    {
        return view('admin.users.create', [
            'roles' => $this->roles
        ]);
    }

    // =========================
    // SIMPAN USER BARU
    // =========================
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => ['required', Rule::in($this->roles)],
        ]);

        // Simpan user
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dibuat');
    }

    // =========================
    // FORM EDIT USER
    // =========================
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user'  => $user,
            'roles' => $this->roles
        ]);
    }

    // =========================
    // UPDATE USER
    // =========================
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => ['required', Rule::in($this->roles)],
        ]);

        // Update data user
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    // =========================
    // HAPUS USER
    // =========================
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
