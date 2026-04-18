@extends('layouts.bendahara')

@section('content')
<div class="container mx-auto p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Data Pengurangan Gaji
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola semua pengurangan gaji guru seperti potongan, denda, atau pinjaman.
        </p>
    </div>

    {{-- INFO BANNER --}}
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div class="flex-1">
                <h3 class="font-semibold text-red-800 mb-1">Tentang Data Pengurangan</h3>
                <p class="text-sm text-red-700">
                    Setiap pengurangan akan mengurangi total gaji yang diterima guru. Pastikan nominal dan tipe pengurangan sesuai agar perhitungan gaji akurat.
                </p>
                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2 text-xs text-red-700">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">💸 Jumlah:</span>
                        <span>Nominal pengurangan per guru</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">👥 Tipe:</span>
                        <span>Semua Guru / Guru Tertentu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTICS CARDS --}}
    <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-100 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Pengurangan</p>
                    <p class="text-xl font-bold text-gray-800">{{ $pengurangans->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-orange-100 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Semua Guru</p>
                    <p class="text-xl font-bold text-gray-800">{{ $pengurangans->where('tipe', 'semua')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Guru Tertentu</p>
                    <p class="text-xl font-bold text-gray-800">{{ $pengurangans->where('tipe', 'tertentu')->count() }}</p>
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
                    <p class="text-xs text-gray-500">Total Nominal</p>
                    <p class="text-xl font-bold text-gray-800">Rp {{ number_format($pengurangans->sum('jumlah'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- BUTTON TAMBAH --}}
    <div class="mb-4 flex justify-end">
        <a href="{{ route('bendahara.pengurangan.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pengurangan
        </a>
    </div>

    {{-- TABEL DATA PENGURANGAN --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Judul
                            </div>
                        </th>
                        <th class="px-4 py-3 text-right font-semibold text-gray-700">
                            <div class="flex items-center justify-end gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Jumlah
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Tipe
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Guru
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Keterangan
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Tanggal Dibuat
                            </div>
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pengurangans as $item)
                    <tr class="hover:bg-red-50 transition-colors">
                        <td class="px-4 py-3">
                            <span class="font-medium text-gray-800">{{ $item->judul }}</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="font-semibold text-red-600">- Rp {{ number_format($item->jumlah,0,',','.') }}</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($item->tipe === 'semua')
                                <span class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">
                                    Semua Guru
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                    Guru Tertentu
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($item->tipe === 'semua')
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-orange-600 font-semibold text-sm">Semua Guru</span>
                                </div>
                            @else
                                @if(is_array($item->guru_id) && count($item->guru_id))
                                <div class="space-y-1">
                                    @foreach($item->guru_id as $gid)
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center">
                                            <span class="text-purple-600 font-semibold text-xs">
                                                {{ substr($guruMap[$gid] ?? 'G', 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="text-sm text-gray-700">{{ $guruMap[$gid] ?? '-' }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <span class="text-gray-400 text-sm">-</span>
                                @endif
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-gray-600 text-sm">{{ $item->keterangan ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-gray-600 text-sm">{{ $item->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('bendahara.pengurangan.edit', $item->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition text-xs font-medium">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('bendahara.pengurangan.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus data pengurangan ini?')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-xs font-medium">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-gray-500 font-medium">Belum ada data pengurangan</p>
                                    <p class="text-sm text-gray-400 mt-1">Klik tombol "Tambah Pengurangan" untuk menambahkan data baru</p>
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