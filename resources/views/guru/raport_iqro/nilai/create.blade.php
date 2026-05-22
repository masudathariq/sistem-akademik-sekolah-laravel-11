@extends('layouts.guru')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Nilai Aspek: {{ $aspek->nama_aspek }}</h2>
            <p class="text-sm text-gray-500 mt-1">Isi nilai untuk siswa yang dipilih di raport Iqro.</p>
        </div>
        <a href="{{ route('guru.raport-iqro-nilai.index') }}" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Pilih Aspek Lain</a>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('guru.raport-iqro-nilai.store', $aspek->id) }}" method="POST">
            @csrf

            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs uppercase tracking-[0.12em] text-gray-600">
                        <tr>
                            <th class="px-5 py-4">Siswa</th>
                            <th class="px-5 py-4">NIS</th>
                            <th class="px-5 py-4">Kelas</th>
                            <th class="px-5 py-4">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($siswas as $siswa)
                            <tr>
                                <td class="px-5 py-4 font-medium text-gray-900">{{ $siswa->nama_siswa }}</td>
                                <td class="px-5 py-4">{{ $siswa->nis ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $siswa->rombel->tingkat_romawi ?? '-' }} / {{ $siswa->rombel->nama_rombel ?? '-' }}</td>
                                <td class="px-5 py-4">
                                    <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                    <select name="nilai[]" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                                        <option value="">Pilih nilai</option>
                                        @foreach([1 => '★', 2 => '★★', 3 => '★★★', 4 => '★★★★'] as $value => $label)
                                            <option value="{{ $value }}" {{ old('nilai.'.($loop->index), $nilai[$siswa->id] ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-8 text-center text-gray-500">Belum ada siswa untuk diisi nilai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @error('nilai')
                <p class="mt-4 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-green-600 px-5 py-3 text-sm font-semibold text-white hover:bg-green-700">Simpan Nilai</button>
            </div>
        </form>
    </div>
</div>
@endsection