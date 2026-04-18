@extends('layouts.bendahara')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Tambah Gaji Pokok</h1>

    <form action="{{ route('bendahara.gaji-pokok.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf

        <!-- Nama Guru -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nama Guru</label>
            <select name="guru_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Guru --</option>
                @foreach($guruList as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Jumlah Jam & Tarif -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Jumlah Jam</label>
                <input type="number" step="0.01" name="jumlah_jam" value="0" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Tarif / Jam (Rp)</label>
                <input type="number" step="0.01" name="tarif_per_jam" value="20000" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
