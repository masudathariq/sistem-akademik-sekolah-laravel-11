@extends('layouts.staff_tu')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">

{{-- PAGE HEADER --}}
<div class="mb-10">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
        <span class="hover:text-gray-600 transition">Jadwal & Kurikulum</span>
        <span>›</span>
        <span class="text-blue-600 font-semibold">Jadwal Mengajar</span>
    </div>

    {{-- Main Header Card --}}
    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            {{-- Left Content --}}
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="text-3xl">📅</span>
                    Jadwal Mengajar
                </h1>

                <p class="text-gray-500 mt-2 text-sm md:text-base max-w-xl">
                    Pilih hari untuk melihat daftar jadwal mengajar guru beserta mata pelajaran dan kelas yang diampu.
                </p>

                {{-- Info Badge --}}
                <div class="mt-4 inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z" />
                    </svg>
                    <span>Total <strong>{{ count($haris) }} Hari</strong> tersedia</span>
                </div>
            </div>

            {{-- Right Action --}}
            <div class="flex items-center">
                <a href="{{ route('staff_tu.jadwal_pelajaran.jadwalLengkap') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-3 rounded-xl shadow-sm transition duration-200">

                    <span>📋</span>
                    Lihat Jadwal Lengkap
                </a>
            </div>

        </div>
    </div>

</div>

    {{-- INFO CARD --}}
    <div class="bg-white border border-amber-200 rounded-2xl p-4 mb-8 flex gap-3 items-start shadow-sm">
        <div class="bg-amber-100 text-amber-600 rounded-xl p-2 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-700">Cara Menggunakan Fitur Ini</p>
            <p class="text-sm text-gray-500 mt-0.5">
                Klik salah satu kartu hari di bawah untuk melihat jadwal lengkap mengajar guru pada hari tersebut,
                termasuk jam pelajaran, nama guru, mata pelajaran, dan kelas yang diajar.
            </p>
        </div>
    </div>

    {{-- DAY CARDS GRID --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-4">
        @php
        $dayConfig = [
        'senin' => ['icon' => '🌅', 'color' => 'blue', 'label' => 'Hari pertama dalam sepekan'],
        'selasa' => ['icon' => '☀️', 'color' => 'indigo', 'label' => 'Hari kedua dalam sepekan'],
        'rabu' => ['icon' => '🌤️', 'color' => 'violet', 'label' => 'Tengah pekan'],
        'kamis' => ['icon' => '🌥️', 'color' => 'purple', 'label' => 'Menuju akhir pekan'],
        'jumat' => ['icon' => '✨', 'color' => 'teal', 'label' => 'Hari jumat berkah'],
        'sabtu' => ['icon' => '🌙', 'color' => 'cyan', 'label' => 'Akhir pekan pertama'],
        'minggu' => ['icon' => '🎯', 'color' => 'sky', 'label' => 'Akhir pekan'],
        ];

        $colorMap = [
        'blue' => ['bg' => 'bg-blue-600', 'hover' => 'hover:bg-blue-700', 'light' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-200', 'badge' => 'bg-blue-100 text-blue-700'],
        'indigo' => ['bg' => 'bg-indigo-600', 'hover' => 'hover:bg-indigo-700', 'light' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-200', 'badge' => 'bg-indigo-100 text-indigo-700'],
        'violet' => ['bg' => 'bg-violet-600', 'hover' => 'hover:bg-violet-700', 'light' => 'bg-violet-50', 'text' => 'text-violet-600', 'border' => 'border-violet-200', 'badge' => 'bg-violet-100 text-violet-700'],
        'purple' => ['bg' => 'bg-purple-600', 'hover' => 'hover:bg-purple-700', 'light' => 'bg-purple-50', 'text' => 'text-purple-600', 'border' => 'border-purple-200', 'badge' => 'bg-purple-100 text-purple-700'],
        'teal' => ['bg' => 'bg-teal-600', 'hover' => 'hover:bg-teal-700', 'light' => 'bg-teal-50', 'text' => 'text-teal-600', 'border' => 'border-teal-200', 'badge' => 'bg-teal-100 text-teal-700'],
        'cyan' => ['bg' => 'bg-cyan-600', 'hover' => 'hover:bg-cyan-700', 'light' => 'bg-cyan-50', 'text' => 'text-cyan-600', 'border' => 'border-cyan-200', 'badge' => 'bg-cyan-100 text-cyan-700'],
        'sky' => ['bg' => 'bg-sky-600', 'hover' => 'hover:bg-sky-700', 'light' => 'bg-sky-50', 'text' => 'text-sky-600', 'border' => 'border-sky-200', 'badge' => 'bg-sky-100 text-sky-700'],
        ];
        @endphp

        @foreach($haris as $index => $hari)
        @php
        $key = strtolower($hari);
        $config = $dayConfig[$key] ?? ['icon' => '📅', 'color' => 'blue', 'label' => 'Lihat jadwal hari ini'];
        $colors = $colorMap[$config['color']];
        @endphp

        <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}"
            class="group bg-white border {{ $colors['border'] }} rounded-2xl p-5 flex flex-col items-center gap-3
                      shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1 cursor-pointer relative overflow-hidden">

            {{-- Background Accent --}}
            <div class="absolute top-0 right-0 w-20 h-20 {{ $colors['light'] }} rounded-bl-full opacity-60 transition-all duration-200 group-hover:w-28 group-hover:h-28"></div>

            {{-- Day Number Badge --}}
            <div class="absolute top-3 left-3 text-[10px] font-bold {{ $colors['badge'] }} px-1.5 py-0.5 rounded-full">
                H{{ $index + 1 }}
            </div>

            {{-- Icon --}}
            <div class="text-3xl mt-2 z-10">{{ $config['icon'] }}</div>

            {{-- Day Name --}}
            <div class="text-center z-10">
                <p class="font-bold text-gray-800 text-sm uppercase tracking-wide">{{ $hari }}</p>
                <p class="text-[11px] text-gray-400 mt-0.5">{{ $config['label'] }}</p>
            </div>

            {{-- CTA --}}
            <div class="{{ $colors['bg'] }} {{ $colors['hover'] }} text-white text-xs font-medium px-3 py-1.5 rounded-lg
                            w-full text-center transition-colors duration-200 z-10 flex items-center justify-center gap-1">
                Lihat Jadwal
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>
        @endforeach
    </div>

    {{-- LEGEND / KETERANGAN --}}
    <div class="mt-8 bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
        <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Informasi yang Tersedia di Setiap Jadwal Harian
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span class="w-7 h-7 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-base">👨‍🏫</span>
                Nama Guru
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span class="w-7 h-7 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-base">📚</span>
                Mata Pelajaran
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span class="w-7 h-7 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-base">🏫</span>
                Kelas / Rombel
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span class="w-7 h-7 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-base">⏰</span>
                Jam Pelajaran
            </div>
        </div>
    </div>

</div>
@endsection