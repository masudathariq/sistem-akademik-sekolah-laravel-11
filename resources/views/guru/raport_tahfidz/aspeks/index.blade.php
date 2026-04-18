@extends('layouts.guru')

@section('content')
<div class="bg-gray-50 min-h-screen py-8 px-4">
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between gap-3 flex-wrap mb-6">
        <div>
            <p class="text-xs font-semibold text-indigo-500 uppercase tracking-widest mb-1">Raport Tahfidz</p>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Aspek Penilaian</h1>
        </div>
        <a href="{{ route('guru.raport-aspeks.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Aspek
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-3 rounded-xl">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Empty --}}
    @if($aspeks->isEmpty())
    <div class="bg-white border-2 border-dashed border-gray-200 rounded-2xl py-14 text-center">
        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <p class="text-sm font-semibold text-gray-600 mb-1">Belum ada aspek</p>
        <p class="text-xs text-gray-400 mb-4">Tambahkan aspek penilaian untuk raport tahfidz.</p>
        <a href="{{ route('guru.raport-aspeks.create') }}"
           class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
            Tambah Aspek Pertama
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @else

    <p class="text-sm text-gray-400 mb-3">
        <strong class="text-gray-600">{{ $aspeks->count() }}</strong> aspek tersedia
    </p>

    {{-- List --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="divide-y divide-gray-100">
            @foreach($aspeks as $index => $aspek)
            <div class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50 transition-colors">

                {{-- Number --}}
                <span class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 text-xs font-bold flex items-center justify-center flex-shrink-0">
                    {{ $index + 1 }}
                </span>

                {{-- Name --}}
                <span class="flex-1 text-sm font-semibold text-gray-800">{{ $aspek->nama_aspek }}</span>

                {{-- Actions --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('guru.raport-aspeks.edit', $aspek->id) }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('guru.raport-aspeks.destroy', $aspek->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus aspek ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-500 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
            @endforeach
        </div>
    </div>

    @endif

</div>
</div>
@endsection