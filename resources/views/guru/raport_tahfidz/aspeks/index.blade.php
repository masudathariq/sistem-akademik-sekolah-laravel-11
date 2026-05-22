@extends('layouts.guru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-teal-50/30 py-8 px-4">
<div class="max-w-4xl mx-auto">

    {{-- Header + Tombol Kembali --}}
    <div class="flex items-center justify-between gap-3 flex-wrap mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('guru.raport-tahfidz.index') }}" 
               class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-800 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <div>
                <p class="text-xs font-semibold text-teal-600 uppercase tracking-widest mb-1">
                    Raport Tahfidz
                </p>
                <h1 class="text-2xl font-bold text-gray-900">
                    Daftar Aspek Penilaian
                </h1>
            </div>
        </div>

        <a href="{{ route('guru.raport-aspeks.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Aspek
        </a>
    </div>

    {{-- BANNER INFORMASI (konsisten dengan warna teal) --}}
    <div class="mb-6 rounded-2xl border border-teal-200 bg-gradient-to-br from-teal-50 via-white to-teal-50/30 p-5 shadow-sm">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-600 text-white flex items-center justify-center shadow-md flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <h3 class="text-sm font-bold text-gray-900">Informasi Pengelolaan Aspek Penilaian Tahfidz</h3>
                    <span class="px-2.5 py-1 rounded-full bg-teal-100 text-teal-700 text-[10px] font-bold uppercase tracking-wide">Penting</span>
                </div>
                <div class="text-sm text-gray-600 leading-7">
                    Halaman ini digunakan untuk mengatur seluruh aspek penilaian raport tahfidz siswa, seperti penilaian hafalan,
                    kelancaran membaca, tajwid, adab, murojaah, dan berbagai indikator lainnya yang berkaitan dengan
                    perkembangan pembelajaran tahfidz siswa.
                    <br><br>
                    Demi menjaga keamanan data dan konsistensi penilaian,
                    <strong class="text-teal-700">fitur tambah, edit, dan hapus aspek hanya diperbolehkan untuk Pembina Tahfidz yang bertanggung jawab</strong>.
                    Guru lain diharapkan tidak melakukan perubahan data aspek tanpa izin atau koordinasi terlebih dahulu dengan pembina utama.
                    <br><br>
                    Setiap perubahan aspek penilaian akan berpengaruh langsung terhadap proses pengisian raport tahfidz siswa,
                    sehingga seluruh data harus dikelola dengan hati-hati, teliti, dan sesuai dengan ketentuan pembelajaran tahfidz
                    yang berlaku di sekolah.
                </div>
            </div>
        </div>
    </div>

    {{-- Alert (konsisten dengan warna sukses) --}}
    @if(session('success'))
    <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-3 rounded-xl">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Empty State (konsisten) --}}
    @if($aspeks->isEmpty())
    <div class="bg-white border-2 border-dashed border-gray-200 rounded-2xl py-14 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <p class="text-sm font-semibold text-gray-600 mb-1">Belum ada aspek</p>
        <p class="text-xs text-gray-400 mb-4">Tambahkan aspek penilaian untuk raport tahfidz.</p>
        <a href="{{ route('guru.raport-aspeks.create') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-teal-600 hover:text-teal-800 transition-colors">
            Tambah Aspek Pertama
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    @else
    {{-- Info jumlah aspek --}}
    <div class="mb-3 flex justify-end">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-teal-50 text-teal-700 text-xs font-medium rounded-full">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            {{ $aspeks->count() }} aspek tersedia
        </span>
    </div>

    {{-- List Aspek dengan card modern --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="divide-y divide-gray-100">
            @foreach($aspeks as $index => $aspek)
            <div class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50 transition-colors">
                <span class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 text-xs font-bold flex items-center justify-center flex-shrink-0">
                    {{ $index + 1 }}
                </span>
                <span class="flex-1 text-sm font-semibold text-gray-800">
                    {{ $aspek->nama_aspek }}
                </span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('guru.raport-aspeks.edit', $aspek->id) }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('guru.raport-aspeks.destroy', $aspek->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aspek ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-500 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Footer informasi --}}
    <div class="mt-5 text-center text-xs text-gray-400">
        <span>Aspek yang sudah dinilai tidak dapat dihapus jika terdapat data nilai.</span>
    </div>
    @endif

</div>
</div>
@endsection