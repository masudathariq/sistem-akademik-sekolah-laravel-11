@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 py-6 space-y-6">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-xl font-semibold text-slate-900">
                    Jadwal Harian
                </h1>
                <p class="text-sm text-slate-500">
                    Kelola jadwal operasional per tanggal
                </p>
            </div>

            <div class="flex items-center gap-3">

                {{-- SEARCH --}}
                <div class="relative">
                    <input type="text" placeholder="Cari tanggal / keterangan..."
                        class="pl-9 pr-4 py-2 text-sm border rounded-lg 
                               focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </div>

                {{-- BUTTON --}}
                <a href="{{ route('admin.jadwal-harian.create') }}"
                   class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg 
                          hover:bg-blue-700 transition shadow-sm">
                    + Tambah
                </a>

            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white border rounded-xl overflow-hidden">

            {{-- HEADER --}}
            <div class="px-5 py-4 border-b flex items-center justify-between">
                <h3 class="font-semibold text-slate-800">
                    Data Jadwal
                </h3>
                <span class="text-sm text-slate-500">
                    {{ $jadwal->count() }} data
                </span>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">

                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-5 py-3 text-left font-medium">Tanggal</th>
                            <th class="px-5 py-3 text-left font-medium">Hari</th>
                            <th class="px-5 py-3 text-left font-medium">Mode</th>
                            <th class="px-5 py-3 text-left font-medium">Keterangan</th>
                            <th class="px-5 py-3 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($jadwal as $item)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-5 py-4 font-medium text-slate-800">
                                {{ $item->tanggal }}
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $item->hari }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 text-xs rounded-full
                                    {{ $item->mode === 'SEMUA'
                                        ? 'bg-emerald-100 text-emerald-600'
                                        : 'bg-amber-100 text-amber-600' }}">
                                    {{ $item->mode }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-slate-600 max-w-xs truncate">
                                {{ $item->keterangan }}
                            </td>

                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end items-center gap-3">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.jadwal-harian.edit', $item->id) }}"
                                       class="text-slate-400 hover:text-blue-600 transition">
                                        ✏️
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.jadwal-harian.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-slate-400 hover:text-red-600 transition">
                                            🗑️
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="text-3xl">📅</div>
                                    <p>Belum ada jadwal</p>
                                    <a href="{{ route('admin.jadwal-harian.create') }}"
                                       class="text-blue-600 text-sm hover:underline">
                                        Tambah jadwal pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

        {{-- INFO --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">
            <h4 class="font-medium text-blue-700 mb-1">
                Informasi
            </h4>
            <p class="text-sm text-blue-600">
                Mode <strong>SEMUA</strong> berlaku untuk seluruh kegiatan sekolah.
                Gunakan keterangan untuk menambahkan catatan khusus.
            </p>
        </div>

    </div>
</div>
@endsection