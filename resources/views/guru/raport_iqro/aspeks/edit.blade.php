@extends('layouts.guru')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900">Ubah Aspek Iqro</h2>
            <p class="text-sm text-gray-500 mt-1">Perbarui nama aspek penilaian untuk raport Iqro.</p>
        </div>
        <a href="{{ route('guru.raport-iqro-aspeks.index') }}" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Kembali</a>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('guru.raport-iqro-aspeks.update', $aspek->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Aspek</label>
                    <input type="text" name="nama_aspek" value="{{ old('nama_aspek', $aspek->nama_aspek) }}" class="mt-2 w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-200" required>
                    @error('nama_aspek')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('guru.raport-iqro-aspeks.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-green-600 px-5 py-3 text-sm font-semibold text-white hover:bg-green-700">Perbarui Aspek</button>
            </div>
        </form>
    </div>
</div>
@endsection