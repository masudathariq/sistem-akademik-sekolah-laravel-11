@extends('layouts.guru')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Pengisian Bacaan Iqro</h2>
            <p class="text-sm text-gray-500 mt-1">Isi target bacaan dan capaian Iqro untuk siswa.</p>
        </div>
        <a href="{{ route('guru.raport-iqro-bacaan.index') }}" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Kembali</a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('guru.raport-iqro-bacaan.store') }}" method="POST">
            @csrf
            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs uppercase tracking-[0.12em] text-gray-600">
                        <tr>
                            <th class="px-5 py-4">Siswa</th>
                            <th class="px-5 py-4">Iqro Terakhir</th>
                            <th class="px-5 py-4">Halaman Terakhir</th>
                            <th class="px-5 py-4">Iqro Target</th>
                            <th class="px-5 py-4">Halaman Target</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($siswas as $siswa)
                            @php $bacaanSiswa = $bacaan[$siswa->id] ?? null; @endphp
                            <tr>
                                <td class="px-5 py-4 font-medium text-gray-900">{{ $siswa->nama_siswa }}</td>
                                <td class="px-5 py-4">
                                    <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                    <input type="text" name="iqro_terakhir[]" value="{{ old('iqro_terakhir.'.($loop->index), $bacaanSiswa->iqro_terakhir ?? '') }}" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" placeholder="Contoh: 3" required>
                                </td>
                                <td class="px-5 py-4">
                                    <input type="text" name="halaman_terakhir[]" value="{{ old('halaman_terakhir.'.($loop->index), $bacaanSiswa->halaman_terakhir ?? '') }}" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" placeholder="Contoh: 35" required>
                                </td>
                                <td class="px-5 py-4">
                                    <input type="text" name="iqro_lanjut[]" value="{{ old('iqro_lanjut.'.($loop->index), $bacaanSiswa->iqro_lanjut ?? '') }}" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" placeholder="Contoh: 4" required>
                                </td>
                                <td class="px-5 py-4">
                                    <input type="text" name="halaman_lanjut[]" value="{{ old('halaman_lanjut.'.($loop->index), $bacaanSiswa->halaman_lanjut ?? '') }}" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" placeholder="Contoh: 48" required>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-8 text-center text-gray-500">Belum ada siswa terpilih untuk raport Iqro.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-green-600 px-5 py-3 text-sm font-semibold text-white hover:bg-green-700">Simpan Bacaan</button>
            </div>
        </form>
    </div>
</div>
@endsection