@extends('layouts.admin')

@section('title', 'Tempatkan Siswa')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-200 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <h1 class="text-2xl font-bold mb-6">Tempatkan Siswa - Tahun Ajaran {{ $tahunAjaranAktif->nama }}</h1>

    <div class="bg-white rounded shadow p-6 max-w-2xl mx-auto">
        <form action="{{ route('staff_tu.penempatan.tempatkan') }}" method="POST">
            @csrf

            {{-- Pilih Siswa --}}
            <div class="mb-4">
                <label for="siswa_id" class="block font-semibold mb-2">Pilih Siswa:</label>
                <select name="siswa_id[]" id="siswa_id" multiple class="w-full border rounded p-2 h-48">
                    @forelse($siswasBelumDitempatkan as $siswa)
                        <option value="{{ $siswa->id }}">
                            {{ $siswa->nama_siswa }} ({{ $siswa->nisn }})
                        </option>
                    @empty
                        <option disabled>Semua siswa sudah ditempatkan</option>
                    @endforelse
                </select>
                @error('siswa_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Pilih Rombel --}}
            <div class="mb-4">
                <label for="rombel_id" class="block font-semibold mb-2">Pilih Rombel Tujuan:</label>
                <select name="rombel_id" id="rombel_id" class="w-full border rounded p-2">
                    <option value="">-- Pilih Rombel --</option>
                    @foreach($rombels as $rombel)
                        <option value="{{ $rombel->id }}">
                            {{ $rombel->nama_lengkap }} ({{ $rombel->siswas_count }} siswa)
                        </option>
                    @endforeach
                </select>
                @error('rombel_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('staff_tu.penempatan.index') }}" class="mr-4 px-4 py-2 rounded border hover:bg-gray-100">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tempatkan Siswa</button>
            </div>
        </form>
    </div>

</div>
@endsection
