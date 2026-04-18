@extends('layouts.admin')

@section('title', 'Pengaturan Jadwal Guru')

@section('content')
<div class="min-h-screen bg-slate-50">

    <div class="max-w-7xl mx-auto px-6 py-6 space-y-6">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-xl font-semibold text-slate-900">
                    Jadwal Guru
                </h1>
                <p class="text-sm text-slate-500">
                    Kelola dan distribusikan jadwal mengajar
                </p>
            </div>

            <div class="flex items-center gap-3">

                {{-- SEARCH --}}
                <div class="relative">
                    <input type="text" placeholder="Cari hari..."
                        class="pl-9 pr-4 py-2 text-sm border rounded-lg 
                               focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </div>

                {{-- BUTTON --}}
                <a href="#"
                   class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg 
                          hover:bg-blue-700 transition shadow-sm">
                    + Tambah Jadwal
                </a>

            </div>
        </div>

        {{-- STATS --}}
        @php
            $totalHari = count($hari);
            $totalTerjadwal = collect($hari)->sum('jadwal_guru_count');
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-white border rounded-xl p-5 flex justify-between items-center">
                <div>
                    <p class="text-sm text-slate-500">Total Hari</p>
                    <h3 class="text-2xl font-semibold text-slate-900">
                        {{ $totalHari }}
                    </h3>
                </div>
                <div class="text-slate-300 text-3xl">📅</div>
            </div>

            <div class="bg-white border rounded-xl p-5 flex justify-between items-center">
                <div>
                    <p class="text-sm text-slate-500">Total Jadwal</p>
                    <h3 class="text-2xl font-semibold text-slate-900">
                        {{ $totalTerjadwal }}
                    </h3>
                </div>
                <div class="text-slate-300 text-3xl">👨‍🏫</div>
            </div>

            <div class="bg-white border rounded-xl p-5 flex justify-between items-center">
                <div>
                    <p class="text-sm text-slate-500">Rata-rata / Hari</p>
                    <h3 class="text-2xl font-semibold text-slate-900">
                        {{ $totalHari > 0 ? round($totalTerjadwal / $totalHari,1) : 0 }}
                    </h3>
                </div>
                <div class="text-slate-300 text-3xl">📊</div>
            </div>

        </div>

        {{-- MAIN GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LIST HARI --}}
            <div class="lg:col-span-2 bg-white border rounded-xl">

                <div class="p-5 border-b flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Daftar Hari
                        </h3>
                        <p class="text-sm text-slate-500">
                            Klik untuk mengatur jadwal
                        </p>
                    </div>
                </div>

                <div class="divide-y">

                    @foreach ($hari as $h)
                    <a href="{{ route('admin.jadwal.show', $h->id) }}"
                       class="flex items-center justify-between px-5 py-4 
                              hover:bg-slate-50 transition group">

                        <div class="flex items-center gap-4">

                            {{-- ICON --}}
                            <div class="w-10 h-10 flex items-center justify-center 
                                        rounded-lg bg-blue-50 text-blue-600 font-semibold">
                                {{ substr($h->nama_hari, 0, 1) }}
                            </div>

                            <div>
                                <p class="font-medium text-slate-800">
                                    {{ $h->nama_hari }}
                                </p>
                                <p class="text-sm text-slate-500">
                                    {{ $h->jadwal_guru_count }} guru
                                </p>
                            </div>

                        </div>

                        <div class="text-slate-400 group-hover:translate-x-1 transition">
                            →
                        </div>

                    </a>
                    @endforeach

                </div>

            </div>

            {{-- SIDEBAR INFO --}}
            <div class="space-y-4">

                <div class="bg-white border rounded-xl p-5">
                    <h4 class="font-semibold text-slate-800 mb-2">
                        Informasi
                    </h4>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Setiap hari berisi daftar jadwal guru.
                        Anda dapat mengatur distribusi mengajar
                        agar lebih merata dan efisien.
                    </p>
                </div>

                <div class="bg-white border rounded-xl p-5">
                    <h4 class="font-semibold text-slate-800 mb-2">
                        Tips
                    </h4>
                    <ul class="text-sm text-slate-500 space-y-1">
                        <li>• Hindari bentrok jadwal</li>
                        <li>• Distribusikan jam secara merata</li>
                        <li>• Prioritaskan mapel utama</li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection