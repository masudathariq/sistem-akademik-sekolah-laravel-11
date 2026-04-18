@extends('layouts.staff_tu')

@section('title','Detail Guru')
@section('content')

<h1 class="text-2xl font-semibold mb-4">Detail Guru: {{ $guru->nama }}</h1>

<div class="bg-white p-6 rounded shadow-md max-w-2xl">
    <div class="grid grid-cols-2 gap-4">
        <div><strong>Nama:</strong> {{ $guru->nama }}</div>
        <div><strong>Email:</strong> {{ $guru->user->email ?? '-' }}</div>
        <div><strong>NUPTK:</strong> {{ $guru->nuptk ?? '-' }}</div>
        <div><strong>NBM:</strong> {{ $guru->nbm ?? '-' }}</div>
        <div><strong>Jenis Kelamin:</strong> {{ $guru->jenis_kelamin ?? '-' }}</div>
        <div><strong>Tempat Lahir:</strong> {{ $guru->tempat_lahir ?? '-' }}</div>
        <div><strong>Tanggal Lahir:</strong> {{ $guru->tanggal_lahir ?? '-' }}</div>
        <div><strong>Alamat:</strong> {{ $guru->alamat ?? '-' }}</div>
        <div><strong>TMT:</strong> {{ $guru->tmt ?? '-' }}</div>
        <div><strong>Masa Kerja:</strong> {{ $masaKerja }}</div>
        <div><strong>Jabatan:</strong> {{ $guru->jabatan ?? '-' }}</div>
        <div><strong>Pendidikan Terakhir:</strong> {{ $guru->pendidikan_terakhir ?? '-' }}</div>
    </div>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('staff_tu.guru.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>
</div>

@endsection
