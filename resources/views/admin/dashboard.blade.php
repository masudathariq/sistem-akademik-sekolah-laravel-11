@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-4 md:p-6 space-y-5">

    {{-- WELCOME BANNER --}}
    <div class="relative bg-gradient-to-r from-slate-800 via-slate-700 to-indigo-800 text-white rounded-2xl shadow-xl p-6 md:p-8 overflow-hidden">
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/5 rounded-full"></div>
        <div class="absolute -bottom-12 right-16 w-32 h-32 bg-white/5 rounded-full"></div>
        <div class="absolute top-6 right-40 w-8 h-8 bg-white/10 rounded-full"></div>
        <div class="absolute bottom-4 right-6 w-5 h-5 bg-indigo-400/30 rounded-full"></div>

        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-slate-300 text-[10px] font-bold uppercase tracking-widest mb-1">Panel Administrator</p>
                <h2 class="text-2xl md:text-3xl font-extrabold mb-1.5 tracking-tight">
                    Halo, {{ auth()->user()->name ?? 'Admin' }} 👋
                </h2>
                <p class="text-slate-300 text-sm leading-relaxed max-w-lg">
                    Kelola seluruh data sistem dari satu panel. Pantau pengguna, siswa, guru, dan aktivitas sistem secara real-time.
                </p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl px-5 py-4 text-center flex-shrink-0 border border-white/15">
                <p class="text-slate-300 text-[10px] uppercase tracking-widest font-bold mb-0.5">Hari Ini</p>
                <p class="text-3xl font-extrabold leading-none">{{ \Carbon\Carbon::now()->translatedFormat('d') }}</p>
                <p class="text-sm font-semibold text-slate-200 mt-0.5">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                <p class="text-slate-400 text-xs mt-1">{{ \Carbon\Carbon::now()->translatedFormat('l') }}</p>
            </div>
        </div>

        <div class="relative mt-5 flex flex-wrap gap-2 text-xs">
            <div class="bg-white/15 border border-white/20 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                Sistem Aktif
            </div>
            <div class="bg-white/15 border border-white/20 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Peran: Administrator
            </div>
            <div class="bg-white/15 border border-white/20 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Login: {{ auth()->user()->last_login_at ? \Carbon\Carbon::parse(auth()->user()->last_login_at)->diffForHumans() : 'Baru saja' }}
            </div>
        </div>
    </div>

    {{-- KPI CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
        @php
        $kpis = [
        ['label'=>'Total User', 'value'=>$totalUser ?? 0, 'color'=>'blue', 'trend'=>'Akun terdaftar', 'up'=>true, 'icon'=>'
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />'],
        ['label'=>'Total Guru', 'value'=>$totalGuru ?? 0, 'color'=>'violet', 'trend'=>'Tenaga pengajar', 'up'=>true, 'icon'=>'
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'],
        ['label'=>'Total Siswa', 'value'=>$totalSiswa ?? 0, 'color'=>'emerald', 'trend'=>'Siswa aktif', 'up'=>true, 'icon'=>'
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />'],
        ['label'=>'Absensi Hari Ini','value'=>$absensiHariIni ?? 0, 'color'=>'amber', 'trend'=>'Tercatat hari ini', 'up'=>true, 'icon'=>'
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />'],
        ];
        $kpiMap = [
        'blue' => ['border'=>'border-blue-200', 'icon'=>'bg-blue-100 text-blue-600', 'val'=>'text-blue-700', 'bar'=>'bg-blue-500'],
        'violet' => ['border'=>'border-violet-200', 'icon'=>'bg-violet-100 text-violet-600', 'val'=>'text-violet-700', 'bar'=>'bg-violet-500'],
        'emerald' => ['border'=>'border-emerald-200', 'icon'=>'bg-emerald-100 text-emerald-600', 'val'=>'text-emerald-700', 'bar'=>'bg-emerald-500'],
        'amber' => ['border'=>'border-amber-200', 'icon'=>'bg-amber-100 text-amber-600', 'val'=>'text-amber-700', 'bar'=>'bg-amber-500'],
        ];
        @endphp
        @foreach($kpis as $k)
        @php $c = $kpiMap[$k['color']]; @endphp
        <div class="bg-white/90 backdrop-blur {{ $c['border'] }} border rounded-2xl shadow-sm p-4 md:p-5 hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute bottom-0 left-0 right-0 h-0.5 {{ $c['bar'] }} opacity-50"></div>
            <div class="flex items-start justify-between mb-3">
                <p class="text-xs text-slate-500 font-semibold leading-tight pr-2">{{ $k['label'] }}</p>
                <div class="w-8 h-8 rounded-xl {{ $c['icon'] }} flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $k['icon'] !!}</svg>
                </div>
            </div>
            <p class="text-2xl md:text-3xl font-extrabold {{ $c['val'] }} leading-none mb-1">{{ number_format($k['value']) }}</p>
            <p class="text-[10px] text-slate-400 font-medium flex items-center gap-1">
                <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
                </svg>
                {{ $k['trend'] }}
            </p>
        </div>
        @endforeach
    </div>

    {{-- MIDDLE ROW: Distribusi Role + Status Sistem --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Distribusi User per Role --}}
        <div class="lg:col-span-2 bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700">Distribusi User per Role</p>
                </div>
                <span class="text-xs text-blue-600 font-semibold hover:underline cursor-pointer">Kelola User →</span>
            </div>
            <div class="p-5 space-y-3">
                @php
                $roles = [
                ['label'=>'Administrator', 'count'=>$jumlahAdmin ?? 0, 'pct'=>$pctAdmin ?? 0, 'color'=>'slate'],
                ['label'=>'Kepala Sekolah','count'=>$jumlahKepsek ?? 0, 'pct'=>$pctKepsek ?? 0, 'color'=>'amber'],
                ['label'=>'Staff TU', 'count'=>$jumlahStaffTu ?? 0, 'pct'=>$pctStaffTu ?? 0, 'color'=>'blue'],
                ['label'=>'Bendahara', 'count'=>$jumlahBendahara ?? 0, 'pct'=>$pctBendahara ?? 0, 'color'=>'indigo'],
                ['label'=>'Guru', 'count'=>$jumlahGuru ?? 0, 'pct'=>$pctGuru ?? 0, 'color'=>'violet'],
                ];
                $barColor = ['slate'=>'bg-slate-500', 'amber'=>'bg-amber-500', 'blue'=>'bg-blue-500', 'indigo'=>'bg-indigo-500', 'violet'=>'bg-violet-500'];
                $badgeColor = [
                'slate' => 'bg-slate-100 text-slate-700 border-slate-200',
                'amber' => 'bg-amber-50 text-amber-700 border-amber-200',
                'blue' => 'bg-blue-50 text-blue-700 border-blue-200',
                'indigo' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                'violet' => 'bg-violet-50 text-violet-700 border-violet-200',
                ];
                @endphp
                @foreach($roles as $r)
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $barColor[$r['color']] }} flex-shrink-0"></span>
                            <span class="text-sm font-medium text-slate-700">{{ $r['label'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs border rounded-full px-2 py-0.5 font-bold {{ $badgeColor[$r['color']] }}">{{ $r['count'] }} akun</span>
                            <span class="text-xs text-slate-400 w-8 text-right">{{ $r['pct'] }}%</span>
                        </div>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="{{ $barColor[$r['color']] }} h-full rounded-full transition-all duration-700"
                            @style(['width'=> $r['pct'] . '%'])>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Total Seluruh Akun</span>
                    <span class="font-bold text-slate-700">{{ $totalUser ?? 0 }} Pengguna</span>
                </div>
            </div>
        </div>

        {{-- Status Sistem --}}
        <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100">
                <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <p class="text-sm font-bold text-slate-700">Status Sistem</p>
            </div>
            <div class="p-5 space-y-1">
                @php
                $sysInfo = [
                ['label'=>'Status Server', 'value'=>'Online & Normal', 'dot'=>'bg-emerald-500', 'vc'=>'text-emerald-600 font-bold'],
                ['label'=>'Versi Aplikasi', 'value'=>'v1.0.0', 'dot'=>'bg-blue-500', 'vc'=>'text-slate-700'],
                ['label'=>'Tahun Ajaran', 'value'=>$tahunAktif->tahun_ajaran ?? '-', 'dot'=>'bg-indigo-500', 'vc'=>'text-slate-700'],
                ['label'=>'Semester', 'value'=>$tahunAktif->semester ?? '-', 'dot'=>'bg-violet-500', 'vc'=>'text-slate-700'],
                ['label'=>'Total Rombel', 'value'=>($totalRombel ?? 0) . ' kelas', 'dot'=>'bg-amber-500', 'vc'=>'text-slate-700'],
                ['label'=>'Total Mapel', 'value'=>($totalMapel ?? 0) . ' mata pelajaran','dot'=>'bg-teal-500', 'vc'=>'text-slate-700'],
                ['label'=>'Login Terakhir', 'value'=>auth()->user()->last_login_at
                ? \Carbon\Carbon::parse(auth()->user()->last_login_at)->diffForHumans()
                : 'Baru saja', 'dot'=>'bg-rose-400', 'vc'=>'text-slate-700'],
                ];
                @endphp
                @foreach($sysInfo as $info)
                <div class="flex items-center justify-between py-2 border-b border-slate-50 last:border-0">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full {{ $info['dot'] }} flex-shrink-0"></span>
                        <span class="text-xs text-slate-500">{{ $info['label'] }}</span>
                    </div>
                    <span class="text-xs {{ $info['vc'] }} text-right">{{ $info['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- AKSES CEPAT --}}
    <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100">
            <div class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <p class="text-sm font-bold text-slate-700">Akses Cepat</p>
        </div>
        <div class="p-4 grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 gap-2.5">
            @php
            $shortcuts = [
            ['label'=>'Kelola User', 'color'=>'blue', 'href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />'],
            ['label'=>'Data Guru', 'color'=>'violet', 'href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'],
            ['label'=>'Data Siswa', 'color'=>'emerald','href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />'],
            ['label'=>'Absensi', 'color'=>'amber', 'href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />'],
            ['label'=>'Jadwal', 'color'=>'teal', 'href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
            ['label'=>'Data Rombel', 'color'=>'rose', 'href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />'],
            ['label'=>'Tahun Ajaran', 'color'=>'indigo', 'href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
            ['label'=>'Log Aktivitas', 'color'=>'slate', 'href'=>'#', 'icon'=>'
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />'],
            ];
            $scMap = [
            'blue' => ['card'=>'bg-blue-50 border-blue-200 hover:bg-blue-100', 'icon'=>'bg-blue-100 text-blue-600', 'txt'=>'text-blue-700'],
            'violet' => ['card'=>'bg-violet-50 border-violet-200 hover:bg-violet-100', 'icon'=>'bg-violet-100 text-violet-600', 'txt'=>'text-violet-700'],
            'emerald' => ['card'=>'bg-emerald-50 border-emerald-200 hover:bg-emerald-100','icon'=>'bg-emerald-100 text-emerald-600', 'txt'=>'text-emerald-700'],
            'amber' => ['card'=>'bg-amber-50 border-amber-200 hover:bg-amber-100', 'icon'=>'bg-amber-100 text-amber-600', 'txt'=>'text-amber-700'],
            'teal' => ['card'=>'bg-teal-50 border-teal-200 hover:bg-teal-100', 'icon'=>'bg-teal-100 text-teal-600', 'txt'=>'text-teal-700'],
            'rose' => ['card'=>'bg-rose-50 border-rose-200 hover:bg-rose-100', 'icon'=>'bg-rose-100 text-rose-600', 'txt'=>'text-rose-700'],
            'indigo' => ['card'=>'bg-indigo-50 border-indigo-200 hover:bg-indigo-100', 'icon'=>'bg-indigo-100 text-indigo-600', 'txt'=>'text-indigo-700'],
            'slate' => ['card'=>'bg-slate-50 border-slate-200 hover:bg-slate-100', 'icon'=>'bg-slate-100 text-slate-600', 'txt'=>'text-slate-700'],
            ];
            @endphp
            @foreach($shortcuts as $sc)
            @php $s = $scMap[$sc['color']]; @endphp
            <a href="{{ $sc['href'] }}" class="flex flex-col items-center gap-2 border rounded-xl px-2 py-3.5 text-center text-xs font-bold transition-colors {{ $s['card'] }} {{ $s['txt'] }}">
                <div class="w-9 h-9 rounded-xl {{ $s['icon'] }} flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $sc['icon'] !!}</svg>
                </div>
                {{ $sc['label'] }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- BOTTOM ROW: Aktivitas Terbaru + User Terbaru --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- Aktivitas Terbaru --}}
        {{-- $aktivitasTerbaru adalah Collection of stdClass dengan properti:
             ->deskripsi  : string
             ->user       : User model
             ->waktu      : Carbon
        --}}
        <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700">Aktivitas Terbaru</p>
                </div>
                <span class="text-xs text-blue-600 font-semibold hover:underline cursor-pointer">Lihat log →</span>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($aktivitasTerbaru ?? [] as $log)
                @php
                $roleColorMap = [
                'admin' => 'bg-slate-100 text-slate-600',
                'staff_tu' => 'bg-blue-100 text-blue-600',
                'bendahara' => 'bg-indigo-100 text-indigo-600',
                'guru' => 'bg-violet-100 text-violet-600',
                'siswa' => 'bg-emerald-100 text-emerald-600',
                'kepsek' => 'bg-amber-100 text-amber-600',
                ];
                $avatarColor = $roleColorMap[$log->user->role ?? ''] ?? 'bg-slate-100 text-slate-600';
                @endphp
                <div class="flex items-start gap-3 px-5 py-3.5 hover:bg-slate-50/60 transition-colors">
                    <div class="w-8 h-8 rounded-full {{ $avatarColor }} flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                        {{ strtoupper(substr($log->user->name ?? '?', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 leading-snug">{{ $log->deskripsi }}</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">
                            {{ $log->user->name ?? '-' }} · {{ \Carbon\Carbon::parse($log->waktu)->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                    <svg class="w-10 h-10 mb-2 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium">Belum ada aktivitas</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- User Terbaru --}}
        <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700">User Terbaru</p>
                </div>
                <span class="text-xs text-blue-600 font-semibold hover:underline cursor-pointer">Kelola semua →</span>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($userTerbaru ?? [] as $u)
                @php
                $roleColors = [
                'admin' => 'bg-slate-100 text-slate-700',
                'staff_tu' => 'bg-blue-100 text-blue-700',
                'bendahara' => 'bg-indigo-100 text-indigo-700',
                'guru' => 'bg-violet-100 text-violet-700',
                'siswa' => 'bg-emerald-100 text-emerald-700',
                'kepsek' => 'bg-amber-100 text-amber-700',
                ];
                $rc = $roleColors[$u->role ?? ''] ?? 'bg-slate-100 text-slate-700';
                @endphp
                <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50/60 transition-colors">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-slate-500 to-indigo-600 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                        {{ strtoupper(substr($u->name ?? '?', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ $u->name }}</p>
                        <p class="text-[11px] text-slate-400">{{ $u->email }}</p>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-1 rounded-full {{ $rc }} capitalize flex-shrink-0">
                        {{ ucfirst(str_replace('_', ' ', $u->role ?? '-')) }}
                    </span>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                    <svg class="w-10 h-10 mb-2 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <p class="text-sm font-medium">Belum ada user terdaftar</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection