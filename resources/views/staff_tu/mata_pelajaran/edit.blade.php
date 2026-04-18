@extends('layouts.staff_tu')

@section('content')
<div class="p-6">

    <h2 class="text-xl font-bold mb-4">Edit Mata Pelajaran</h2>

    <form action="{{ route('staff_tu.mata_pelajaran.update', $mata_pelajaran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kode Mapel</label>
            <input type="text" name="kode_mapel"
                   value="{{ $mata_pelajaran->kode_mapel }}"
                   class="border w-full p-2 rounded">
        </div>

                <div class="mb-3">
            <label>Nama Mapel</label>
            <input type="text" name="nama_mapel"
                   value="{{ $mata_pelajaran->nama_mapel }}"
                   class="border w-full p-2 rounded">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>
@endsection