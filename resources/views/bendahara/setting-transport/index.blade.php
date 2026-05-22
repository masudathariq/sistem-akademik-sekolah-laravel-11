@extends('layouts.bendahara')

@section('content')
<div class="container mx-auto p-6">

    {{-- Header --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Setting Gaji Transport</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola nominal transport harian guru</p>
        </div>
        <a href="{{ route('bendahara.setting-transport.edit') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition-colors duration-200 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Setting
        </a>
    </div>

    {{-- Main Info Card --}}
    <div class="bg-gradient-to-br from-green-50 to-emerald-50 shadow-lg rounded-xl p-6 border-2 border-green-200 mb-6">
        <div class="flex items-start gap-4">
            <div class="p-3 bg-green-600 rounded-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Gaji Transport Per Hari</h2>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-bold text-green-700">
                        Rp {{ number_format($setting?->transport_per_hari ?? 0, 0, ',', '.') }}
                    </span>
                    <span class="text-sm text-gray-600">/hari</span>
                </div>
                <p class="text-sm text-gray-600 mt-2">
                    Nominal ini akan dikalikan dengan jumlah hari hadir guru setiap bulannya
                </p>
            </div>
        </div>
    </div>

    {{-- Informasi Tambahan Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        
        {{-- Card: Cara Kerja --}}
        <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Cara Kerja</h3>
            </div>
            <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start gap-2">
                    <span class="text-blue-600 mt-1">•</span>
                    <span>Transport dihitung berdasarkan jumlah hari hadir</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-600 mt-1">•</span>
                    <span>Rumus: <code class="bg-gray-100 px-1 rounded">Hari Hadir × Transport/Hari</code></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-600 mt-1">•</span>
                    <span>Otomatis masuk ke rekap gaji bulanan</span>
                </li>
            </ul>
        </div>

        {{-- Card: Contoh Perhitungan --}}
        <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Contoh Perhitungan</h3>
            </div>
            <div class="space-y-3 text-sm">
                <div class="bg-purple-50 p-3 rounded-lg">
                    <p class="text-gray-700 mb-2">Jika guru hadir <span class="font-semibold">20 hari</span>:</p>
                    <p class="text-lg font-bold text-purple-700">
                        20 × Rp {{ number_format($setting?->transport_per_hari ?? 0, 0, ',', '.') }} = 
                        <span class="text-purple-900">
                            Rp {{ number_format(($setting?->transport_per_hari ?? 0) * 20, 0, ',', '.') }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Card: Tips --}}
        <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Tips</h3>
            </div>
            <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start gap-2">
                    <span class="text-yellow-600 mt-1">💡</span>
                    <span>Update nominal jika ada perubahan kebijakan</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-yellow-600 mt-1">💡</span>
                    <span>Pastikan data absensi guru sudah akurat</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-yellow-600 mt-1">💡</span>
                    <span>Cek rekap gaji untuk verifikasi hasil</span>
                </li>
            </ul>
        </div>

    </div>

    {{-- Update History (Optional) --}}
    @if($setting && $setting->updated_at)
    <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
        <div class="flex items-center gap-3 mb-3">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="font-semibold text-gray-800">Informasi Update</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-600">Terakhir diubah:</span>
                <span class="font-medium text-gray-800 ml-2">
                    {{ $setting->updated_at->translatedFormat('d F Y') }}
                </span>
            </div>
            <div>
                <span class="text-gray-600">Jam:</span>
                <span class="font-medium text-gray-800 ml-2">
                    {{ $setting->updated_at->format('H:i') }} WIB
                </span>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection