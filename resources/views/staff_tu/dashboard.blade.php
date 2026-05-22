@extends('layouts.staff_tu')

@section('title', 'Dashboard Staff Tata Usaha')
@section('page-title', 'Dashboard Staff Tata Usaha')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-4 md:p-6 space-y-5">

    {{-- WELCOME BANNER --}}
    <div class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-600 text-white rounded-2xl shadow-xl p-6 md:p-8 overflow-hidden">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-10 right-10 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="absolute top-6 right-36 w-6 h-6 bg-white/10 rounded-full"></div>

        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-blue-200 text-[10px] font-bold uppercase tracking-widest mb-1">Staff Tata Usaha</p>
                <h2 class="text-2xl md:text-3xl font-extrabold mb-1.5 tracking-tight">
                    Halo, {{ auth()->user()->name ?? 'Staff TU' }}
                </h2>
                <p class="text-blue-100 text-sm leading-relaxed max-w-lg">
                    Selamat datang di sistem administrasi. Pantau data siswa, kelola jadwal, dan kelola arsip sekolah dari satu tempat.
                </p>
            </div>
            {{-- Date box --}}
            <div class="bg-white/15 backdrop-blur rounded-2xl px-5 py-4 text-center flex-shrink-0 border border-white/20">
                <p class="text-blue-200 text-[10px] uppercase tracking-widest font-bold mb-0.5">Hari Ini</p>
                <p class="text-3xl font-extrabold leading-none">{{ \Carbon\Carbon::now()->translatedFormat('d') }}</p>
                <p class="text-sm font-semibold text-blue-100 mt-0.5">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                <p class="text-blue-200 text-xs mt-1">{{ \Carbon\Carbon::now()->translatedFormat('l') }}</p>
            </div>
        </div>

        {{-- Status & Info pills --}}
        <div class="relative mt-5 flex flex-wrap gap-2 text-xs">
            <div class="bg-white/20 border border-white/25 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-emerald-300 rounded-full animate-pulse"></span>
                Sistem Aktif
            </div>
            <div class="bg-white/20 border border-white/25 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Tahun Ajaran: {{ $tahunAktif->tahun_ajaran ?? '-' }}
            </div>
            <div class="bg-white/20 border border-white/25 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Semester {{ $tahunAktif->semester ?? '-' }}
            </div>
        </div>
    </div>

    {{-- KPI CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
        @php
            $kpis = [
                ['label' => 'Total Siswa',    'value' => $summary['total'] ?? 0,    'unit' => 'siswa',  'color' => 'blue',    'sub' => 'Terdaftar aktif',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                ['label' => 'Total Guru',     'value' => $totalGuru ?? 0,     'unit' => 'guru',   'color' => 'violet',  'sub' => 'Tenaga pengajar',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>'],
                ['label' => 'Total Rombel',   'value' => $totalRombel ?? 0,   'unit' => 'kelas',  'color' => 'amber',   'sub' => 'Kelas aktif',        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
                ['label' => 'Mata Pelajaran', 'value' => $totalMapel ?? 0,    'unit' => 'mapel',  'color' => 'emerald', 'sub' => 'Kurikulum aktif',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'],
            ];
            $kpiMap = [
                'blue'    => ['bg'=>'bg-blue-50',    'border'=>'border-blue-200',    'icon'=>'bg-blue-100 text-blue-600',    'val'=>'text-blue-700',    'bar'=>'bg-blue-500'],
                'violet'  => ['bg'=>'bg-violet-50',  'border'=>'border-violet-200',  'icon'=>'bg-violet-100 text-violet-600','val'=>'text-violet-700',  'bar'=>'bg-violet-500'],
                'amber'   => ['bg'=>'bg-amber-50',   'border'=>'border-amber-200',   'icon'=>'bg-amber-100 text-amber-600',  'val'=>'text-amber-700',   'bar'=>'bg-amber-500'],
                'emerald' => ['bg'=>'bg-emerald-50', 'border'=>'border-emerald-200', 'icon'=>'bg-emerald-100 text-emerald-600','val'=>'text-emerald-700','bar'=>'bg-emerald-500'],
            ];
        @endphp
        @foreach($kpis as $k)
        @php $c = $kpiMap[$k['color']]; @endphp
        <div class="bg-white/90 backdrop-blur {{ $c['border'] }} border rounded-2xl shadow-sm p-4 md:p-5 hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute bottom-0 left-0 right-0 h-0.5 {{ $c['bar'] }} opacity-50"></div>
            <div class="flex items-start justify-between mb-3">
                <p class="text-xs text-slate-500 font-semibold leading-tight pr-2">{{ $k['label'] }}</p>
                <div class="w-8 h-8 rounded-xl {{ $c['icon'] }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $k['icon'] !!}</svg>
                </div>
            </div>
            <p class="text-2xl md:text-3xl font-extrabold {{ $c['val'] }} leading-none mb-1">{{ number_format($k['value']) }}</p>
            <p class="text-[10px] text-slate-400 font-medium">{{ $k['sub'] }}</p>
        </div>
        @endforeach
    </div>


    {{-- DIAGRAM (desktop only) --}}
    <div class="hidden md:block bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100">
            <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <p class="text-sm font-bold text-slate-700">Diagram Statistik</p>
        </div>
        <div class="p-5">
            @include('staff_tu.dashboard.diagram')
        </div>
    </div>


    {{-- GRID: RINGKASAN + REKAP TINGKAT --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- REKAP PER TINGKAT --}}
        <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100">
                <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                </div>
                <p class="text-sm font-bold text-slate-700">Rekap per Tingkat</p>
            </div>
            <div class="p-5">
                @include('staff_tu.dashboard.rekap-tingkat')
            </div>
        </div>

    </div>

    {{-- REKAP TINGKAT & KATEGORI --}}
    <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100">
            <div class="w-7 h-7 rounded-lg bg-pink-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            </div>
            <p class="text-sm font-bold text-slate-700">Rekap Tingkat & Kategori</p>
        </div>
        <div class="p-5">
            @include('staff_tu.dashboard.rekap-tingkat-kategori')
        </div>
    </div>

    {{-- REKAP PER ROMBEL --}}
    <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100">
            <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <p class="text-sm font-bold text-slate-700">Rekap per Rombel</p>
        </div>
        <div class="p-5">
            @include('staff_tu.dashboard.rekap-rombel')
        </div>
    </div>

</div>
@endsection
