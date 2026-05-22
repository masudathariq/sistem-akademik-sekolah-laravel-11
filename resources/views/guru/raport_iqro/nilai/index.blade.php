@extends('layouts.guru')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Input Nilai Aspek Iqro</h2>
            <p class="text-sm text-gray-500 mt-1">Pilih aspek terlebih dahulu untuk mengisi nilai siswa.</p>
        </div>
        <a href="{{ route('guru.raport-iqro-aspeks.index') }}" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Kelola Aspek</a>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($aspeks as $aspek)
            <a href="{{ route('guru.raport-iqro-nilai.create', $aspek->id) }}" class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-green-400 hover:shadow-md">
                <div class="text-sm uppercase tracking-[0.16em] text-gray-500">Aspek</div>
                <div class="mt-3 text-lg font-semibold text-gray-900">{{ $aspek->nama_aspek }}</div>
            </a>
        @empty
            <div class="col-span-full rounded-3xl border border-dashed border-gray-300 bg-gray-50 p-8 text-center text-gray-500">
                Belum ada aspek Iqro. Tambahkan aspek terlebih dahulu di halaman Aspek Penilaian.
            </div>
        @endforelse
    </div>
</div>
@endsection