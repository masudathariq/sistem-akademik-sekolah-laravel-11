@extends('layouts.guru')

@section('content')
<h2 class="text-2xl font-bold mb-4">Input Nilai: {{ $aspek->nama_aspek }}</h2>

<form action="{{ route('guru.raport-nilai.store', $aspek->id) }}" method="POST">
    @csrf
    <table class="table-auto border w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-2 py-1">No</th>
                <th class="border px-2 py-1">Nama Siswa</th>
                <th class="border px-2 py-1">Nilai (1-4)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $index => $siswa)
            <tr>
                <td class="border px-2 py-1">{{ $index+1 }}</td>
                <td class="border px-2 py-1">{{ $siswa->nama_siswa }}</td>
                <td class="border px-2 py-1">
                    <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                    <select name="nilai[]" required class="border rounded px-2 py-1">
                        <option value="">Pilih Nilai</option>
                        <option value="1" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==1 ? 'selected' : '' }}>1 - Belum baik / Belum berkembang</option>
                        <option value="2" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==2 ? 'selected' : '' }}>2 - Cukup baik / Mulai berkembang</option>
                        <option value="3" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==3 ? 'selected' : '' }}>3 - Baik / Berkembang sesuai harapan</option>
                        <option value="4" {{ isset($nilai[$siswa->id]) && $nilai[$siswa->id]==4 ? 'selected' : '' }}>4 - Sangat baik / Berkembang sangat baik</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan Nilai</button>
</form>
@endsection
