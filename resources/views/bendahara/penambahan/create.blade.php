@extends('layouts.bendahara')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Tambah Tunjangan</h1>

    <form method="POST" action="{{ route('bendahara.penambahan.store') }}"
          class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <input name="judul" placeholder="Judul"
               class="w-full border p-2 rounded" required>

        <input name="jumlah" type="number"
               class="w-full border p-2 rounded" required>

        <select name="tipe" id="tipe"
                class="w-full border p-2 rounded">
            <option value="semua">Semua Guru</option>
            <option value="pilihan">Guru Tertentu</option>
        </select>

        <div id="guru-box" class="hidden">
            <select name="guru_id[]" multiple
                    class="w-full border p-2 rounded">
                @foreach($guruList as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>

<script>
document.getElementById('tipe').addEventListener('change', function(){
    document.getElementById('guru-box')
        .classList.toggle('hidden', this.value !== 'pilihan');
});
</script>
@endsection
