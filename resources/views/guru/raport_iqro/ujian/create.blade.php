@extends('layouts.guru')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Input Nilai Ujian Iqro</h2>
            <p class="text-sm text-gray-500 mt-1">Tambahkan nilai ujian baru untuk siswa Iqro.</p>
        </div>
        <a href="{{ route('guru.raport-iqro.index') }}" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Kembali</a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('guru.raport-iqro-ujian.store') }}" method="POST">
            @csrf
            <div class="grid gap-5 md:grid-cols-2 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Ujian</label>
                    <input type="text" name="nama_ujian" value="{{ old('nama_ujian', $nama_ujian_terakhir ?? '') }}" class="mt-2 w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" placeholder="Contoh: Ujian Iqro Tengah Semester" required>
                    @error('nama_ujian')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Ujian</label>
                    <input type="date" name="tanggal_ujian" value="{{ old('tanggal_ujian') }}" class="mt-2 w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200">
                    @error('tanggal_ujian')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[760px] divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs uppercase tracking-[0.12em] text-gray-600">
                        <tr>
                            <th class="px-5 py-4">Siswa</th>
                            <th class="px-5 py-4">NIS</th>
                            <th class="px-5 py-4">Nilai Ujian</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($siswas as $siswa)
                            <tr>
                                <td class="px-5 py-4 font-medium text-gray-900">{{ $siswa->nama_siswa }}</td>
                                <td class="px-5 py-4">{{ $siswa->nis ?? '-' }}</td>
                                <td class="px-5 py-4">
                                    <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                    <input type="number" name="nilai_ujian[]" min="1" max="100" value="{{ old('nilai_ujian.'.($loop->index), $nilai_ujian[$nama_ujian_terakhir][$siswa->id] ?? '') }}" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" placeholder="0-100" required>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-8 text-center text-gray-500">Belum ada siswa terpilih untuk nilai ujian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-green-600 px-5 py-3 text-sm font-semibold text-white hover:bg-green-700">Simpan Nilai Ujian</button>
            </div>
        </form>
    </div>
</div>
@endsection