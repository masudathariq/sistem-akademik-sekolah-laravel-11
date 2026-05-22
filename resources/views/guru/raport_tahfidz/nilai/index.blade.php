@extends('layouts.guru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-teal-50/30 py-8 px-4">

    <div class="max-w-5xl mx-auto">

        {{-- Header dengan navigasi --}}
        <div class="mb-8">
            {{-- Tombol Kembali --}}
            <div class="mb-5">
                <a href="{{ route('guru.raport-tahfidz.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-gray-800 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7m0 14h11a2 2 0 002-2V7a2 2 0 00-2-2H10" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            {{-- Judul Halaman --}}
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-600 flex items-center justify-center shadow-md shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-teal-600 uppercase tracking-wider">Input Nilai Raport</p>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">Pilih Aspek Penilaian</h1>
                    <p class="text-sm text-gray-500 mt-1 max-w-xl">
                        Pilih aspek penilaian yang akan diisi untuk siswa yang sudah dipilih. Setiap aspek memiliki bobot dan kriteria tersendiri.
                    </p>
                </div>
            </div>
        </div>

        {{-- Konten Utama --}}
        @if($aspeks->isEmpty())
            {{-- State Kosong yang Ramah --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-6 py-16 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Belum Ada Aspek Penilaian</h3>
                <p class="text-sm text-gray-500 max-w-sm mx-auto">
                    Saat ini belum tersedia aspek penilaian. Silakan hubungi admin atau pembina tahfidz untuk menambahkan aspek terlebih dahulu.
                </p>
            </div>
        @else
            {{-- Info jumlah aspek --}}
            <div class="mb-4 flex justify-end">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-teal-50 text-teal-700 text-xs font-medium rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ $aspeks->count() }} aspek tersedia
                </span>
            </div>

            {{-- Daftar Aspek dalam bentuk Card Grid yang responsif --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($aspeks as $index => $aspek)
                <a href="{{ route('guru.raport-nilai.create', $aspek->id) }}"
                   class="group bg-white border border-gray-200 hover:border-teal-300 rounded-xl p-5 flex items-center gap-4 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                    
                    {{-- Nomor urut dengan background dinamis --}}
                    <div class="w-11 h-11 rounded-xl bg-teal-50 group-hover:bg-teal-600 text-teal-700 group-hover:text-white flex items-center justify-center font-bold text-base transition-colors">
                        {{ $index + 1 }}
                    </div>
                    
                    {{-- Nama Aspek --}}
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-gray-800 group-hover:text-teal-700 transition">
                            {{ $aspek->nama_aspek }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-0.5">Klik untuk mulai menilai</p>
                    </div>
                    
                    {{-- Ikon panah --}}
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-teal-500 group-hover:translate-x-1 transition-all" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                @endforeach
            </div>

            {{-- Informasi tambahan di footer --}}
            <div class="mt-8 flex flex-wrap items-center justify-between gap-3 text-xs text-gray-400 border-t border-gray-100 pt-5">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-teal-500"></span>
                    <span>Total {{ $aspeks->count() }} aspek penilaian aktif</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Pilih aspek, lalu isi nilai untuk setiap siswa</span>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection