@extends('layouts.staff_tu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-4 md:p-6">

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-1.5 text-xs text-slate-400 mb-4 flex-wrap">
        <a href="{{ route('staff_tu.jadwal_pelajaran.index') }}" class="hover:text-blue-500 transition font-medium">Jadwal & Kurikulum</a>
        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}" class="hover:text-blue-500 transition font-medium">Hari {{ ucfirst($hari) }}</a>
        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-blue-500 font-semibold">Daftar Jadwal</span>
    </div>

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
        <div>
            <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur border border-blue-100 rounded-full px-3 py-1 text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Jadwal Mengajar
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">
                Hari <span class="text-blue-600">{{ ucfirst($hari) }}</span>
            </h1>
            <p class="text-slate-500 mt-1 text-sm">
                Seluruh jadwal mengajar pada hari <strong class="text-slate-700">{{ ucfirst($hari) }}</strong>.
            </p>
        </div>

        {{-- STATS BADGES --}}
        <div class="flex flex-row sm:flex-row gap-2 flex-shrink-0 flex-wrap">
            <div class="bg-white/80 backdrop-blur border border-blue-100 rounded-2xl px-4 py-2.5 shadow-sm flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 leading-none font-medium">Tahun Ajaran</p>
                    <p class="text-sm font-bold text-slate-700 leading-snug">{{ $tahunAktif->tahun_ajaran }}</p>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur border border-indigo-100 rounded-2xl px-4 py-2.5 shadow-sm flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 leading-none font-medium">Semester</p>
                    <p class="text-sm font-bold text-slate-700 leading-snug">{{ $tahunAktif->semester }}</p>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur border border-emerald-100 rounded-2xl px-4 py-2.5 shadow-sm flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 leading-none font-medium">Total Sesi</p>
                    <p class="text-sm font-bold text-slate-700 leading-snug">{{ $jadwals->count() }} Jadwal</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">

        {{-- TABLE HEADER BAR --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 bg-slate-50/80">
            <p class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Daftar Jadwal Mengajar
            </p>
            <span class="text-xs bg-blue-50 text-blue-600 font-semibold px-2.5 py-1 rounded-full border border-blue-100">
                {{ $jadwals->count() }} data
            </span>
        </div>

        {{-- DESKTOP TABLE --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-900 to-indigo-800 text-white text-left">
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider w-12 text-center">No</th>
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider">Jam Pelajaran</th>
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider">Guru</th>
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider">Kelas / Rombel</th>
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider">Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jadwals as $index => $jadwal)
                    <tr class="hover:bg-blue-50/60 transition-colors duration-100 group">
                        <td class="px-4 py-3.5 text-center">
                            <span class="w-6 h-6 inline-flex items-center justify-center bg-slate-100 group-hover:bg-blue-100 text-slate-500 group-hover:text-blue-600 text-xs font-bold rounded-full transition-colors">
                                {{ $index + 1 }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="inline-flex items-center gap-1.5 bg-blue-50 border border-blue-200 text-blue-800 text-xs font-bold px-3 py-1.5 rounded-full">
                                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                &ndash;
                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 shadow-sm">
                                    {{ strtoupper(substr($jadwal->guru->nama ?? '?', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-slate-700">{{ $jadwal->guru->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <span class="inline-flex items-center gap-1.5 bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                {{ $jadwal->rombel->tingkat ?? '-' }} {{ $jadwal->rombel->kode_rombel ?? '-' }} {{ $jadwal->rombel->nama_rombel ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5">
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                {{ $jadwal->mataPelajaran->nama_mapel ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <p class="text-slate-600 font-semibold">Belum ada jadwal pada hari ini</p>
                                <p class="text-slate-400 text-xs">Tambahkan jadwal melalui halaman daftar guru.</p>
                                <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}"
                                   class="mt-1 inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-xl transition shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    Kembali & Atur Jadwal
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MOBILE CARD LIST --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse($jadwals as $index => $jadwal)
            <div class="p-4 hover:bg-blue-50/40 transition-colors">
                <div class="flex items-start justify-between gap-3 mb-2.5">
                    {{-- Guru avatar + nama --}}
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-sm font-bold flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr($jadwal->guru->nama ?? '?', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm leading-tight">{{ $jadwal->guru->nama ?? '-' }}</p>
                            <p class="text-xs text-slate-400">Guru Pengampu</p>
                        </div>
                    </div>
                    {{-- Nomor urut --}}
                    <span class="w-6 h-6 inline-flex items-center justify-center bg-slate-100 text-slate-500 text-xs font-bold rounded-full flex-shrink-0">
                        {{ $index + 1 }}
                    </span>
                </div>
                <div class="flex flex-wrap gap-1.5">
                    <span class="inline-flex items-center gap-1 bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                    </span>
                    <span class="inline-flex items-center gap-1 bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        {{ $jadwal->rombel->tingkat ?? '-' }} {{ $jadwal->rombel->kode_rombel ?? '-' }} {{ $jadwal->rombel->nama_rombel ?? '-' }}
                    </span>
                    <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        {{ $jadwal->mataPelajaran->nama_mapel ?? '-' }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-4 py-14 text-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <p class="text-slate-600 font-semibold text-sm">Belum ada jadwal</p>
                    <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}"
                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-xl transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali & Atur Jadwal
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        {{-- TABLE FOOTER --}}
        @if($jadwals->count() > 0)
        <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/80 flex flex-wrap items-center gap-3 text-xs text-slate-400">
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span> Jam Pelajaran</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-indigo-500 inline-block"></span> Kelas / Rombel</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span> Mata Pelajaran</span>
            <span class="ml-auto font-medium text-slate-500">
                Total <strong class="text-slate-700">{{ $jadwals->count() }}</strong> sesi
            </span>
        </div>
        @endif

    </div>

    {{-- BACK BUTTON --}}
    <div class="mt-5">
        <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}"
           class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition-colors font-semibold group">
            <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Guru
        </a>
    </div>

</div>
@endsection