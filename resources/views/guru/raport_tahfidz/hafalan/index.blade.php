@extends('layouts.guru')

@section('content')
<div class="bg-white min-h-screen py-8 px-4">
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">

            {{-- Back Buttons --}}
            <div class="flex items-center justify-between flex-wrap gap-3 mb-4">

                {{-- Kembali --}}
                <a href="{{ route('guru.raport-tahfidz.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7 7-7m0 14h11a2 2 0 002-2V7a2 2 0 00-2-2H10" />
                    </svg>
                    Kembali
                </a>

            </div>

            <div class="flex items-center justify-between flex-wrap gap-3">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">📋 Daftar Hafalan Siswa</h1>
                    <p class="text-gray-500 mt-1 text-sm">
                        Ringkasan hafalan terakhir dan lanjutan seluruh siswa.
                    </p>
                </div>

                <a href="{{ route('guru.raport-hafalan.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4" />
                    </svg>
                    Input Hafalan
                </a>
            </div>
        </div>

        {{-- Empty State --}}
        @if($siswas->isEmpty())
        <div class="bg-orange-50 border border-orange-200 rounded-2xl px-5 py-6 flex items-start gap-4">
            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0 text-lg">⚠️</div>
            <div>
                <p class="font-semibold text-orange-700 text-sm mb-1">Belum ada siswa yang dipilih</p>
                <p class="text-orange-600 text-sm">Silakan pilih siswa terlebih dahulu sebelum melihat daftar hafalan.</p>
                <a href="{{ route('guru.raport-tahfidz-siswa.create') }}"
                    class="inline-flex items-center gap-1 mt-3 text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                    Pilih Siswa Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        @else

        {{-- Counter --}}
        <p class="text-sm text-gray-400 mb-4">Menampilkan <strong class="text-gray-600">{{ $siswas->count() }}</strong> siswa</p>

        {{-- Table --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-5 py-3 w-12">No</th>
                            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider px-5 py-3">Nama Siswa</th>
                            <th colspan="2" class="text-center text-xs font-semibold text-orange-400 uppercase tracking-wider px-5 py-3 bg-orange-50 border-l border-orange-100">
                                📖 Hafalan Terakhir
                            </th>
                            <th colspan="2" class="text-center text-xs font-semibold text-indigo-400 uppercase tracking-wider px-5 py-3 bg-indigo-50 border-l border-indigo-100">
                                ➡️ Hafalan Lanjutan
                            </th>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <th class="px-5 py-2 bg-gray-50"></th>
                            <th class="px-5 py-2 bg-gray-50"></th>
                            <th class="text-left text-xs font-medium text-gray-400 px-5 py-2 bg-orange-50 border-l border-orange-100">Surah</th>
                            <th class="text-left text-xs font-medium text-gray-400 px-5 py-2 bg-orange-50">Ayat</th>
                            <th class="text-left text-xs font-medium text-gray-400 px-5 py-2 bg-indigo-50 border-l border-indigo-100">Surah</th>
                            <th class="text-left text-xs font-medium text-gray-400 px-5 py-2 bg-indigo-50">Ayat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($siswas as $index => $siswa)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3 text-sm text-gray-400 font-medium">{{ $index + 1 }}</td>
                            <td class="px-5 py-3 text-sm font-semibold text-gray-800 whitespace-nowrap">{{ $siswa->nama_siswa }}</td>
                            <td class="px-5 py-3 text-sm text-gray-700 border-l border-orange-100 bg-orange-50/30">
                                {{ $hafalan[$siswa->id]->surah_terakhir ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-700 bg-orange-50/30">
                                {{ $hafalan[$siswa->id]->ayat_terakhir ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-700 border-l border-indigo-100 bg-indigo-50/30">
                                {{ $hafalan[$siswa->id]->surah_lanjut ?? '-' }}
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-700 bg-indigo-50/30">
                                {{ $hafalan[$siswa->id]->ayat_lanjut ?? '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endif

    </div>
</div>
@endsection