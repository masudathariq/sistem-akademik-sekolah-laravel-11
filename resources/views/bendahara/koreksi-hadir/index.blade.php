@extends('layouts.bendahara')

@section('content')
<div class="container mx-auto p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Koreksi Kehadiran Guru
        </h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan perbaiki data kehadiran guru untuk perhitungan gaji transport</p>
    </div>

    {{-- INFO BANNER --}}
    <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <h3 class="font-semibold text-blue-800 mb-1">Tentang Koreksi Kehadiran</h3>
                <p class="text-sm text-blue-700">
                    Gunakan fitur ini untuk memperbaiki data kehadiran guru jika terdapat kesalahan input absensi. 
                    Koreksi ini akan mempengaruhi perhitungan gaji transport bulanan.
                </p>
                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2 text-xs text-blue-700">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">✅ Hadir Asli:</span>
                        <span>Data dari absensi harian</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">➕ Koreksi:</span>
                        <span>Penambahan/pengurangan hari</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">📊 Hadir Final:</span>
                        <span>Hasil akhir untuk perhitungan gaji</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER BULAN & TAHUN --}}
    <form method="GET"
          action="{{ route('bendahara.koreksi-hadir.index') }}"
          class="mb-6 bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        
        <div class="flex items-center gap-3 mb-4">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <h3 class="font-semibold text-gray-700">Filter Periode</h3>
        </div>

        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                <select name="bulan" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @for($m=1;$m<=12;$m++)
                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromDate(null,$m,1)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                <input type="number"
                       name="tahun"
                       value="{{ $tahun }}"
                       class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Tampilkan
                </span>
            </button>
        </div>
    </form>

    {{-- STATISTIK RINGKAS --}}
    @if($data->isNotEmpty())
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
                    <p class="text-xl font-bold text-gray-800">{{ $data->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Ada Koreksi</p>
                    <p class="text-xl font-bold text-gray-800">{{ $data->where('koreksi_id')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Belum Dikoreksi</p>
                    <p class="text-xl font-bold text-gray-800">{{ $data->whereNull('koreksi_id')->count() }}</p>
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
                    <p class="text-sm font-bold text-gray-800">
                        {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->isoFormat('MMMM Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- TABEL --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Nama Guru
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Hadir Asli
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Koreksi
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Hadir Final
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($data as $item)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-xs">
                                            {{ substr($item['guru']->nama, 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $item['guru']->nama }}</span>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">
                                    {{ $item['hadir_asli'] }} hari
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if($item['koreksi'] > 0)
                                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                                        +{{ $item['koreksi'] }} hari
                                    </span>
                                @elseif($item['koreksi'] < 0)
                                    <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-bold">
                                        {{ $item['koreksi'] }} hari
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-bold">
                                    {{ max(0, $item['hadir_asli'] + $item['koreksi']) }} hari
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if($item['koreksi_id'])
                                    <a href="{{ route('bendahara.koreksi-hadir.edit', $item['koreksi_id']) }}"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition text-xs font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                @else
                                    <a href="{{ route('bendahara.koreksi-hadir.create', [
                                            'guru_id' => $item['guru']->id,
                                            'bulan' => $bulan,
                                            'tahun' => $tahun
                                        ]) }}"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-xs font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Tambah
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <div>
                                        <p class="text-gray-500 font-medium">Belum ada data guru</p>
                                        <p class="text-sm text-gray-400 mt-1">Pilih bulan dan tahun untuk melihat data kehadiran</p>
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