@extends('layouts.guru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-4 md:p-6">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
        <div>
            <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur border border-blue-100 rounded-full px-3 py-1 text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-2 shadow-sm">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Jadwal Minggu Ini
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">
                Jadwal <span class="text-blue-600">Mengajar</span> Saya
            </h1>
            <p class="text-slate-500 text-sm mt-1">Seluruh jadwal mengajar Anda dalam minggu ini.</p>
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
            @php $totalSesi = collect($jadwals)->flatten()->count(); @endphp
            <div class="bg-white/80 backdrop-blur border border-emerald-100 rounded-2xl px-4 py-2.5 shadow-sm flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 leading-none font-medium">Total Sesi</p>
                    <p class="text-sm font-bold text-slate-700">{{ $totalSesi }} Jadwal</p>
                </div>
            </div>
        </div>
    </div>

    {{-- INFO BANNER --}}
    <div class="bg-blue-50/80 backdrop-blur border border-blue-200 rounded-2xl p-4 mb-6 flex gap-3 items-start">
        <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/></svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-blue-800">Informasi Jadwal</p>
            <p class="text-xs text-blue-700 mt-0.5 leading-relaxed">
                Jadwal mengajar ini diatur oleh admin Tata Usaha. Jika terdapat kesalahan, silakan hubungi admin untuk penyesuaian.
            </p>
        </div>
    </div>

    {{-- JADWAL PER HARI --}}
    @forelse($jadwals as $hari => $items)
        @php
            $dayConfig = [
                'senin'  => ['from' => 'from-blue-600',    'to' => 'to-blue-700',    'ring' => 'ring-blue-200',    'dot' => 'bg-blue-500',    'light' => 'bg-blue-50 border-blue-200 text-blue-700',    'num' => 'bg-blue-100 text-blue-700'],
                'selasa' => ['from' => 'from-violet-600',  'to' => 'to-violet-700',  'ring' => 'ring-violet-200',  'dot' => 'bg-violet-500',  'light' => 'bg-violet-50 border-violet-200 text-violet-700',  'num' => 'bg-violet-100 text-violet-700'],
                'rabu'   => ['from' => 'from-emerald-600', 'to' => 'to-emerald-700', 'ring' => 'ring-emerald-200', 'dot' => 'bg-emerald-500', 'light' => 'bg-emerald-50 border-emerald-200 text-emerald-700', 'num' => 'bg-emerald-100 text-emerald-700'],
                'kamis'  => ['from' => 'from-amber-500',   'to' => 'to-orange-600',  'ring' => 'ring-amber-200',   'dot' => 'bg-amber-500',   'light' => 'bg-amber-50 border-amber-200 text-amber-700',   'num' => 'bg-amber-100 text-amber-700'],
                'jumat'  => ['from' => 'from-rose-600',    'to' => 'to-pink-600',    'ring' => 'ring-rose-200',    'dot' => 'bg-rose-500',    'light' => 'bg-rose-50 border-rose-200 text-rose-700',    'num' => 'bg-rose-100 text-rose-700'],
                'sabtu'  => ['from' => 'from-cyan-600',    'to' => 'to-teal-600',    'ring' => 'ring-cyan-200',    'dot' => 'bg-cyan-500',    'light' => 'bg-cyan-50 border-cyan-200 text-cyan-700',    'num' => 'bg-cyan-100 text-cyan-700'],
                'minggu' => ['from' => 'from-sky-600',     'to' => 'to-sky-700',     'ring' => 'ring-sky-200',     'dot' => 'bg-sky-500',     'light' => 'bg-sky-50 border-sky-200 text-sky-700',     'num' => 'bg-sky-100 text-sky-700'],
            ];
            $cfg = $dayConfig[strtolower($hari)] ?? $dayConfig['senin'];
        @endphp

        <section class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden mb-4">

            {{-- HEADER HARI --}}
            <div class="bg-gradient-to-r {{ $cfg['from'] }} {{ $cfg['to'] }} px-5 py-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-2 h-2 rounded-full bg-white/60"></div>
                    <h3 class="text-base font-extrabold text-white tracking-wide uppercase">
                        {{ ucfirst($hari) }}
                    </h3>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-white/70 text-xs">
                        {{ \Carbon\Carbon::parse(collect($items)->min('jam_mulai'))->format('H:i') }}
                        –
                        {{ \Carbon\Carbon::parse(collect($items)->max('jam_selesai'))->format('H:i') }}
                    </span>
                    <span class="bg-white/25 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                        {{ count($items) }} Sesi
                    </span>
                </div>
            </div>

            {{-- ===== DESKTOP: tabel horizontal ===== --}}
            <div class="hidden md:block divide-y divide-slate-100">
                @foreach($items as $i => $jadwal)
                @php
                    $start    = \Carbon\Carbon::parse($jadwal->jam_mulai);
                    $end      = \Carbon\Carbon::parse($jadwal->jam_selesai);
                    $durasi   = $start->diffInMinutes($end);
                    $jam      = intdiv($durasi, 60);
                    $menit    = $durasi % 60;
                    $durasiTxt = ($jam > 0 ? "{$jam}j " : '') . ($menit > 0 ? "{$menit}m" : '');
                @endphp
                <div class="flex items-center gap-4 px-5 py-3.5 hover:bg-slate-50/80 transition-colors group">
                    <span class="w-6 h-6 inline-flex items-center justify-center {{ $cfg['num'] }} text-xs font-bold rounded-full flex-shrink-0">
                        {{ $i + 1 }}
                    </span>
                    <div class="inline-flex items-center gap-1.5 {{ $cfg['light'] }} border text-xs font-bold px-3 py-1.5 rounded-full flex-shrink-0">
                        <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $start->format('H:i') }} – {{ $end->format('H:i') }}
                    </div>
                    <div class="w-px h-6 bg-slate-200 flex-shrink-0"></div>
                    <span class="inline-flex items-center gap-1.5 bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $jadwal->rombel->nama_rombel }}
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        {{ $jadwal->mataPelajaran->nama_mapel }}
                    </span>
                    <span class="ml-auto text-xs text-slate-400 flex-shrink-0">{{ $durasiTxt }}</span>
                </div>
                @endforeach
            </div>

            {{-- ===== MOBILE: kartu vertikal per sesi ===== --}}
            <div class="md:hidden divide-y divide-slate-100">
                @foreach($items as $i => $jadwal)
                @php
                    $start    = \Carbon\Carbon::parse($jadwal->jam_mulai);
                    $end      = \Carbon\Carbon::parse($jadwal->jam_selesai);
                    $durasi   = $start->diffInMinutes($end);
                    $jam      = intdiv($durasi, 60);
                    $menit    = $durasi % 60;
                    $durasiTxt = ($jam > 0 ? "{$jam}j " : '') . ($menit > 0 ? "{$menit}m" : '');
                @endphp
                <div class="px-4 py-3.5">

                    {{-- Baris atas: nomor + jam + durasi --}}
                    <div class="flex items-center justify-between mb-2.5">
                        <div class="flex items-center gap-2">
                            {{-- Nomor sesi --}}
                            <span class="w-6 h-6 inline-flex items-center justify-center {{ $cfg['num'] }} text-xs font-bold rounded-full flex-shrink-0">
                                {{ $i + 1 }}
                            </span>
                            {{-- Jam --}}
                            <div class="inline-flex items-center gap-1.5 {{ $cfg['light'] }} border text-sm font-bold px-3 py-1.5 rounded-full">
                                <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $start->format('H:i') }} – {{ $end->format('H:i') }}
                            </div>
                        </div>
                        {{-- Durasi --}}
                        <span class="text-xs text-slate-400 font-medium">{{ $durasiTxt }}</span>
                    </div>

                    {{-- Baris bawah: kelas + mapel dalam 2 kotak penuh --}}
                    <div class="grid grid-cols-2 gap-2">
                        {{-- Kelas / Rombel --}}
                        <div class="bg-indigo-50 border border-indigo-200 rounded-xl px-3 py-2.5">
                            <p class="text-[10px] text-indigo-400 font-semibold uppercase tracking-wider mb-0.5">Kelas</p>
                            <p class="text-sm font-bold text-indigo-800 leading-tight">{{ $jadwal->rombel->nama_rombel }}</p>
                        </div>
                        {{-- Mata Pelajaran --}}
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-3 py-2.5">
                            <p class="text-[10px] text-emerald-500 font-semibold uppercase tracking-wider mb-0.5">Mata Pelajaran</p>
                            <p class="text-sm font-bold text-emerald-800 leading-tight">{{ $jadwal->mataPelajaran->nama_mapel }}</p>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            {{-- CARD FOOTER --}}
            <div class="px-5 py-2.5 border-t border-slate-100 bg-slate-50/60 flex items-center gap-3 text-[11px] text-slate-400 flex-wrap">
                <span class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    {{ count($items) }} mata pelajaran
                </span>
                <span class="text-slate-200">|</span>
                <span class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Mulai {{ \Carbon\Carbon::parse(collect($items)->min('jam_mulai'))->format('H:i') }}
                    &ndash;
                    Selesai {{ \Carbon\Carbon::parse(collect($items)->max('jam_selesai'))->format('H:i') }}
                </span>
            </div>

        </section>
    @empty
        <div class="bg-white/90 backdrop-blur border border-dashed border-slate-300 rounded-2xl p-12 text-center shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-slate-700 font-bold text-lg">Belum Ada Jadwal Mengajar</p>
            <p class="text-slate-400 text-sm mt-1 max-w-xs mx-auto">
                Jadwal mengajar akan tampil di sini setelah diatur oleh admin Tata Usaha.
            </p>
            <div class="mt-5 inline-flex items-center gap-2 bg-blue-50 border border-blue-200 text-blue-700 text-sm font-medium px-4 py-2 rounded-xl">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/></svg>
                Hubungi admin jika jadwal belum muncul
            </div>
        </div>
    @endforelse

</div>
@endsection