@extends('layouts.staff_tu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 px-4 py-10">

    {{-- Header --}}
    <div class="max-w-3xl mx-auto mb-10 text-center">
        <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur border border-blue-100 rounded-full px-4 py-1.5 text-xs font-semibold text-blue-500 uppercase tracking-widest mb-4 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Jadwal Mengajar
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 leading-tight tracking-tight">
            Pilih <span class="text-blue-600">Hari</span> Mengajar
        </h1>
        <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">
            Pilih hari untuk melihat dan mengatur jadwal mengajar guru.
        </p>
    </div>

    {{-- Grid Hari --}}
    @php
        $hariList = [
            ['nama' => 'senin',   'label' => 'Senin',   'sub' => 'Hari ke-1', 'color' => 'from-blue-500 to-blue-600',      'light' => 'bg-blue-50 text-blue-600 border-blue-200'],
            ['nama' => 'selasa',  'label' => 'Selasa',  'sub' => 'Hari ke-2', 'color' => 'from-violet-500 to-violet-600',  'light' => 'bg-violet-50 text-violet-600 border-violet-200'],
            ['nama' => 'rabu',    'label' => 'Rabu',    'sub' => 'Hari ke-3', 'color' => 'from-emerald-500 to-emerald-600','light' => 'bg-emerald-50 text-emerald-600 border-emerald-200'],
            ['nama' => 'kamis',   'label' => 'Kamis',   'sub' => 'Hari ke-4', 'color' => 'from-amber-500 to-orange-500',   'light' => 'bg-amber-50 text-amber-600 border-amber-200'],
            ['nama' => 'jumat',   'label' => "Jum'at",  'sub' => 'Hari ke-5', 'color' => 'from-rose-500 to-pink-500',      'light' => 'bg-rose-50 text-rose-600 border-rose-200'],
            ['nama' => 'sabtu',   'label' => 'Sabtu',   'sub' => 'Hari ke-6', 'color' => 'from-cyan-500 to-teal-500',      'light' => 'bg-cyan-50 text-cyan-600 border-cyan-200'],
        ];

        // Dapatkan hari ini dalam bahasa indonesia
        $hariIni = strtolower(now()->locale('id')->isoFormat('dddd'));
    @endphp

    <div class="max-w-3xl mx-auto grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach($hariList as $hari)
        @php $isToday = ($hariIni === $hari['nama']); @endphp

        <a href="{{ url('staff_tu/jadwal-mengajar/list/' . $hari['nama']) }}"
           class="group relative bg-white rounded-2xl border {{ $hari['light'] }} border shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-200">

            {{-- Accent bar top --}}
            <div class="h-1.5 w-full bg-gradient-to-r {{ $hari['color'] }}"></div>

            {{-- Badge hari ini --}}
            @if($isToday)
            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-full bg-gradient-to-r {{ $hari['color'] }} text-white shadow">
                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse inline-block"></span>
                    Hari Ini
                </span>
            </div>
            @endif

            <div class="px-5 py-5">
                {{-- Ikon hari --}}
                <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3 bg-gradient-to-br {{ $hari['color'] }} shadow-md group-hover:scale-110 transition-transform duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <p class="text-[10px] font-semibold uppercase tracking-widest {{ $hari['light'] }} mb-0.5" style="background:none; border:none; padding:0;">
                    {{ $hari['sub'] }}
                </p>
                <h2 class="text-xl font-extrabold text-slate-800 group-hover:text-slate-900 leading-tight">
                    {{ $hari['label'] }}
                </h2>
            </div>

            {{-- Arrow footer --}}
            <div class="px-5 pb-4 flex items-center gap-1 text-xs font-semibold text-slate-400 group-hover:text-slate-600 transition-colors">
                Lihat Jadwal
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </div>

        </a>
        @endforeach
    </div>

</div>
@endsection