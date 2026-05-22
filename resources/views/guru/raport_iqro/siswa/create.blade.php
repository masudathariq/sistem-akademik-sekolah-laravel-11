@extends('layouts.guru')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Pilih Siswa untuk Raport Iqro</h2>
            <p class="text-sm text-gray-500 mt-1">Pilih siswa yang akan masuk dalam daftar raport Iqro Anda.</p>
        </div>
        <a href="{{ route('guru.raport-iqro.index') }}" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            ← Kembali ke Daftar Raport
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
        <form action="{{ route('guru.raport-iqro-siswa.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <p class="text-sm text-gray-600">Centang siswa yang akan Anda kelola di raport Iqro. Jika siswa tidak dicentang, maka data raport Iqro tidak akan ditampilkan di halaman utama.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wide">
                            <th class="px-4 py-3 border border-gray-200 w-20">Pilih</th>
                            <th class="px-4 py-3 border border-gray-200">Nama Siswa</th>
                            <th class="px-4 py-3 border border-gray-200">NIS</th>
                            <th class="px-4 py-3 border border-gray-200">Kelas / Rombel</th>
                            <th class="px-4 py-3 border border-gray-200">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $siswa)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3 border border-gray-200">
                                    <input type="checkbox" name="siswa_id[]" value="{{ $siswa->id }}" class="h-4 w-4 text-green-600 border-gray-300 rounded" {{ in_array($siswa->id, old('siswa_id', $selected_siswa ?? [])) ? 'checked' : '' }}>
                                </td>
                                <td class="px-4 py-3 border border-gray-200 font-medium text-gray-800">{{ $siswa->nama_siswa }}</td>
                                <td class="px-4 py-3 border border-gray-200">{{ $siswa->nis ?? '-' }}</td>
                                <td class="px-4 py-3 border border-gray-200">{{ $siswa->rombel->tingkat_romawi ?? '-' }} / {{ $siswa->rombel->nama_rombel ?? '-' }}</td>
                                <td class="px-4 py-3 border border-gray-200">
                                    @if(in_array($siswa->id, old('siswa_id', $selected_siswa ?? [])))
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Terpilih</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Belum</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Tidak ada siswa terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @error('siswa_id')
                <p class="mt-4 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700">
                    Simpan Pilihan Siswa
                </button>
                <a href="{{ route('guru.raport-iqro.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Batalkan
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
