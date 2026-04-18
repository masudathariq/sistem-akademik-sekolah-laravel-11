@extends('layouts.bendahara')

@section('title', 'Dashboard Bendahara')
@section('page-title', 'Dashboard Bendahara')

@section('content')

{{-- Welcome Banner --}}
<div class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-600 text-white rounded-2xl shadow-xl p-6 md:p-8 mb-6 overflow-hidden">
    {{-- Decorative circles --}}
    <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full"></div>
    <div class="absolute -bottom-10 -right-4 w-28 h-28 bg-white/5 rounded-full"></div>
    <div class="absolute top-4 right-32 w-8 h-8 bg-white/10 rounded-full"></div>

    <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-blue-200 text-xs font-semibold uppercase tracking-widest mb-1">Selamat datang kembali</p>
            <h2 class="text-2xl md:text-3xl font-extrabold mb-2 tracking-tight">
                {{ auth()->user()->name ?? 'Bendahara' }} 👋
            </h2>
            <p class="text-blue-100 text-sm leading-relaxed max-w-lg">
                Pantau keuangan, kelola transaksi, dan pastikan laporan berjalan transparan, tertib, dan akurat.
            </p>
        </div>
        {{-- Date & time display --}}
        <div class="bg-white/15 backdrop-blur rounded-2xl px-5 py-4 text-center flex-shrink-0 border border-white/20">
            <p class="text-blue-100 text-[10px] uppercase tracking-widest font-semibold mb-0.5">Hari Ini</p>
            <p class="text-xl font-extrabold leading-tight">{{ \Carbon\Carbon::now()->translatedFormat('d') }}</p>
            <p class="text-sm font-semibold text-blue-100">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
            <p class="text-blue-200 text-xs mt-1">{{ \Carbon\Carbon::now()->translatedFormat('l') }}</p>
        </div>
    </div>

    {{-- Feature pills --}}
    <div class="relative mt-5 flex flex-wrap gap-2 text-xs">
        <div class="bg-white/20 border border-white/20 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Monitoring Keuangan
        </div>
        <div class="bg-white/20 border border-white/20 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Kelola Transaksi
        </div>
        <div class="bg-white/20 border border-white/20 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            Arsip & Laporan
        </div>
        <div class="bg-white/20 border border-white/20 px-3 py-1.5 rounded-full font-semibold flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            Peran: Bendahara
        </div>
    </div>
</div>

{{-- KPI Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6">
    @php
        $kpis = [
            [
                'label'   => 'Total Pemasukan',
                'value'   => $totalPemasukan ?? 0,
                'format'  => 'currency',
                'change'  => '+12% bulan ini',
                'up'      => true,
                'color'   => 'emerald',
                'icon'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>',
            ],
            [
                'label'   => 'Total Pengeluaran',
                'value'   => $totalPengeluaran ?? 0,
                'format'  => 'currency',
                'change'  => '-3% bulan ini',
                'up'      => false,
                'color'   => 'rose',
                'icon'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>',
            ],
            [
                'label'   => 'Saldo Berjalan',
                'value'   => $saldo ?? 0,
                'format'  => 'currency',
                'change'  => 'Per hari ini',
                'up'      => true,
                'color'   => 'blue',
                'icon'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>',
            ],
            [
                'label'   => 'Transaksi Bulan Ini',
                'value'   => $jumlahTransaksi ?? 0,
                'format'  => 'number',
                'change'  => 'Total transaksi',
                'up'      => true,
                'color'   => 'violet',
                'icon'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
            ],
        ];

        $colorMap = [
            'emerald' => ['bg' => 'bg-emerald-50',  'border' => 'border-emerald-200', 'icon' => 'bg-emerald-100 text-emerald-600', 'val' => 'text-emerald-700', 'bar' => 'bg-emerald-500'],
            'rose'    => ['bg' => 'bg-rose-50',     'border' => 'border-rose-200',    'icon' => 'bg-rose-100 text-rose-600',       'val' => 'text-rose-700',    'bar' => 'bg-rose-500'],
            'blue'    => ['bg' => 'bg-blue-50',     'border' => 'border-blue-200',    'icon' => 'bg-blue-100 text-blue-600',       'val' => 'text-blue-700',    'bar' => 'bg-blue-500'],
            'violet'  => ['bg' => 'bg-violet-50',   'border' => 'border-violet-200',  'icon' => 'bg-violet-100 text-violet-600',   'val' => 'text-violet-700',  'bar' => 'bg-violet-500'],
        ];
    @endphp

    @foreach($kpis as $kpi)
    @php $c = $colorMap[$kpi['color']]; @endphp
    <div class="bg-white/90 backdrop-blur {{ $c['border'] }} border rounded-2xl shadow-sm p-4 md:p-5 hover:shadow-md transition-shadow relative overflow-hidden">
        <div class="absolute bottom-0 left-0 right-0 h-0.5 {{ $c['bar'] }} opacity-60"></div>
        <div class="flex items-start justify-between mb-3">
            <p class="text-xs text-slate-500 font-semibold leading-tight">{{ $kpi['label'] }}</p>
            <div class="w-8 h-8 rounded-xl {{ $c['icon'] }} flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $kpi['icon'] !!}</svg>
            </div>
        </div>
        <p class="text-lg md:text-xl font-extrabold {{ $c['val'] }} leading-tight mb-1">
            @if($kpi['format'] === 'currency')
                Rp {{ number_format($kpi['value'], 0, ',', '.') }}
            @else
                {{ number_format($kpi['value']) }}
            @endif
        </p>
        <p class="text-[10px] text-slate-400 flex items-center gap-1">
            @if($kpi['up'])
                <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
            @else
                <svg class="w-3 h-3 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
            @endif
            {{ $kpi['change'] }}
        </p>
    </div>
    @endforeach
</div>

{{-- Middle Row: Tagihan + Aktivitas --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Tagihan / Status Pembayaran --}}
    <div class="lg:col-span-2 bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2M9 12l2 2 4-4"/></svg>
                </div>
                <p class="text-sm font-bold text-slate-700">Status Tagihan</p>
            </div>
            <span class="text-xs text-blue-600 font-semibold hover:underline cursor-pointer">Lihat semua →</span>
        </div>
        <div class="p-5 space-y-3">
            @php
                $tagihanItems = [
                    ['label' => 'Lunas',          'count' => $tagihanLunas ?? 0,    'pct' => $pctLunas ?? 72,   'color' => 'emerald'],
                    ['label' => 'Belum Lunas',    'count' => $tagihanBelum ?? 0,    'pct' => $pctBelum ?? 20,   'color' => 'amber'],
                    ['label' => 'Menunggak',      'count' => $tagihanMenunggak ?? 0,'pct' => $pctMenunggak ?? 8,'color' => 'rose'],
                ];
                $barColor = ['emerald' => 'bg-emerald-500', 'amber' => 'bg-amber-400', 'rose' => 'bg-rose-500'];
                $badgeColor = ['emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'amber' => 'bg-amber-50 text-amber-700 border-amber-200', 'rose' => 'bg-rose-50 text-rose-600 border-rose-200'];
            @endphp
            @foreach($tagihanItems as $t)
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full {{ $barColor[$t['color']] }}"></span>
                        <span class="text-sm font-medium text-slate-700">{{ $t['label'] }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs border rounded-full px-2 py-0.5 font-bold {{ $badgeColor[$t['color']] }}">{{ $t['count'] }} siswa</span>
                        <span class="text-xs text-slate-400 w-8 text-right">{{ $t['pct'] }}%</span>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Total summary --}}
            <div class="pt-2 mt-2 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Total Siswa Terdaftar</span>
                <span class="font-bold text-slate-700">{{ ($tagihanLunas ?? 0) + ($tagihanBelum ?? 0) + ($tagihanMenunggak ?? 0) }} Siswa</span>
            </div>
        </div>
    </div>

    {{-- Info & Status Sistem --}}
    <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center gap-2 px-5 py-4 border-b border-slate-100">
            <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/></svg>
            </div>
            <p class="text-sm font-bold text-slate-700">Info Sistem</p>
        </div>
        <div class="p-5 space-y-3">
            @php
                $infoItems = [
                    ['label' => 'Status Sistem',    'value' => 'Aktif & Normal',                                                         'dot' => 'bg-emerald-500', 'val_color' => 'text-emerald-600'],
                    ['label' => 'Tahun Ajaran',     'value' => $tahunAktif->tahun_ajaran ?? '-',                                          'dot' => 'bg-blue-500',    'val_color' => 'text-slate-700'],
                    ['label' => 'Semester',         'value' => $tahunAktif->semester ?? '-',                                              'dot' => 'bg-indigo-500',  'val_color' => 'text-slate-700'],
                    ['label' => 'Login Terakhir',   'value' => auth()->user()->last_login_at ? \Carbon\Carbon::parse(auth()->user()->last_login_at)->diffForHumans() : 'Baru saja', 'dot' => 'bg-violet-500', 'val_color' => 'text-slate-700'],
                    ['label' => 'Peran Aktif',      'value' => 'Bendahara',                                                               'dot' => 'bg-amber-500',   'val_color' => 'text-amber-600 font-bold'],
                ];
            @endphp
            @foreach($infoItems as $item)
            <div class="flex items-center justify-between py-1.5 border-b border-slate-50 last:border-0">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full {{ $item['dot'] }} flex-shrink-0"></span>
                    <span class="text-xs text-slate-500">{{ $item['label'] }}</span>
                </div>
                <span class="text-xs font-semibold {{ $item['val_color'] }} text-right">{{ $item['value'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

</div>

{{-- Bottom Row: Transaksi Terbaru + Akses Cepat --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Transaksi Terbaru --}}
    <div class="lg:col-span-2 bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                </div>
                <p class="text-sm font-bold text-slate-700">Transaksi Terbaru</p>
            </div>
            <span class="text-xs text-blue-600 font-semibold hover:underline cursor-pointer">Lihat semua →</span>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse($transaksiTerbaru ?? [] as $trx)
            @php
                $isPemasukan = ($trx->jenis ?? 'pemasukan') === 'pemasukan';
            @endphp
            <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50/60 transition-colors">
                <div class="w-9 h-9 rounded-xl {{ $isPemasukan ? 'bg-emerald-100' : 'bg-rose-100' }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 {{ $isPemasukan ? 'text-emerald-600' : 'text-rose-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($isPemasukan)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                        @endif
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $trx->keterangan ?? 'Transaksi' }}</p>
                    <p class="text-[11px] text-slate-400">{{ \Carbon\Carbon::parse($trx->tanggal ?? now())->translatedFormat('d M Y') }}</p>
                </div>
                <span class="font-bold text-sm flex-shrink-0 {{ $isPemasukan ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $isPemasukan ? '+' : '-' }}Rp {{ number_format($trx->jumlah ?? 0, 0, ',', '.') }}
                </span>
            </div>
            @empty
            {{-- Placeholder rows --}}
            @foreach([
                ['ket' => 'SPP Bulan Juli', 'tgl' => 'Hari ini', 'jml' => 'Rp 1.500.000', 'in' => true],
                ['ket' => 'Pembelian ATK', 'tgl' => 'Kemarin', 'jml' => 'Rp 250.000', 'in' => false],
                ['ket' => 'Dana BOS Triwulan', 'tgl' => '2 hari lalu', 'jml' => 'Rp 8.000.000', 'in' => true],
                ['ket' => 'Listrik & Air', 'tgl' => '3 hari lalu', 'jml' => 'Rp 350.000', 'in' => false],
            ] as $p)
            <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50/60 transition-colors">
                <div class="w-9 h-9 rounded-xl {{ $p['in'] ? 'bg-emerald-100' : 'bg-rose-100' }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 {{ $p['in'] ? 'text-emerald-600' : 'text-rose-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($p['in'])
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                        @endif
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800">{{ $p['ket'] }}</p>
                    <p class="text-[11px] text-slate-400">{{ $p['tgl'] }}</p>
                </div>
                <span class="font-bold text-sm {{ $p['in'] ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $p['in'] ? '+' : '-' }}{{ $p['jml'] }}
                </span>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>

    {{-- Akses Cepat --}}
    <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">
        <div class="flex items-center gap-2 px-5 py-4 border-b border-slate-100">
            <div class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <p class="text-sm font-bold text-slate-700">Akses Cepat</p>
        </div>
        <div class="p-4 grid grid-cols-2 gap-2">
            @php
                $shortcuts = [
                    ['label' => 'Input Pemasukan',  'href' => '#', 'color' => 'emerald', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>'],
                    ['label' => 'Input Pengeluaran','href' => '#', 'color' => 'rose',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>'],
                    ['label' => 'Laporan Bulanan',  'href' => '#', 'color' => 'blue',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
                    ['label' => 'Data Tagihan',     'href' => '#', 'color' => 'amber',   'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>'],
                    ['label' => 'Cetak Kwitansi',   'href' => '#', 'color' => 'violet',  'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>'],
                    ['label' => 'Export Excel',     'href' => '#', 'color' => 'teal',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>'],
                ];
                $scMap = [
                    'emerald' => 'bg-emerald-50 border-emerald-200 text-emerald-700 hover:bg-emerald-100',
                    'rose'    => 'bg-rose-50 border-rose-200 text-rose-700 hover:bg-rose-100',
                    'blue'    => 'bg-blue-50 border-blue-200 text-blue-700 hover:bg-blue-100',
                    'amber'   => 'bg-amber-50 border-amber-200 text-amber-700 hover:bg-amber-100',
                    'violet'  => 'bg-violet-50 border-violet-200 text-violet-700 hover:bg-violet-100',
                    'teal'    => 'bg-teal-50 border-teal-200 text-teal-700 hover:bg-teal-100',
                ];
                $scIcon = [
                    'emerald' => 'bg-emerald-100 text-emerald-600',
                    'rose'    => 'bg-rose-100 text-rose-600',
                    'blue'    => 'bg-blue-100 text-blue-600',
                    'amber'   => 'bg-amber-100 text-amber-600',
                    'violet'  => 'bg-violet-100 text-violet-600',
                    'teal'    => 'bg-teal-100 text-teal-600',
                ];
            @endphp
            @foreach($shortcuts as $sc)
            <a href="{{ $sc['href'] }}"
               class="flex flex-col items-center gap-2 border rounded-xl px-2 py-3 text-center text-xs font-semibold transition-colors {{ $scMap[$sc['color']] }}">
                <div class="w-8 h-8 rounded-lg {{ $scIcon[$sc['color']] }} flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $sc['icon'] !!}</svg>
                </div>
                {{ $sc['label'] }}
            </a>
            @endforeach
        </div>
    </div>

</div>

@endsection