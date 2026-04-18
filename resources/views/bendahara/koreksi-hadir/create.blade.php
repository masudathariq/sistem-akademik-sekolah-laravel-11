@extends('layouts.bendahara')

@section('content')
<div class="container mx-auto p-6 max-w-xl">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Koreksi Kehadiran
        </h1>
        <p class="text-sm text-gray-500">
            Digunakan untuk menambah atau mengurangi jumlah kehadiran guru
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('bendahara.koreksi-hadir.store') }}"
          class="bg-white p-6 rounded-lg shadow space-y-4">

        @csrf

        {{-- GURU --}}
        <div>
            <label class="block text-sm font-medium mb-1">Guru</label>
            <select name="guru_id"
                    class="w-full border px-3 py-2 rounded-lg"
                    required>
                <option value="">-- Pilih Guru --</option>
                @foreach($guruList as $guru)
                    <option value="{{ $guru->id }}"
                        {{ old('guru_id', request('guru_id')) == $guru->id ? 'selected' : '' }}>
                        {{ $guru->nama }}
                    </option>
                @endforeach
            </select>
            @error('guru_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- BULAN --}}
        <div>
            <label class="block text-sm font-medium mb-1">Bulan</label>
            <select name="bulan"
                    class="w-full border px-3 py-2 rounded-lg"
                    required>
                @for($m=1;$m<=12;$m++)
                    <option value="{{ $m }}"
                        {{ old('bulan', request('bulan', now()->month)) == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromDate(null,$m,1)->locale('id')->isoFormat('MMMM') }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- TAHUN --}}
        <div>
            <label class="block text-sm font-medium mb-1">Tahun</label>
            <input type="number"
                   name="tahun"
                   value="{{ old('tahun', request('tahun', now()->year)) }}"
                   class="w-full border px-3 py-2 rounded-lg"
                   required>
        </div>

        {{-- JUMLAH --}}
        <div>
            <label class="block text-sm font-medium mb-1">
                Koreksi Kehadiran
            </label>
            <input type="number"
                   name="jumlah"
                   class="w-full border px-3 py-2 rounded-lg"
                   placeholder="Contoh: +2 atau -1"
                   required>
            <p class="text-xs text-gray-500 mt-1">
                Gunakan angka positif (+) untuk menambah, negatif (−) untuk mengurangi
            </p>
        </div>

        {{-- KETERANGAN --}}
        <div>
            <label class="block text-sm font-medium mb-1">Keterangan</label>
            <textarea name="keterangan"
                      rows="3"
                      class="w-full border px-3 py-2 rounded-lg"
                      placeholder="Opsional"></textarea>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('bendahara.koreksi-hadir.index') }}"
               class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                Batal
            </a>
            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection
