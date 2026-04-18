@extends('layouts.staff_tu')

@section('title', 'Tambah Siswa')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Siswa</h1>
            <p class="text-sm text-gray-500">Lengkapi data siswa dengan benar</p>
        </div>

        {{-- Error --}}
        @if ($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
            <div class="text-red-700 font-semibold mb-2">Terjadi kesalahan:</div>
            <ul class="list-disc pl-5 text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/staff_tu/siswa') }}" method="POST" class="space-y-6">
            @csrf

            {{-- CARD --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border border-gray-100">

                {{-- SECTION DATA SISWA --}}
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Data Siswa</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">NISN</label>
                        <input type="text" name="nisn"
                               value="{{ old('nisn') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">NIS</label>
                        <input type="text" name="nis"
                               value="{{ old('nis') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Siswa</label>
                        <input type="text" name="nama_siswa"
                               value="{{ old('nama_siswa') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                                class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                                required>
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir"
                               value="{{ old('tempat_lahir') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                               required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Alamat</label>
                        <textarea name="alamat"
                                  class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                                  rows="3"
                                  required>{{ old('alamat') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Rombel (Opsional)</label>
                        <select name="rombel_id"
                                class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2">
                            <option value="">-- Pilih --</option>
                            @foreach($rombels as $rombel)
                                <option value="{{ $rombel->id }}" {{ old('rombel_id') == $rombel->id ? 'selected' : '' }}>
                                    {{ $rombel->tingkat }} {{ $rombel->kode_rombel }} - {{ $rombel->nama_rombel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- SECTION ORANG TUA --}}
                <h2 class="text-lg font-semibold text-gray-700 mt-8 mb-4">Data Orang Tua</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Ayah</label>
                        <input type="text" name="ayah"
                               value="{{ old('ayah') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Ibu</label>
                        <input type="text" name="ibu"
                               value="{{ old('ibu') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2"
                               required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Wali (Opsional)</label>
                        <input type="text" name="wali"
                               value="{{ old('wali') }}"
                               class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 px-3 py-2">
                    </div>

                </div>

            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex justify-end gap-3">
                <a href="{{ url('/staff_tu/siswa') }}"
                   class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition shadow-sm">
                    Simpan Siswa
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
