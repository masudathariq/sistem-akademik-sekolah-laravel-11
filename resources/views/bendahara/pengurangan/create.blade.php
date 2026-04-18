@extends('layouts.bendahara')

@section('content')
<div class="container mx-auto p-4 max-w-xl">
    <h1 class="text-xl font-bold mb-4">Tambah Pengurangan</h1>

    <form action="{{ route('bendahara.pengurangan.store') }}"
          method="POST"
          class="bg-white p-6 rounded shadow space-y-4">
        @csrf

        <div>
            <label class="font-semibold">Judul Pengurangan</label>
            <input type="text" name="judul"
                   class="w-full border px-3 py-2 rounded"
                   required>
        </div>

        <div>
            <label class="font-semibold">Jumlah (Rp)</label>
            <input type="number" name="jumlah"
                   class="w-full border px-3 py-2 rounded"
                   required>
        </div>

        <div>
            <label class="font-semibold">Berlaku Untuk</label>
            <select name="tipe" id="tipe"
                    class="w-full border px-3 py-2 rounded"
                    required>
                <option value="semua">Semua Guru</option>
                <option value="pilihan">Guru Tertentu</option>
            </select>
        </div>

        <div id="guru-wrapper" class="hidden">
            <label class="font-semibold">Pilih Guru</label>
            <select name="guru_id[]" multiple
                    class="w-full border px-3 py-2 rounded">
                @foreach($guruList as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
            <small class="text-gray-500">
                Tekan CTRL untuk memilih lebih dari satu guru
            </small>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('bendahara.pengurangan.index') }}"
               class="px-4 py-2 border rounded">
                Batal
            </a>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('tipe').addEventListener('change', function () {
    document.getElementById('guru-wrapper')
        .classList.toggle('hidden', this.value !== 'pilihan');
});
</script>
@endsection
