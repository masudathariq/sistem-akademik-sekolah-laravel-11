@extends('layouts.staff_tu')

@section('content')

<div class="px-2 sm:px-0">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
        <h2 class="text-base sm:text-xl font-bold text-gray-800">
            📄 Data Surat Aktif Siswa
        </h2>
        <a href="{{ route('staff_tu.surat-aktif.create') }}">
            <button class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm px-3 py-2 sm:px-4 sm:py-2 rounded-lg transition flex items-center justify-center gap-1">
                <span class="text-base leading-none">+</span> Buat Surat
            </button>
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded text-xs sm:text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- ===== MOBILE VIEW (card style) ===== --}}
    <div class="block sm:hidden space-y-3">
        @forelse($surats as $surat)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3">

            <div class="flex items-start justify-between mb-2">
                <div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wide">No. Surat</span>
                    <p class="text-xs font-semibold text-blue-800 leading-tight">{{ $surat->nomor_surat }}</p>
                </div>
                <span class="text-[10px] bg-blue-50 text-blue-500 px-2 py-0.5 rounded-full font-medium border border-blue-100">
                    #{{ $loop->iteration }}
                </span>
            </div>

            <div class="mb-1">
                <span class="text-[10px] text-gray-400 uppercase tracking-wide">Nama Siswa</span>
                <p class="text-xs font-medium text-gray-700">{{ $surat->siswa->nama_siswa ?? '-' }}</p>
            </div>

            <div class="mb-1">
                <span class="text-[10px] text-gray-400 uppercase tracking-wide">Rombel</span>
                <p class="text-xs text-gray-600">
                    {{ $surat->siswa->rombel->tingkat ?? '-' }} - {{ $surat->siswa->rombel->nama_rombel ?? '-' }}
                </p>
            </div>

            <div class="mb-3">
                <span class="text-[10px] text-gray-400 uppercase tracking-wide">Tanggal Surat</span>
                <p class="text-xs text-gray-600">{{ $surat->tanggal_surat }}</p>
            </div>

            <div class="flex gap-2 pt-2 border-t border-gray-100">
                <a href="{{ route('staff_tu.surat-aktif.edit', $surat->id) }}"
                   class="flex-1 text-center py-1.5 bg-yellow-50 text-yellow-700 rounded-lg text-[11px] font-medium border border-yellow-200 hover:bg-yellow-100 transition">
                    ✏️ Edit
                </a>
                <a href="{{ route('staff_tu.surat-aktif.cetak', $surat->id) }}" target="_blank"
                   class="flex-1 text-center py-1.5 bg-green-50 text-green-700 rounded-lg text-[11px] font-medium border border-green-200 hover:bg-green-100 transition">
                    🖨️ Cetak
                </a>
                <form action="{{ route('staff_tu.surat-aktif.destroy', $surat->id) }}"
                      method="POST"
                      class="flex-1"
                      onsubmit="return confirm('Yakin hapus surat ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full py-1.5 bg-red-50 text-red-700 rounded-lg text-[11px] font-medium border border-red-200 hover:bg-red-100 transition">
                        🗑️ Hapus
                    </button>
                </form>
            </div>

        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 py-10 text-center text-gray-400 text-sm">
            Belum ada surat aktif.
        </div>
        @endforelse
    </div>

    {{-- ===== DESKTOP VIEW (table style) ===== --}}
    <div class="hidden sm:block overflow-x-auto rounded-xl shadow">
        <table class="min-w-full bg-white overflow-hidden">
            <thead class="bg-blue-900 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-5 py-3 text-left w-10">No</th>
                    <th class="px-5 py-3 text-left">Nomor Surat</th>
                    <th class="px-5 py-3 text-left">Nama Siswa</th>
                    <th class="px-5 py-3 text-left">Rombel</th>
                    <th class="px-5 py-3 text-left">Tanggal Surat</th>
                    <th class="px-5 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                @forelse($surats as $surat)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-5 py-3 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-5 py-3 font-medium text-blue-800">{{ $surat->nomor_surat }}</td>
                    <td class="px-5 py-3">{{ $surat->siswa->nama_siswa ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-500">
                        {{ $surat->siswa->rombel->tingkat ?? '-' }} - {{ $surat->siswa->rombel->nama_rombel ?? '-' }}
                    </td>
                    <td class="px-5 py-3 text-gray-500">{{ $surat->tanggal_surat }}</td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('staff_tu.surat-aktif.edit', $surat->id) }}"
                               class="px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 text-xs font-medium transition border border-yellow-200">
                                ✏️ Edit
                            </a>
                            <a href="{{ route('staff_tu.surat-aktif.cetak', $surat->id) }}" target="_blank"
                               class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 text-xs font-medium transition border border-green-200">
                                🖨️ Cetak
                            </a>
                            <form action="{{ route('staff_tu.surat-aktif.destroy', $surat->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Yakin hapus surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-xs font-medium transition border border-red-200">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-400">
                        Belum ada surat aktif.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection