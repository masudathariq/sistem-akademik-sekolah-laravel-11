@extends('layouts.bendahara')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Edit Tunjangan</h1>

    <form method="POST"
          action="{{ route('bendahara.penambahan.update', $penambahan->id) }}"
          class="space-y-4 bg-white p-6 rounded shadow">
        @csrf @method('PUT')

        <input name="judul" value="{{ $penambahan->judul }}"
               class="w-full border p-2 rounded" required>

        <input name="jumlah" type="number"
               value="{{ $penambahan->jumlah }}"
               class="w-full border p-2 rounded" required>

        <select name="tipe" id="tipe"
                class="w-full border p-2 rounded">
            <option value="semua"
                @selected($penambahan->tipe === 'semua')>
                Semua Guru
            </option>
            <option value="pilihan"
                @selected($penambahan->tipe === 'pilihan')>
                Guru Tertentu
            </option>
        </select>

        <div id="guru-box"
             class="{{ $penambahan->tipe !== 'pilihan' ? 'hidden' : '' }}">
            <select name="guru_id[]" multiple
                    class="w-full border p-2 rounded">
                @foreach($guruList as $guru)
                    <option value="{{ $guru->id }}"
                        @selected(in_array(
                            $guru->id,
                            $penambahan->guru_id ?? []
                        ))>
                        {{ $guru->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
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
