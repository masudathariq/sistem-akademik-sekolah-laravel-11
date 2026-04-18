@extends('layouts.guru')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-start justify-center py-12 px-4">
<div class="w-full max-w-md">

    {{-- Back --}}
    <a href="{{ route('guru.raport-tahfidz.index') }}"
       class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-400 hover:text-gray-700 mb-8 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Top accent --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-indigo-500 to-violet-500"></div>

        <div class="px-8 py-8">

            {{-- Icon + Title --}}
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-indigo-50 border border-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-900 leading-tight">Tambah Aspek Penilaian</h1>
                    <p class="text-sm text-gray-400 mt-0.5">Raport Tahfidz</p>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('guru.raport-aspeks.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="nama_aspek" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Aspek
                    </label>
                    <input type="text" name="nama_aspek" id="nama_aspek"
                           value="{{ old('nama_aspek') }}"
                           placeholder="Contoh: Kelancaran Bacaan"
                           class="w-full border border-gray-200 bg-gray-50 hover:bg-white focus:bg-white rounded-xl px-4 py-3 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all"
                           required>
                    @error('nama_aspek')
                        <div class="flex items-center gap-1.5 mt-2">
                            <svg class="w-3.5 h-3.5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 py-3 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow-md transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Aspek
                    </button>
                    <a href="{{ route('guru.raport-tahfidz.index') }}"
                       class="flex-1 flex items-center justify-center py-3 text-sm font-semibold text-gray-500 hover:text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Helper text --}}
    <p class="text-center text-xs text-gray-400 mt-5">
        Aspek yang ditambahkan akan muncul di halaman input nilai.
    </p>

</div>
</div>
@endsection