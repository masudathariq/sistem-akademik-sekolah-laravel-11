@extends('layouts.guru')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Data Bacaan Iqro</h2>
            <p class="text-sm text-gray-500 mt-1">Lihat progres bacaan siswa dan cetak daftar bacaan Iqro.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('guru.raport-iqro-bacaan.create') }}" class="inline-flex items-center gap-2 rounded-full bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">Tambah / Edit Bacaan</a>
            <a href="{{ route('guru.raport-iqro-bacaan.cetak-pdf') }}" target="_blank" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cetak PDF Bacaan</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-3xl border border-gray-200 bg-white shadow-sm">
        <table class="w-full min-w-[760px] divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-[0.12em] text-gray-600">
                <tr>
                    <th class="px-5 py-4">No</th>
                    <th class="px-5 py-4">Siswa</th>
                    <th class="px-5 py-4">Iqro Terakhir</th>
                    <th class="px-5 py-4">Halaman Terakhir</th>
                    <th class="px-5 py-4">Target Iqro</th>
                    <th class="px-5 py-4">Target Halaman</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($siswas as $index => $siswa)
                    @php $bacaanSiswa = $bacaan[$siswa->id] ?? null; @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4">{{ $index + 1 }}</td>
                        <td class="px-5 py-4 font-medium text-gray-900">{{ $siswa->nama_siswa }}</td>
                        <td class="px-5 py-4">{{ $bacaanSiswa->iqro_terakhir ?? '-' }}</td>
                        <td class="px-5 py-4">{{ $bacaanSiswa->halaman_terakhir ?? '-' }}</td>
                        <td class="px-5 py-4">{{ $bacaanSiswa->iqro_lanjut ?? '-' }}</td>
                        <td class="px-5 py-4">{{ $bacaanSiswa->halaman_lanjut ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-gray-500">Belum ada data bacaan untuk siswa yang dipilih.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection