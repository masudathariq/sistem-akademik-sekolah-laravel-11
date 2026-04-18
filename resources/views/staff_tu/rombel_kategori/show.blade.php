@extends('layouts.staff_tu')

@section('title', 'Detail Rombel - ' . $rombel->nama_lengkap)

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    {{-- Tombol kembali --}}
    <a href="{{ route('staff_tu.rombel-kategori.index') }}" 
       class="text-sm text-blue-600 hover:underline mb-4 inline-block">
       &larr; Kembali ke Daftar Rombel Kategori
    </a>

    {{-- Judul --}}
    <h1 class="text-2xl font-bold mb-2">{{ $rombel->nama_lengkap }}</h1>

    {{-- Info kategori & jumlah siswa --}}
    @php
        $jumlahLaki = $siswas->where('jenis_kelamin', 'L')->count();
        $jumlahPerempuan = $siswas->where('jenis_kelamin', 'P')->count();
    @endphp

    <p class="text-sm text-gray-600 mb-4">
        Kategori: 
        <span class="px-2 py-1 rounded text-white {{ $kategori == 'pondok' ? 'bg-purple-600' : 'bg-blue-600' }}">
            {{ strtoupper($kategori ?? '-') }}
        </span>
        | Jumlah siswa: <span class="font-semibold">{{ $siswas->count() }}</span>
        (Laki-laki: {{ $jumlahLaki }}, Perempuan: {{ $jumlahPerempuan }})
    </p>

    {{-- Tabel siswa --}}
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full text-sm border">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-3 py-2 border text-center">No</th>
                    <th class="px-3 py-2 border text-left">Nama Siswa</th>
                    <th class="px-3 py-2 border text-center">NISN</th>
                    <th class="px-3 py-2 border text-left">Jenis Kelamin</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswas as $i => $siswa)
                <tr>
                    <td class="px-3 py-2 border text-center">{{ $i + 1 }}</td>
                    <td class="px-3 py-2 border">{{ $siswa->nama_siswa }}</td>
                    <td class="px-3 py-2 border text-center">{{ $siswa->nisn }}</td>
                    <td class="px-3 py-2 border">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-slate-500">
                        Tidak ada siswa
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
