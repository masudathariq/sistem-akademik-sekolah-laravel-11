@extends('layouts.staff_tu')

@section('title','Data Guru')
@section('content')

<h1 class="text-2xl font-semibold mb-4">Data Guru</h1>

<table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
    <thead class="bg-slate-100 text-slate-600 text-sm">
        <tr>
            <th class="px-4 py-3 text-left">No</th>
            <th class="px-4 py-3 text-left">Nama</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">NUPTK</th>
            <th class="px-4 py-3 text-left">Jabatan</th>
            <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody class="text-sm">
        @foreach($gurus as $index => $guru)
        <tr class="border-t hover:bg-slate-50">
            <td class="px-4 py-3">{{ $index+1 }}</td>
            <td class="px-4 py-3">{{ $guru->nama }}</td>
            <td class="px-4 py-3">{{ $guru->user->email ?? '-' }}</td>
            <td class="px-4 py-3">{{ $guru->nuptk ?? '-' }}</td>
            <td class="px-4 py-3">{{ $guru->jabatan ?? '-' }}</td>
            <td class="px-4 py-3 space-x-2">
                <a href="{{ route('staff_tu.guru.show', $guru->id) }}"
                   class="text-amber-500 hover:underline">Lihat</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
