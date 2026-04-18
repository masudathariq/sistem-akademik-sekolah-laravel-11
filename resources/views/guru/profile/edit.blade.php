@extends('layouts.guru')

@section('title','Edit Profil Guru')
@section('header','Edit Profil Guru')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Feedback sukses --}}
    @if(session('success'))
        <div class="flex items-center gap-2 bg-green-100 text-green-800 p-4 rounded-lg mb-6 shadow">
            ✅ <span>{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('guru.profile.update') }}" method="POST" class="bg-white p-6 rounded-2xl shadow-lg space-y-4">
        @csrf
        @method('PATCH')

        {{-- Nama --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" value="{{ $guru->nama }}" 
                   class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- NUPTK --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">NUPTK</label>
            <input type="text" name="nuptk" value="{{ $guru->nuptk }}" 
                   class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Jenis Kelamin --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Jenis Kelamin</label>
            <select name="jenis_kelamin" 
                    class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
                <option value="L" {{ $guru->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>
                <option value="P" {{ $guru->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
            </select>
        </div>

        {{-- Tempat Lahir --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ $guru->tempat_lahir }}" 
                   class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Tanggal Lahir --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}" 
                   class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Alamat --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Alamat</label>
            <textarea name="alamat" rows="3" 
                      class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">{{ $guru->alamat }}</textarea>
        </div>

        {{-- TMT --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">TMT</label>
            <input type="date" name="tmt" value="{{ $guru->tmt }}" 
                   class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Jabatan --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Jabatan</label>
            <input type="text" name="jabatan" value="{{ $guru->jabatan }}" 
                   class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Pendidikan Terakhir --}}
        <div>
            <label class="block mb-1 font-medium text-gray-700">Pendidikan Terakhir</label>
            <input type="text" name="pendidikan_terakhir" value="{{ $guru->pendidikan_terakhir }}" 
                   class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end mt-4">
            <button type="submit" 
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 shadow-md transition-all font-medium flex items-center gap-2">
                💾 Simpan
            </button>
        </div>
    </form>
</div>
@endsection
