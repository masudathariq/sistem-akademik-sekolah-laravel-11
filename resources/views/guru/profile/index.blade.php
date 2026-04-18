@extends('layouts.guru')

@section('title','Profil Guru')
@section('header','Profil Guru')

@section('content')

@php
use Carbon\Carbon;

$guru = auth()->user()->guru;
if (!$guru) {
    $guru = \App\Models\Guru::create([
        'user_id' => auth()->id(),
        'nama' => auth()->user()->name
    ]);
}

// Hitung masa kerja dari TMT sampai sekarang
$masaKerja = '-';
if ($guru->tmt) {
    $tmt = Carbon::parse($guru->tmt);
    $sekarang = Carbon::now();
    $diff = $tmt->diff($sekarang);
    $masaKerja = $diff->y . ' th, ' . $diff->m . ' bln';
}
@endphp

<div class="max-w-xl mx-auto space-y-4 p-2">

    {{-- Banner Profil --}}
    <div class="bg-gradient-to-r bg-blue-900 text-white p-4 rounded-lg shadow">
        <h2 class="text-xl sm:text-2xl font-bold">Halo, {{ $guru->nama }} 👋</h2>
        <p class="mt-1 text-indigo-100 text-sm sm:text-base">Profil Guru Anda</p>
    </div>
{{-- Kartu Data Profil --}}
<div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-sm sm:text-base border border-gray-100">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-5">
        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            📄 Data Profil
        </h3>
        <span class="text-xs sm:text-sm px-2 py-1 bg-blue-100 text-blue-800 rounded-full font-medium">
            Guru
        </span>
    </div>

    {{-- Grid Data --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">

        <div><span class="font-semibold">Nama:</span> {{ $guru->nama }}</div>
        <div><span class="font-semibold">NUPTK:</span> {{ $guru->nuptk ?? '-' }}</div>

        <div><span class="font-semibold">NBM:</span> {{ $guru->nbm ?? '-' }}</div>
        <div><span class="font-semibold">Jenis Kelamin:</span> {{ $guru->jenis_kelamin ?? '-' }}</div>

        <div><span class="font-semibold">Tempat Lahir:</span> {{ $guru->tempat_lahir ?? '-' }}</div>
        <div><span class="font-semibold">Tanggal Lahir:</span> {{ $guru->tanggal_lahir ?? '-' }}</div>

        <div><span class="font-semibold">Alamat:</span> {{ $guru->alamat ?? '-' }}</div>
        <div><span class="font-semibold">TMT:</span> {{ $guru->tmt ?? '-' }}</div>

        <div class="col-span-1 sm:col-span-2 bg-green-50 p-3 rounded-lg text-sm sm:text-base font-medium text-green-800">
            <span class="font-semibold">Masa Kerja:</span> {{ $masaKerja }}
        </div>

        <div><span class="font-semibold">Jabatan:</span> {{ $guru->jabatan ?? '-' }}</div>
        <div><span class="font-semibold">Pendidikan Terakhir:</span> {{ $guru->pendidikan_terakhir ?? '-' }}</div>

    </div>

    {{-- Tombol Edit --}}
    <div class="mt-6 flex justify-end">
        <a href="{{ route('guru.profile.edit') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow-md transition-all duration-300 font-medium text-sm sm:text-base flex items-center gap-2">
           ✏️ Edit Profil
        </a>
    </div>

</div>


    {{-- Tips / Info tambahan --}}
    <div class="bg-yellow-50 p-3 rounded-lg shadow text-yellow-800 text-xs sm:text-sm">
        💡 Tips: Pastikan data profil Anda selalu diperbarui agar absensi dan jadwal tercatat dengan benar.
    </div>

</div>

@endsection
