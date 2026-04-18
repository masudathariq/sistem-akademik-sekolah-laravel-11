@extends('layouts.admin')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Edit User</h2>
        <p class="text-sm text-slate-500">
            Perbarui informasi akun dan hak akses pengguna.
        </p>
    </div>

    {{-- CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100">

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Lengkap
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                              outline-none transition text-sm">

                @error('name')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                              outline-none transition text-sm">

                @error('email')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Password Baru
                </label>
                <input type="password"
                       name="password"
                       placeholder="Kosongkan jika tidak ingin mengubah password"
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                              outline-none transition text-sm">

                <p class="mt-1 text-xs text-slate-400">
                    Isi hanya jika ingin mengganti password.
                </p>

                @error('password')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Konfirmasi Password
                </label>
                <input type="password"
                       name="password_confirmation"
                       placeholder="Ulangi password baru"
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                              outline-none transition text-sm">
            </div>

            {{-- ROLE --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Role / Hak Akses
                </label>

                <select name="role"
                        class="w-full px-4 py-2.5 rounded-lg border border-slate-300
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               outline-none transition text-sm bg-white">

                    @foreach($roles as $role)
                        <option value="{{ $role }}"
                            @selected(old('role', $user->role) == $role)>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>

                @error('role')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTON --}}
            <div class="flex items-center justify-between pt-4 border-t border-slate-100">

                <a href="{{ route('admin.users.index') }}"
                   class="text-sm text-slate-500 hover:text-slate-700 transition">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700
                               text-white px-6 py-2.5 rounded-lg
                               text-sm font-medium shadow-sm transition">
                    Update User
                </button>

            </div>

        </form>
    </div>

</div>

@endsection