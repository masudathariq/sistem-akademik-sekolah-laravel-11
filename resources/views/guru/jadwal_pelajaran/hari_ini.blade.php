@extends('layouts.guru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-4 md:p-6">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
        <div>
            <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur border border-blue-100 rounded-full px-3 py-1 text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-2 shadow-sm">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Jadwal Hari Ini
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">
                Hari <span class="text-blue-600">{{ ucfirst($hari) }}</span>
            </h1>
            <p class="text-slate-500 text-sm mt-1">Jadwal mengajar Anda untuk hari ini.</p>
        </div>

        {{-- STATS --}}
        <div class="flex flex-row gap-2 flex-shrink-0 flex-wrap">
            <div class="bg-white/80 backdrop-blur border border-blue-100 rounded-2xl px-4 py-2.5 shadow-sm flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 leading-none font-medium">Tahun Ajaran</p>
                    <p class="text-sm font-bold text-slate-700">{{ $tahunAktif->tahun_ajaran }}</p>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur border border-indigo-100 rounded-2xl px-4 py-2.5 shadow-sm flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 leading-none font-medium">Semester</p>
                    <p class="text-sm font-bold text-slate-700">{{ $tahunAktif->semester }}</p>
                </div>
            </div>
            @if(count($jadwals) > 0)
            <div class="bg-white/80 backdrop-blur border border-emerald-100 rounded-2xl px-4 py-2.5 shadow-sm flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 leading-none font-medium">Total Sesi</p>
                    <p class="text-sm font-bold text-slate-700">{{ count($jadwals) }} Jadwal</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- JADWAL LIST --}}
    @forelse($jadwals as $i => $jadwal)
        @php
            $start    = \Carbon\Carbon::parse($jadwal->jam_mulai);
            $end      = \Carbon\Carbon::parse($jadwal->jam_selesai);
            $nowTime  = \Carbon\Carbon::parse(\Carbon\Carbon::now()->format('H:i'));
            $isActive = $nowTime->between($start, $end);
            $isDone   = $nowTime->gt($end);

            $durMenit  = $start->diffInMinutes($end);
            $jam       = intdiv($durMenit, 60);
            $menit     = $durMenit % 60;
            $durasiTxt = ($jam > 0 ? "{$jam}j " : '') . ($menit > 0 ? "{$menit}m" : '');

            // Warna per status
            $statusColor = $isActive ? 'emerald' : ($isDone ? 'slate' : 'blue');
            $barColor    = $isActive ? 'bg-emerald-400' : ($isDone ? 'bg-slate-200' : 'bg-blue-500');
            $cardRing    = $isActive ? 'ring-2 ring-emerald-300 border-emerald-300' : ($isDone ? 'border-slate-200' : 'border-white');
            $cardOpacity = $isDone ? 'opacity-60' : '';
        @endphp

        <div class="bg-white/90 backdrop-blur {{ $cardRing }} {{ $cardOpacity }} border rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 mb-3.5 overflow-hidden">

            {{-- STATUS BAR TOP --}}
            <div class="h-1 w-full {{ $barColor }}"></div>

            {{-- ===== DESKTOP ===== --}}
            <div class="hidden sm:flex items-center gap-4 px-5 py-4">
                {{-- Nomor --}}
                <span class="w-8 h-8 inline-flex items-center justify-center rounded-full text-sm font-bold flex-shrink-0
                    {{ $isActive ? 'bg-emerald-100 text-emerald-700' : ($isDone ? 'bg-slate-100 text-slate-400' : 'bg-blue-100 text-blue-700') }}">
                    {{ $i + 1 }}
                </span>

                {{-- Jam --}}
                <div class="flex-shrink-0">
                    <div class="inline-flex items-center gap-1.5 border text-xs font-bold px-3 py-1.5 rounded-full
                        {{ $isActive ? 'bg-emerald-50 border-emerald-300 text-emerald-700' : ($isDone ? 'bg-slate-50 border-slate-200 text-slate-400' : 'bg-blue-50 border-blue-200 text-blue-700') }}">
                        <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $start->format('H:i') }} – {{ $end->format('H:i') }}
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1 pl-1 text-center">{{ $durasiTxt }}</p>
                </div>

                <div class="w-px h-10 bg-slate-200 flex-shrink-0"></div>

                {{-- Rombel + Mapel --}}
                <div class="flex-1 flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Tingkat {{ $jadwal->rombel->tingkat }} — {{ $jadwal->rombel->nama_rombel }}
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        {{ $jadwal->mataPelajaran->nama_mapel }}
                    </span>
                </div>

                {{-- Status Badge --}}
                @if($isActive)
                    <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full flex-shrink-0">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        Berlangsung
                    </span>
                @elseif($isDone)
                    <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-400 text-xs font-semibold px-3 py-1.5 rounded-full flex-shrink-0">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Selesai
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1.5 rounded-full flex-shrink-0">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Akan Datang
                    </span>
                @endif
            </div>

            {{-- ===== MOBILE ===== --}}
            <div class="sm:hidden px-4 py-4">

                {{-- Baris atas: nomor + status badge --}}
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 inline-flex items-center justify-center rounded-full text-xs font-bold flex-shrink-0
                            {{ $isActive ? 'bg-emerald-100 text-emerald-700' : ($isDone ? 'bg-slate-100 text-slate-400' : 'bg-blue-100 text-blue-700') }}">
                            {{ $i + 1 }}
                        </span>
                        {{-- Jam besar --}}
                        <div class="inline-flex items-center gap-1.5 border text-sm font-extrabold px-3 py-1.5 rounded-full
                            {{ $isActive ? 'bg-emerald-50 border-emerald-300 text-emerald-700' : ($isDone ? 'bg-slate-50 border-slate-200 text-slate-400' : 'bg-blue-50 border-blue-200 text-blue-700') }}">
                            <svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $start->format('H:i') }} – {{ $end->format('H:i') }}
                        </div>
                    </div>

                    {{-- Status badge kanan --}}
                    @if($isActive)
                        <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            Berlangsung
                        </span>
                    @elseif($isDone)
                        <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-400 text-[10px] font-semibold px-2.5 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Selesai
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-600 text-[10px] font-semibold px-2.5 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Akan Datang
                        </span>
                    @endif
                </div>

                {{-- 2 kotak: Kelas + Mapel --}}
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <div class="bg-indigo-50 border border-indigo-200 rounded-xl px-3 py-2.5">
                        <p class="text-[10px] text-indigo-400 font-semibold uppercase tracking-wider mb-0.5">Kelas</p>
                        <p class="text-sm font-bold text-indigo-800 leading-tight">
                            Tingkat {{ $jadwal->rombel->tingkat }}
                        </p>
                        <p class="text-xs text-indigo-600 leading-tight">{{ $jadwal->rombel->nama_rombel }}</p>
                    </div>
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-3 py-2.5">
                        <p class="text-[10px] text-emerald-500 font-semibold uppercase tracking-wider mb-0.5">Mata Pelajaran</p>
                        <p class="text-sm font-bold text-emerald-800 leading-tight">{{ $jadwal->mataPelajaran->nama_mapel }}</p>
                    </div>
                </div>

                {{-- Durasi footer --}}
                <p class="text-[11px] text-slate-400 flex items-center gap-1 pl-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>
                    Durasi {{ $durasiTxt }}
                </p>

            </div>
        </div>

    @empty
        <div class="bg-white/90 backdrop-blur border border-dashed border-slate-300 rounded-2xl p-12 text-center shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-slate-700 font-bold text-lg">Tidak Ada Jadwal Hari Ini</p>
            <p class="text-slate-400 text-sm mt-1 max-w-xs mx-auto">
                Nikmati harimu! Tidak ada sesi mengajar pada hari <strong class="text-slate-600">{{ ucfirst($hari) }}</strong>.
            </p>
            <a href="{{ route('guru.jadwal_pelajaran.index') }}"
               class="inline-flex items-center gap-2 mt-5 bg-blue-50 border border-blue-200 text-blue-700 text-sm font-semibold px-4 py-2 rounded-xl hover:bg-blue-100 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Lihat Jadwal Mingguan
            </a>
        </div>
    @endforelse

    {{-- BACK BUTTON --}}
    @if(count($jadwals) > 0)
    <div class="mt-4">
        <a href="{{ route('guru.jadwal_pelajaran.index') }}"
           class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition-colors font-semibold group">
            <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Lihat Jadwal Mingguan
        </a>
    </div>
    @endif

</div>
@endsection