@extends('layouts.staff_tu')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Tahun Ajaran</h1>

{{-- error validasi --}}
@if ($errors->any())
    <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/staff_tu/tahun-ajaran') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block font-semibold">Tahun Ajaran</label>
        <input type="text"
               name="tahun_ajaran"
               value="{{ old('tahun_ajaran') }}"
               placeholder="Contoh: 2024/2025"
               class="border p-2 w-full"
               required>
    </div>

    <div>
        <label class="block font-semibold">Semester</label>
        <select name="semester" class="border p-2 w-full" required>
            <option value="">-- Pilih Semester --</option>
            <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>
                Ganjil
            </option>
            <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>
                Genap
            </option>
        </select>
    </div>

    <div class="flex gap-2">
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan
        </button>

        <a href="{{ url('/staff_tu/tahun-ajaran') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded">
            Kembali
        </a>
    </div>
</form>
@endsection
