@extends('layouts.staff_tu')

@section('title', 'Surat Masuk')

@section('content')
<div class="space-y-4 pb-24 px-2 sm:px-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-base sm:text-2xl font-bold text-gray-800">📬 Surat Masuk</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Kelola seluruh surat masuk sekolah</p>
        </div>
        <a href="{{ route('staff_tu.surat_masuk.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm px-3 py-2 sm:px-4 sm:py-2 rounded-lg shadow transition">
            ➕ Tambah Surat
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-3 py-2 rounded-lg text-xs sm:text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-200 text-red-700 px-3 py-2 rounded-lg text-xs sm:text-sm">
            ❌ {{ session('error') }}
        </div>
    @endif

    {{-- STATUS CARDS --}}
    <div class="grid grid-cols-3 gap-2 sm:gap-6">
        <div class="bg-white shadow-sm border border-blue-100 rounded-xl p-3 sm:p-6 flex justify-between items-center">
            <div>
                <p class="text-[10px] sm:text-sm text-gray-500">Total Surat</p>
                <p class="text-xl sm:text-3xl font-bold text-blue-600 mt-0.5 sm:mt-1">{{ $totalSurat }}</p>
            </div>
            <div class="text-blue-400 text-xl sm:text-3xl">📨</div>
        </div>

        <div class="bg-white shadow-sm border border-red-100 rounded-xl p-3 sm:p-6 flex justify-between items-center">
            <div>
                <p class="text-[10px] sm:text-sm text-gray-500">Belum Dibaca</p>
                <p class="text-xl sm:text-3xl font-bold text-red-600 mt-0.5 sm:mt-1">{{ $totalBelumDibaca }}</p>
            </div>
            <div class="text-red-400 text-xl sm:text-3xl">📩</div>
        </div>

        <div class="bg-white shadow-sm border border-green-100 rounded-xl p-3 sm:p-6 flex justify-between items-center">
            <div>
                <p class="text-[10px] sm:text-sm text-gray-500">Sudah Dibaca</p>
                <p class="text-xl sm:text-3xl font-bold text-green-600 mt-0.5 sm:mt-1">{{ $totalSudahDibaca }}</p>
            </div>
            <div class="text-green-400 text-xl sm:text-3xl">✅</div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <form action="{{ route('staff_tu.surat_masuk.index') }}" method="GET"
              class="grid grid-cols-1 sm:grid-cols-5 gap-3 sm:gap-4">

            <div class="sm:col-span-2">
                <label class="text-xs sm:text-sm font-medium text-gray-600">Pencarian</label>
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nomor / pengirim / perihal..."
                       class="w-full mt-1 text-xs sm:text-sm border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="text-xs sm:text-sm font-medium text-gray-600">Status</label>
                <select name="status"
                        class="w-full mt-1 text-xs sm:text-sm border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                    <option value="">Semua</option>
                    <option value="Belum Dibaca" {{ request('status') == 'Belum Dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="Sudah Dibaca" {{ request('status') == 'Sudah Dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                </select>
            </div>

            <div>
                <label class="text-xs sm:text-sm font-medium text-gray-600">Jenis</label>
                <input type="text" name="jenis"
                       value="{{ request('jenis') }}"
                       class="w-full mt-1 text-xs sm:text-sm border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm py-2 rounded-lg transition">
                    🔍 Filter
                </button>
                <a href="{{ route('staff_tu.surat_masuk.index') }}"
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs sm:text-sm py-2 rounded-lg text-center transition">
                    Reset
                </a>
            </div>

        </form>
    </div>

    {{-- ===== MOBILE VIEW (card style) ===== --}}
    <div class="block sm:hidden space-y-3">
        @forelse($suratMasuk as $index => $surat)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3">

            <div class="flex items-start justify-between mb-2">
                <div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wide">No. Surat</span>
                    <p class="text-xs font-semibold text-blue-800 leading-tight">{{ $surat->nomor_surat }}</p>
                    @if($surat->lampiran)
                        <p class="text-[10px] text-gray-400 mt-0.5">📎 Ada lampiran</p>
                    @endif
                </div>
                @if($surat->status == 'Belum Dibaca')
                    <span class="text-[10px] px-2 py-0.5 bg-red-100 text-red-600 rounded-full font-medium border border-red-200 whitespace-nowrap">Belum Dibaca</span>
                @else
                    <span class="text-[10px] px-2 py-0.5 bg-green-100 text-green-700 rounded-full font-medium border border-green-200 whitespace-nowrap">Sudah Dibaca</span>
                @endif
            </div>

            <div class="mb-1">
                <span class="text-[10px] text-gray-400 uppercase tracking-wide">Perihal</span>
                <p class="text-xs text-gray-700">{{ Str::limit($surat->perihal, 60) }}</p>
            </div>

            <div class="mb-1">
                <span class="text-[10px] text-gray-400 uppercase tracking-wide">Pengirim</span>
                <p class="text-xs text-gray-600">{{ $surat->pengirim }}</p>
            </div>

            <div class="flex gap-3 mb-3">
                <div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wide">Tgl Surat</span>
                    <p class="text-xs text-gray-600">{{ $surat->tanggal_surat->format('d/m/Y') }}</p>
                </div>
                <div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wide">Tgl Diterima</span>
                    <p class="text-xs text-gray-600">{{ $surat->tanggal_diterima->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="flex gap-2 pt-2 border-t border-gray-100">
                <a href="{{ route('staff_tu.surat_masuk.show', $surat) }}"
                   class="flex-1 text-center py-1.5 bg-blue-50 text-blue-700 rounded-lg text-[11px] font-medium border border-blue-200 hover:bg-blue-100 transition">
                    👁️ Lihat
                </a>
                <a href="{{ route('staff_tu.surat_masuk.edit', $surat) }}"
                   class="flex-1 text-center py-1.5 bg-yellow-50 text-yellow-700 rounded-lg text-[11px] font-medium border border-yellow-200 hover:bg-yellow-100 transition">
                    ✏️ Edit
                </a>
            </div>

        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 py-10 text-center text-gray-400 text-sm">
            📭 Tidak ada data surat masuk
        </div>
        @endforelse
    </div>

    {{-- ===== DESKTOP VIEW (table style) ===== --}}
    <div class="hidden sm:block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nomor</th>
                        <th class="px-4 py-3 text-left">Tgl Surat</th>
                        <th class="px-4 py-3 text-left">Tgl Diterima</th>
                        <th class="px-4 py-3 text-left">Pengirim</th>
                        <th class="px-4 py-3 text-left">Perihal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($suratMasuk as $index => $surat)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-500">{{ $suratMasuk->firstItem() + $index }}</td>
                        <td class="px-4 py-3 font-semibold text-blue-800">
                            {{ $surat->nomor_surat }}
                            @if($surat->lampiran)
                                <div class="text-xs text-gray-400">📎 Ada lampiran</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $surat->tanggal_diterima->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $surat->pengirim }}</td>
                        <td class="px-4 py-3">{{ Str::limit($surat->perihal, 40) }}</td>
                        <td class="px-4 py-3">
                            @if($surat->status == 'Belum Dibaca')
                                <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-600 rounded-full">Belum Dibaca</span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Sudah Dibaca</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('staff_tu.surat_masuk.show', $surat) }}"
                                   class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 text-xs font-medium transition border border-blue-200">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('staff_tu.surat_masuk.edit', $surat) }}"
                                   class="px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 text-xs font-medium transition border border-yellow-200">
                                    ✏️ Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 text-gray-400">
                            📭 Tidak ada data surat masuk
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION DESKTOP --}}
        @if($suratMasuk->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $suratMasuk->links() }}
            </div>
        @endif
    </div>

    {{-- PAGINATION MOBILE --}}
    @if($suratMasuk->hasPages())
        <div class="block sm:hidden">
            {{ $suratMasuk->links() }}
        </div>
    @endif

</div>
@endsection