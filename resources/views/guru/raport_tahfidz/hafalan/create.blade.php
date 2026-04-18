@extends('layouts.guru')

@section('content')
<div class="bg-white min-h-screen py-8 px-4">
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('guru.raport-hafalan.index') }}"
           class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">✏️ Input Hafalan Siswa</h1>
        <p class="text-gray-500 mt-1 text-sm">Isi surah dan ayat hafalan untuk setiap siswa, lalu klik <strong>Simpan</strong>.</p>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-300 text-green-700 text-sm font-semibold px-4 py-3 rounded-xl">
        ✅ {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('guru.raport-hafalan.store') }}" method="POST">
        @csrf

        {{-- Cards --}}
        <div class="space-y-4">
            @foreach($siswas as $index => $siswa)
            <div class="bg-white border-2 border-gray-100 hover:border-indigo-200 rounded-2xl p-5 transition-colors">

                {{-- Nama Siswa --}}
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 font-bold text-sm flex items-center justify-center flex-shrink-0">
                        {{ $index + 1 }}
                    </div>
                    <p class="font-semibold text-gray-800 text-base">{{ $siswa->nama_siswa }}</p>
                    <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                </div>

                {{-- Input Fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Hafalan Terakhir --}}
                    <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">
                        <p class="text-xs font-bold text-orange-500 uppercase tracking-wide mb-3">📖 Hafalan Terakhir</p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Surah</label>
                                <input type="text" name="surah_terakhir[]"
                                       value="{{ $hafalan[$siswa->id]->surah_terakhir ?? '' }}"
                                       placeholder="Contoh: Al-Baqarah"
                                       class="w-full border border-gray-200 bg-white rounded-lg px-3 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-400 transition"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nomor Ayat</label>
                                <input type="text" name="ayat_terakhir[]"
                                       value="{{ $hafalan[$siswa->id]->ayat_terakhir ?? '' }}"
                                       placeholder="Contoh: 255"
                                       class="w-full border border-gray-200 bg-white rounded-lg px-3 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-400 transition"
                                       required>
                            </div>
                        </div>
                    </div>

                    {{-- Hafalan Lanjutan --}}
                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4">
                        <p class="text-xs font-bold text-indigo-500 uppercase tracking-wide mb-3">➡️ Hafalan Lanjutan</p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Surah</label>
                                <input type="text" name="surah_lanjut[]"
                                       value="{{ $hafalan[$siswa->id]->surah_lanjut ?? '' }}"
                                       placeholder="Contoh: Al-Imran"
                                       class="w-full border border-gray-200 bg-white rounded-lg px-3 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 transition"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nomor Ayat</label>
                                <input type="text" name="ayat_lanjut[]"
                                       value="{{ $hafalan[$siswa->id]->ayat_lanjut ?? '' }}"
                                       placeholder="Contoh: 1"
                                       class="w-full border border-gray-200 bg-white rounded-lg px-3 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 transition"
                                       required>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        {{-- Submit --}}
        <div class="mt-8 flex items-center justify-between">
            <p class="text-sm text-gray-400">Total <strong class="text-gray-600">{{ $siswas->count() }}</strong> siswa</p>
            <button type="submit"
                    class="flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-sm text-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Semua Hafalan
            </button>
        </div>

    </form>

</div>
</div>
@endsection