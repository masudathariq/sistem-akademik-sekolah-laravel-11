@extends('layouts.bendahara')

@section('title', 'Detail Gaji - ' . $guru->nama)

@section('content')
<div class="space-y-6">

{{-- HEADER --}}
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Detail Gaji Guru</h1>
        <p class="text-gray-500 mt-1">
            {{ \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F') }} {{ $tahun }}
        </p>
    </div>
    <a href="{{ route('bendahara.rekap-gaji.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
        ← Kembali
    </a>
</div>

    {{-- INFO GURU --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Informasi Guru</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Nama Lengkap</p>
                <p class="font-semibold">{{ $guru->nama }}</p>
            </div>
            @if(isset($guru->nip))
            <div>
                <p class="text-sm text-gray-500">NIP</p>
                <p class="font-semibold">{{ $guru->nip }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- DETAIL KEHADIRAN --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Detail Kehadiran</h2>
        <div class="space-y-3">
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Hadir Asli (dari absensi)</span>
                <span class="font-semibold">{{ $hadirAsli }} hari</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Koreksi</span>
                <span class="font-semibold {{ $koreksi > 0 ? 'text-green-600' : ($koreksi < 0 ? 'text-red-600' : '') }}">
                    {{ $koreksi > 0 ? '+' : '' }}{{ $koreksi }} hari
                </span>
            </div>
            @if($keteranganKoreksi != '-')
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Keterangan Koreksi</span>
                <span class="text-sm italic text-gray-500">{{ $keteranganKoreksi }}</span>
            </div>
            @endif
            <div class="flex justify-between py-2 bg-blue-50 px-3 rounded">
                <span class="font-semibold text-gray-800">Hadir Final</span>
                <span class="font-bold text-blue-600">{{ $hadirFinal }} hari</span>
            </div>
        </div>
    </div>

    {{-- DETAIL GAJI --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Rincian Gaji</h2>
        
        {{-- GAJI POKOK --}}
        <div class="flex justify-between py-3 border-b">
            <span class="text-gray-600">Gaji Pokok</span>
            <span class="font-semibold">Rp {{ number_format($gajiPokok, 0, ',', '.') }}</span>
        </div>

@if($tahfidz > 0)
<div class="py-3 border-b">
    <div class="flex justify-between">
        <span class="text-gray-600">Insentif Tahfidz</span>
        <span class="font-semibold text-green-600">
            Rp {{ number_format($tahfidz, 0, ',', '.') }}
        </span>
    </div>

    @if($hadirTahfidz > 0)
    <p class="text-xs text-gray-400 mt-1">
        {{ $hadirTahfidz }} hari × 
        Rp {{ number_format($tarifTahfidz, 0, ',', '.') }}
    </p>
    @endif
</div>
@endif




        {{-- TRANSPORT --}}
        <div class="py-3 border-b">
            <div class="flex justify-between">
                <span class="text-gray-600">Transport</span>
                <span class="font-semibold text-green-600">Rp {{ number_format($transport, 0, ',', '.') }}</span>
            </div>
            <p class="text-xs text-gray-400 mt-1">
                {{ $hadirFinal }} hari × Rp {{ number_format($transportPerHari, 0, ',', '.') }}
            </p>
        </div>

        {{-- PENAMBAHAN --}}
        @if($penambahanList->count() > 0)
        <div class="py-3 border-b">
            <p class="font-semibold text-gray-700 mb-2">Penambahan:</p>
            @foreach($penambahanList as $item)
            <div class="flex justify-between py-1 pl-4">
                <span class="text-sm text-gray-600">
                    {{ $item->judul }}
                    <span class="text-xs text-gray-400">({{ $item->tipe }})</span>
                </span>
                <span class="text-sm text-green-600">
                    + Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                </span>
            </div>
            @endforeach
            <div class="flex justify-between py-2 pl-4 bg-green-50 mt-2 rounded">
                <span class="font-semibold text-sm">Subtotal Penambahan</span>
                <span class="font-semibold text-green-600">
                    Rp {{ number_format($totalPenambahan, 0, ',', '.') }}
                </span>
            </div>
        </div>
        @endif

        {{-- PENGURANGAN --}}
        @if($penguranganList->count() > 0)
        <div class="py-3 border-b">
            <p class="font-semibold text-gray-700 mb-2">Pengurangan:</p>
            @foreach($penguranganList as $item)
            <div class="flex justify-between py-1 pl-4">
                <span class="text-sm text-gray-600">
                    {{ $item->judul }}
                    <span class="text-xs text-gray-400">({{ $item->tipe }})</span>
                </span>
                <span class="text-sm text-red-600">
                    - Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                </span>
            </div>
            @endforeach
            <div class="flex justify-between py-2 pl-4 bg-red-50 mt-2 rounded">
                <span class="font-semibold text-sm">Subtotal Pengurangan</span>
                <span class="font-semibold text-red-600">
                    Rp {{ number_format($totalPengurangan, 0, ',', '.') }}
                </span>
            </div>
        </div>
        @endif

        {{-- TOTAL --}}
        <div class="flex justify-between py-4 bg-gradient-to-r from-blue-50 to-blue-100 px-4 rounded-lg mt-4">
            <span class="text-xl font-bold text-gray-800">TOTAL GAJI</span>
            <span class="text-xl font-bold text-blue-600">
                Rp {{ number_format($totalGaji, 0, ',', '.') }}
            </span>
        </div>
    </div>

    {{-- TOMBOL AKSI --}}
    <div class="flex gap-3">
        <button onclick="window.print()" 
                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            🖨️ Cetak Slip Gaji
        </button>
        <a href="{{ route('bendahara.rekap-gaji.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
           class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            Kembali ke Daftar
        </a>
    </div>

</div>

{{-- PRINT STYLES --}}
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .space-y-6, .space-y-6 * {
            visibility: visible;
        }
        .space-y-6 {
            position: absolute;
            left: 0;
            top: 0;
        }
        button, a {
            display: none !important;
        }
    }
</style>
@endsection