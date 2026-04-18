@extends('layouts.guru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8 px-4">

    {{-- Header --}}
    <div class="max-w-3xl mx-auto mb-8">

        {{-- Back Buttons --}}
        <div class="flex items-center justify-between flex-wrap gap-3 mb-4">

            {{-- Kembali --}}
            <a href="{{ route('guru.raport-tahfidz.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-200 text-white text-sm font-semibold rounded-xl transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7 7-7m0 14h11a2 2 0 002-2V7a2 2 0 00-2-2H10" />
                </svg>
                Kembali
            </a>

        </div>
        <div class="flex items-center gap-3 mb-1">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-blue-500 uppercase tracking-widest">Input Nilai</p>
                <h1 class="text-2xl font-bold text-slate-800 leading-tight">Pilih Aspek Penilaian</h1>
            </div>
        </div>
        <p class="text-sm text-slate-500 mt-2 ml-13 pl-[52px]">
            Klik salah satu aspek di bawah untuk mulai menginput nilai siswa.
        </p>
    </div>

    {{-- Content --}}
    <div class="max-w-3xl mx-auto">

        @if($aspeks->isEmpty())
        {{-- Empty State --}}
        <div class="bg-green-300 rounded-2xl shadow-sm border border-slate-100 px-8 py-16 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-base font-semibold text-slate-700 mb-1">Belum Ada Aspek</h3>
            <p class="text-sm text-slate-400">Silakan hubungi admin untuk menambahkan aspek penilaian.</p>
        </div>

        @else
        {{-- Aspek Cards Grid --}}
        <div class="grid gap-3">
            @foreach($aspeks as $index => $aspek)
            <a href="{{ route('guru.raport-nilai.create', $aspek->id) }}"
                class="group flex items-center gap-4 bg-green-100 border-green-500 hover:bg-blue-600 border border-slate-100 hover:border-blue-600 rounded-2xl px-5 py-4 shadow-sm hover:shadow-md transition-all duration-200">

                {{-- Number Badge --}}
                <span class="flex-shrink-0 w-9 h-9 rounded-xl bg-blue-50 group-hover:bg-blue-500 text-blue-600 group-hover:text-white text-sm font-bold flex items-center justify-center transition-colors duration-200">
                    {{ $index + 1 }}
                </span>

                {{-- Label --}}
                <span class="flex-1 text-sm font-semibold text-slate-700 group-hover:text-white transition-colors duration-200">
                    {{ $aspek->nama_aspek }}
                </span>

                {{-- Arrow --}}
                <svg class="w-4 h-4 text-slate-300 group-hover:text-white group-hover:translate-x-1 transition-all duration-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @endforeach
        </div>

        {{-- Footer Info --}}
        <p class="text-center text-xs text-slate-400 mt-6">
            {{ $aspeks->count() }} aspek tersedia
        </p>
        @endif

    </div>
</div>
@endsection