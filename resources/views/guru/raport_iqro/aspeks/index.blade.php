@extends('layouts.guru')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Daftar Aspek Raport Iqro</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola aspek penilaian yang digunakan dalam raport Iqro.</p>
        </div>
        <a href="{{ route('guru.raport-iqro-aspeks.create') }}" class="inline-flex items-center gap-2 rounded-full bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">Tambah Aspek</a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-3xl border border-gray-200 bg-white shadow-sm">
        <table class="w-full min-w-[720px] divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-[0.12em] text-gray-600">
                <tr>
                    <th class="px-5 py-4">No</th>
                    <th class="px-5 py-4">Nama Aspek</th>
                    <th class="px-5 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($aspeks as $index => $aspek)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4">{{ $index + 1 }}</td>
                        <td class="px-5 py-4">{{ $aspek->nama_aspek }}</td>
                        <td class="px-5 py-4 space-x-2">
                            <a href="{{ route('guru.raport-iqro-aspeks.edit', $aspek->id) }}" class="inline-flex rounded-full border border-green-600 px-4 py-2 text-sm font-semibold text-green-700 hover:bg-green-50">Ubah</a>
                            <form action="{{ route('guru.raport-iqro-aspeks.destroy', $aspek->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus aspek ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-5 py-8 text-center text-gray-500">Belum ada aspek Iqro. Tambahkan aspek terlebih dahulu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection