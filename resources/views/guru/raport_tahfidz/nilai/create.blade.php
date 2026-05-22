@extends('layouts.guru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-teal-50/30 py-8 px-4">
    <div class="max-w-6xl mx-auto">

        {{-- Header dengan navigasi --}}
        <div class="mb-8">
            {{-- Tombol Kembali --}}
            <div class="mb-5">
                <a href="{{ route('guru.raport-nilai.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-gray-800 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7m0 14h11a2 2 0 002-2V7a2 2 0 00-2-2H10" />
                    </svg>
                    Kembali ke Daftar Aspek
                </a>
            </div>

            {{-- Judul Halaman --}}
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-600 flex items-center justify-center shadow-md shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-teal-600 uppercase tracking-wider">Input Nilai Raport</p>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">{{ $aspek->nama_aspek }}</h1>
                    <p class="text-sm text-gray-500 mt-1 max-w-2xl">
                        Berikan nilai untuk setiap siswa pada aspek ini. Nilai menggunakan skala 1–4 dengan deskripsi yang jelas.
                    </p>
                </div>
            </div>
        </div>

        {{-- Form Input Nilai --}}
        <form action="{{ route('guru.raport-nilai.store', $aspek->id) }}" method="POST">
            @csrf

            {{-- Informasi skala nilai --}}
            <div class="bg-teal-50/50 rounded-xl p-4 mb-6 border border-teal-100 flex flex-wrap gap-4 justify-between items-center text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium text-gray-700">Skala Penilaian:</span>
                </div>
                <div class="flex flex-wrap gap-3 text-xs">
                    <span class="px-2 py-1 bg-white rounded-lg shadow-sm">1 = Belum baik / Belum berkembang</span>
                    <span class="px-2 py-1 bg-white rounded-lg shadow-sm">2 = Cukup baik / Mulai berkembang</span>
                    <span class="px-2 py-1 bg-white rounded-lg shadow-sm">3 = Baik / Berkembang sesuai harapan</span>
                    <span class="px-2 py-1 bg-white rounded-lg shadow-sm">4 = Sangat baik / Berkembang sangat baik</span>
                </div>
            </div>

            {{-- Info jumlah siswa --}}
            <div class="mb-4 flex justify-end">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-teal-50 text-teal-700 text-xs font-medium rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    {{ $siswas->count() }} Siswa
                </span>
            </div>

            {{-- Daftar Siswa dalam bentuk card grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                @foreach($siswas as $index => $siswa)
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition hover:border-teal-200">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center font-bold text-sm shrink-0">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $siswa->nama_siswa }}</h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                NIS: {{ $siswa->nis ?? '-' }} · 
                                Kelas: {{ $siswa->rombel->tingkat_romawi ?? '' }} {{ $siswa->rombel->nama_rombel ?? '' }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Pilih Nilai</label>
                        <select name="nilai[]" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition bg-white">
                            <option value="">-- Pilih nilai --</option>
                            <option value="1" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==1 ? 'selected' : '' }}>1 - Belum baik / Belum berkembang</option>
                            <option value="2" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==2 ? 'selected' : '' }}>2 - Cukup baik / Mulai berkembang</option>
                            <option value="3" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==3 ? 'selected' : '' }}>3 - Baik / Berkembang sesuai harapan</option>
                            <option value="4" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==4 ? 'selected' : '' }}>4 - Sangat baik / Berkembang sangat baik</option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Tombol aksi (sticky) --}}
            <div class="sticky bottom-4 flex justify-end gap-3 bg-white/90 backdrop-blur-sm p-4 rounded-xl shadow-md border border-gray-200">
                <a href="{{ route('guru.raport-nilai.index') }}" 
                   class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 shadow-sm transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Semua Nilai
                </button>
            </div>

            {{-- Footer informasi --}}
            <div class="mt-4 text-center text-xs text-gray-400">
                <span>Pastikan semua nilai sudah diisi sebelum menyimpan.</span>
            </div>
        </form>
    </div>
</div>
@endsection