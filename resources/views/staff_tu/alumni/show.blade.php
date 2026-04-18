@extends('layouts.staff_tu')

@section('title', 'Detail Alumni')

@section('content')
<div class="p-6 bg-slate-50 min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Detail Alumni: {{ $alumni->nama_siswa }}</h1>

    <table class="table-auto border border-gray-300 w-full mb-6">
        <tr>
            <th class="border px-2 py-1 text-left">NISN</th>
            <td class="border px-2 py-1">{{ $alumni->nisn }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">NIS</th>
            <td class="border px-2 py-1">{{ $alumni->nis }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Nama Siswa</th>
            <td class="border px-2 py-1">{{ $alumni->nama_siswa }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Tempat, Tanggal Lahir</th>
            <td class="border px-2 py-1">{{ $alumni->tempat_lahir }}, {{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Jenis Kelamin</th>
            <td class="border px-2 py-1">{{ $alumni->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Alamat</th>
            <td class="border px-2 py-1">{{ $alumni->alamat }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Nama Ayah</th>
            <td class="border px-2 py-1">{{ $alumni->ayah }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Nama Ibu</th>
            <td class="border px-2 py-1">{{ $alumni->ibu }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Wali</th>
            <td class="border px-2 py-1">{{ $alumni->wali ?? '-' }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Tahun Lulus</th>
            <td class="border px-2 py-1">{{ $alumni->tahun_lulus ?? '-' }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Rombel Terakhir</th>
            <td class="border px-2 py-1">{{ $alumni->rombel_terakhir ?? '-' }}</td>
        </tr>
        <tr>
            <th class="border px-2 py-1 text-left">Keterangan</th>
            <td class="border px-2 py-1">{{ $alumni->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <div class="flex gap-2">
        <a href="{{ route('staff_tu.alumni.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
           Kembali
        </a>

        <form action="{{ route('staff_tu.alumni.destroy', $alumni->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus {{ $alumni->nama_siswa }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection
