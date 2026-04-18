@extends('layouts.staff_tu')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Rombel</h1>

{{-- error validasi --}}
@if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/staff_tu/rombel/'.$rombel->id) }}" method="POST" class="max-w-md">
    @csrf
    @method('PUT')

    {{-- tahun ajaran --}}
    <div class="mb-3">
        <label class="block mb-1 font-semibold">Tahun Ajaran</label>
        <input type="text"
               class="w-full border rounded px-3 py-2 bg-gray-100"
               value="{{ $rombel->tahunAjaran->tahun_ajaran }} ({{ $rombel->tahunAjaran->semester }})"
               readonly>
    </div>

    {{-- tingkat --}}
    <div class="mb-3">
        <label class="block mb-1 font-semibold">Tingkat</label>
        <select name="tingkat" required
                class="w-full border rounded px-3 py-2">
            <option value="7" {{ $rombel->tingkat == 7 ? 'selected' : '' }}>VII</option>
            <option value="8" {{ $rombel->tingkat == 8 ? 'selected' : '' }}>VIII</option>
            <option value="9" {{ $rombel->tingkat == 9 ? 'selected' : '' }}>IX</option>
        </select>
    </div>

    {{-- kode rombel --}}
    <div class="mb-3">
        <label class="block mb-1 font-semibold">Kode Rombel</label>
        <input type="text"
               name="kode_rombel"
               class="w-full border rounded px-3 py-2"
               value="{{ $rombel->kode_rombel }}"
               required>
    </div>

    {{-- nama rombel --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nama Rombel</label>
        <input type="text"
               name="nama_rombel"
               class="w-full border rounded px-3 py-2"
               value="{{ $rombel->nama_rombel }}"
               required>
    </div>

    <div class="flex gap-2">
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded">
            Update
        </button>

        <a href="{{ url('/staff_tu/rombel') }}"
           class="px-4 py-2 bg-gray-400 text-white rounded">
            Kembali
        </a>
    </div>
</form>
@endsection
