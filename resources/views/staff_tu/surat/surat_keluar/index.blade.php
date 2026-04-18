@extends('layouts.staff_tu')

@section('title', 'Surat Keluar')

@section('content')
<div class="space-y-4 pb-24 px-2 sm:px-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-base sm:text-2xl font-bold text-gray-800">📤 Surat Keluar</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Kelola seluruh surat keluar sekolah</p>
        </div>
        <a href="{{ route('staff_tu.surat_keluar.create') }}"
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
        <a href="{{ route('staff_tu.surat_keluar.index', ['status' => 'Draf']) }}"
           class="bg-white border border-yellow-200 hover:shadow-lg transition rounded-xl p-3 sm:p-5 flex justify-between items-center">
            <div>
                <p class="text-[10px] sm:text-sm text-gray-500">Draf</p>
                <h2 class="text-xl sm:text-3xl font-bold text-yellow-500 mt-0.5 sm:mt-1">{{ $countDraf }}</h2>
            </div>
            <div class="text-yellow-400 text-xl sm:text-3xl">📄</div>
        </a>

        <a href="{{ route('staff_tu.surat_keluar.index', ['status' => 'Terkirim']) }}"
           class="bg-white border border-green-200 hover:shadow-lg transition rounded-xl p-3 sm:p-5 flex justify-between items-center">
            <div>
                <p class="text-[10px] sm:text-sm text-gray-500">Terkirim</p>
                <h2 class="text-xl sm:text-3xl font-bold text-green-600 mt-0.5 sm:mt-1">{{ $countTerkirim }}</h2>
            </div>
            <div class="text-green-400 text-xl sm:text-3xl">📤</div>
        </a>

        <a href="{{ route('staff_tu.surat_keluar.index', ['status' => 'Arsip']) }}"
           class="bg-white border border-gray-200 hover:shadow-lg transition rounded-xl p-3 sm:p-5 flex justify-between items-center">
            <div>
                <p class="text-[10px] sm:text-sm text-gray-500">Arsip</p>
                <h2 class="text-xl sm:text-3xl font-bold text-gray-700 mt-0.5 sm:mt-1">{{ $countArsip }}</h2>
            </div>
            <div class="text-gray-400 text-xl sm:text-3xl">🗂️</div>
        </a>
    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <form action="{{ route('staff_tu.surat_keluar.index') }}" method="GET"
              class="grid grid-cols-1 sm:grid-cols-5 gap-3 sm:gap-4">

            <div class="sm:col-span-2">
                <label class="text-xs sm:text-sm font-medium text-gray-600">Pencarian</label>
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nomor / tujuan / perihal..."
                       class="w-full mt-1 text-xs sm:text-sm border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="text-xs sm:text-sm font-medium text-gray-600">Status</label>
                <select name="status"
                        class="w-full mt-1 text-xs sm:text-sm border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                    <option value="">Semua</option>
                    <option value="Draf" {{ request('status') == 'Draf' ? 'selected' : '' }}>Draf</option>
                    <option value="Terkirim" {{ request('status') == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                    <option value="Arsip" {{ request('status') == 'Arsip' ? 'selected' : '' }}>Arsip</option>
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
                <a href="{{ route('staff_tu.surat_keluar.index') }}"
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs sm:text-sm py-2 rounded-lg text-center transition">
                    Reset
                </a>
            </div>

        </form>
    </div>

    {{-- ===== MOBILE VIEW (card style) ===== --}}
    <div class="block sm:hidden space-y-3">
        @forelse($suratKeluar as $index => $surat)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3">

            <div class="flex items-start justify-between mb-2">
                <div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wide">No. Surat</span>
                    <p class="text-xs font-semibold text-blue-800 leading-tight">{{ $surat->nomor_surat }}</p>
                </div>
                @if($surat->status == 'Draf')
                    <span class="text-[10px] px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded-full font-medium border border-yellow-200">Draf</span>
                @elseif($surat->status == 'Terkirim')
                    <span class="text-[10px] px-2 py-0.5 bg-green-100 text-green-700 rounded-full font-medium border border-green-200">Terkirim</span>
                @else
                    <span class="text-[10px] px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full font-medium border border-gray-200">Arsip</span>
                @endif
            </div>

            <div class="mb-1">
                <span class="text-[10px] text-gray-400 uppercase tracking-wide">Perihal</span>
                <p class="text-xs text-gray-700">{{ Str::limit($surat->perihal, 60) }}</p>
            </div>

            <div class="mb-1">
                <span class="text-[10px] text-gray-400 uppercase tracking-wide">Tujuan</span>
                <p class="text-xs text-gray-600">{{ $surat->tujuan }}</p>
            </div>

            <div class="flex gap-3 mb-3">
                <div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wide">Tgl Surat</span>
                    <p class="text-xs text-gray-600">{{ $surat->tanggal_surat->format('d/m/Y') }}</p>
                </div>
                <div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wide">Tgl Keluar</span>
                    <p class="text-xs text-gray-600">{{ $surat->tanggal_keluar->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="flex gap-2 pt-2 border-t border-gray-100">
                <a href="{{ route('staff_tu.surat_keluar.show', $surat) }}"
                   class="flex-1 text-center py-1.5 bg-blue-50 text-blue-700 rounded-lg text-[11px] font-medium border border-blue-200 hover:bg-blue-100 transition">
                    👁️ Lihat
                </a>
                @if(!$surat->isArsip())
                <a href="{{ route('staff_tu.surat_keluar.edit', $surat) }}"
                   class="flex-1 text-center py-1.5 bg-yellow-50 text-yellow-700 rounded-lg text-[11px] font-medium border border-yellow-200 hover:bg-yellow-100 transition">
                    ✏️ Edit
                </a>
                @endif
            </div>

        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 py-10 text-center text-gray-400 text-sm">
            📭 Tidak ada data surat keluar
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
                        <th class="px-4 py-3 text-left">Tgl Keluar</th>
                        <th class="px-4 py-3 text-left">Tujuan</th>
                        <th class="px-4 py-3 text-left">Perihal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($suratKeluar as $index => $surat)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-500">{{ $suratKeluar->firstItem() + $index }}</td>
                        <td class="px-4 py-3 font-semibold text-blue-800">{{ $surat->nomor_surat }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $surat->tanggal_keluar->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $surat->tujuan }}</td>
                        <td class="px-4 py-3">{{ Str::limit($surat->perihal, 40) }}</td>
                        <td class="px-4 py-3">
                            @if($surat->status == 'Draf')
                                <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">Draf</span>
                            @elseif($surat->status == 'Terkirim')
                                <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Terkirim</span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">Arsip</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('staff_tu.surat_keluar.show', $surat) }}"
                                   class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 text-xs font-medium transition border border-blue-200">
                                    👁️ Lihat
                                </a>
                                @if(!$surat->isArsip())
                                <a href="{{ route('staff_tu.surat_keluar.edit', $surat) }}"
                                   class="px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 text-xs font-medium transition border border-yellow-200">
                                    ✏️ Edit
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 text-gray-400">
                            📭 Tidak ada data surat keluar
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($suratKeluar->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $suratKeluar->links() }}
            </div>
        @endif
    </div>

    {{-- PAGINATION MOBILE --}}
    @if($suratKeluar->hasPages())
        <div class="block sm:hidden">
            {{ $suratKeluar->links() }}
        </div>
    @endif

</div>
@endsection