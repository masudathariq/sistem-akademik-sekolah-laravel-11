@extends('layouts.bendahara')

@section('title', 'Rekap Gaji Bulanan')

@section('content')
@php
    $namaBulan = \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F');
@endphp

<div class="container mx-auto p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Rekap Gaji Bulanan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Lihat dan kelola rekap gaji guru per bulan. Cetak atau kirim slip gaji langsung ke guru.
        </p>
    </div>

    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="mb-6 flex items-start gap-3 bg-emerald-50 border-l-4 border-emerald-500 px-4 py-3 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <p class="font-semibold text-emerald-800">Berhasil</p>
                <p class="text-sm text-emerald-700">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    {{-- ERROR ALERT --}}
    @if (session('error'))
        <div class="mb-6 flex items-start gap-3 bg-red-50 border-l-4 border-red-500 px-4 py-3 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <p class="font-semibold text-red-800">Gagal</p>
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    {{-- INFO BANNER --}}
    <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <h3 class="font-semibold text-blue-800 mb-1">Tentang Rekap Gaji</h3>
                <p class="text-sm text-blue-700">
                    Rekap gaji menampilkan total perhitungan gaji setiap guru berdasarkan gaji pokok, tunjangan, pengurangan, dan transport kehadiran. Klik nama guru untuk melihat detail slip gaji.
                </p>
            </div>
        </div>
    </div>

    {{-- FILTER & ACTION BUTTONS --}}
    <div class="mb-6 bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center gap-3 mb-4">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            <h3 class="font-semibold text-gray-700">Filter Periode & Aksi</h3>
        </div>

        <div class="flex flex-wrap gap-3 items-end">
            {{-- FORM FILTER --}}
            <form method="GET" class="flex gap-3 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                    <select name="bulan" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create(null, $i, 1)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <select name="tahun" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @for ($y = now()->year - 2; $y <= now()->year + 1; $y++)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Tampilkan
                </button>
            </form>

            {{-- CETAK SEMUA --}}
            <a href="{{ route('bendahara.rekap-gaji.cetak-semua', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Semua Slip
            </a>

            {{-- KIRIM SLIP --}}
            <form method="POST"
                action="{{ route('bendahara.rekap-gaji.kirim-slip') }}"
                onsubmit="return confirm('Kirim slip gaji periode {{ $namaBulan }} {{ $tahun }} ke semua guru?')">
                @csrf
                <input type="hidden" name="bulan" value="{{ $bulan }}">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Kirim Slip Gaji
                </button>
            </form>
        </div>
    </div>

    {{-- STATISTICS CARDS --}}
    @if(count($rekap) > 0)
    @php
        $totalGajiPokok = collect($rekap)->sum('gaji_pokok');
        $totalDibayar = collect($rekap)->sum('total');
    @endphp
    <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Guru</p>
                    <p class="text-xl font-bold text-gray-800">{{ count($rekap) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Periode</p>
                    <p class="text-lg font-bold text-gray-800">{{ $namaBulan }} {{ $tahun }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Gaji Pokok</p>
                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($totalGajiPokok, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Dibayar</p>
                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

{{-- TABEL --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-xs"> {{-- font tabel lebih kecil --}}
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-[11px]">
                <tr>
                    <th class="px-3 py-2 text-center font-semibold text-gray-700">No</th>
                    <th class="px-3 py-2 text-left font-semibold text-gray-700">
                        <div class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Guru
                        </div>
                    </th>
                    <th class="px-3 py-2 text-right font-semibold text-gray-700">Mengajar</th>
                    <th class="px-3 py-2 text-right font-semibold text-gray-700">Tunjangan</th>
                    <th class="px-3 py-2 text-right font-semibold text-gray-700">Potongan</th>
                    <th class="px-3 py-2 text-center font-semibold text-gray-700">Hadir</th>
                    <th class="px-3 py-2 text-right font-semibold text-gray-700">Transport</th>
                    <th class="px-3 py-2 text-right font-semibold text-gray-700">Tahfidz</th>
                    <th class="px-3 py-2 text-right font-semibold text-gray-700">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-[11px]">
                @forelse ($rekap as $i => $item)
                <tr class="hover:bg-blue-50 transition-colors text-[11px]">
                    <td class="px-3 py-2 text-center text-gray-600">{{ $i + 1 }}</td>
                    <td class="px-3 py-2">
                        <a href="{{ route('bendahara.rekap-gaji.show', [
                                'guru' => $item['guru']->id,
                                'bulan' => $bulan,
                                'tahun' => $tahun
                            ]) }}"
                            class="flex items-center gap-1 text-blue-600 hover:text-blue-800 font-medium text-[11px]">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold text-[10px]">
                                    {{ substr($item['guru']->nama, 0, 1) }}
                                </span>
                            </div>
                            {{ $item['guru']->nama }}
                        </a>
                    </td>
                    <td class="px-3 py-2 text-right font-semibold text-gray-800">
                        Rp {{ number_format($item['gaji_pokok'], 0, ',', '.') }}
                    </td>
                    <td class="px-3 py-2 text-right">
                        <span class="inline-flex items-center px-1.5 py-0.5 bg-green-100 text-green-700 rounded text-[10px] font-semibold">
                            +Rp {{ number_format($item['penambahan'], 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="px-3 py-2 text-right">
                        <span class="inline-flex items-center px-1.5 py-0.5 bg-red-100 text-red-700 rounded text-[10px] font-semibold">
                            -Rp {{ number_format($item['pengurangan'], 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="px-3 py-2 text-center">
                        <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold">
                            {{ $item['hadir_final'] }} hari
                        </span>
                    </td>
                    <td class="px-3 py-2 text-right">
                        <span class="inline-flex items-center px-1.5 py-0.5 bg-green-100 text-green-700 rounded text-[10px] font-semibold">
                            +Rp {{ number_format($item['transport'], 0, ',', '.') }}
                        </span>
                    </td>
                                        <td class="px-3 py-2 text-right">
                        <span class="inline-flex items-center px-1.5 py-0.5 bg-green-100 text-green-700 rounded text-[10px] font-semibold">
                            +Rp {{ number_format($item['tahfidz'], 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="px-3 py-2 text-right">
                        <span class="text-sm font-bold text-gray-800 text-[11px]">
                            Rp {{ number_format($item['total'], 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-3 py-8 text-center">
                        <div class="flex flex-col items-center gap-2 text-[11px]">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-500 font-medium">Data tidak tersedia</p>
                                <p class="text-gray-400 mt-1">Pilih bulan dan tahun untuk melihat rekap gaji</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


</div>
@endsection