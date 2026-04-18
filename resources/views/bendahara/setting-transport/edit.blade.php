@extends('layouts.bendahara')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Edit Gaji Transport</h1>

    <form action="{{ route('bendahara.setting-transport.update') }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Transport per Hari (Rp)</label>
            <input type="number" name="transport_per_hari" value="{{ old('transport_per_hari', $setting?->transport_per_hari ?? 0) }}" 
                   class="w-full border px-3 py-2 rounded">
            @error('transport_per_hari')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('bendahara.setting-transport.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
