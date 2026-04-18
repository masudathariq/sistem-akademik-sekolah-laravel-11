@extends('layouts.bendahara')

@section('title','Tahfidz Guru')

@section('content')
<div class="space-y-8 pb-24 max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
        <h1 class="text-2xl md:text-3xl font-bold">
            Input Tahfidz Guru
        </h1>
        <p class="text-sm text-indigo-100 mt-2">
            Kelola kehadiran tahfidz guru dan sistem akan menghitung total otomatis berdasarkan harga per hadir.
        </p>
    </div>

    {{-- INFO BANNER --}}
    <div class="bg-indigo-50 border border-indigo-200 text-indigo-800 p-4 rounded-xl shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div>
                <p class="font-semibold text-sm">
                    Informasi Pengisian
                </p>
                <p class="text-xs mt-1 text-indigo-700">
                    • Pilih bulan & tahun terlebih dahulu <br>
                    • Isi jumlah hadir untuk setiap guru <br>
                    • Total akan otomatis dihitung berdasarkan harga per hadir
                </p>
            </div>

            <div class="text-sm font-medium bg-white px-4 py-2 rounded-lg border text-indigo-700">
                Periode Aktif:
                <span class="font-bold">
                    {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->translatedFormat('F') }}

                </span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER BULAN --}}
    <form method="GET" class="bg-white p-5 rounded-2xl shadow-sm border">
        <div class="flex flex-col md:flex-row gap-4 md:items-end">

            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-600 mb-1">Bulan</label>
                <select name="bulan" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(range(1,12) as $b)
                        <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-600 mb-1">Tahun</label>
                <input type="number" name="tahun" value="{{ $tahun }}"
                       class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
                <button type="submit"
                        class="w-full md:w-auto bg-gray-900 hover:bg-black text-white px-6 py-2 rounded-lg transition shadow">
                    Tampilkan
                </button>
            </div>

        </div>
    </form>

    <form method="POST" action="{{ route('bendahara.tahfidz.store') }}">
        @csrf

        <input type="hidden" name="bulan" value="{{ $bulan }}">
        <input type="hidden" name="tahun" value="{{ $tahun }}">

        {{-- SETTING HARGA --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border">
            <label class="block font-semibold text-gray-700 mb-2">
                Harga Tahfidz per Hadir
            </label>

            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <input type="number"
                       name="harga"
                       value="{{ $harga }}"
                       class="border-gray-300 rounded-lg px-4 py-2 w-full md:w-64 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       required>

                <span class="text-xs text-gray-500">
                    Contoh: 15000
                </span>
            </div>
        </div>

        {{-- TABEL GURU --}}
        <div class="bg-white p-5 rounded-2xl shadow-sm border overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="p-3 text-left">Nama Guru</th>
                        <th class="p-3 text-center">Jumlah Hadir</th>
                        <th class="p-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gurus as $guru)
                        @php
                            $row = $data[$guru->id] ?? null;
                            $hadir = $row->jumlah_hadir ?? 0;
                            $total = $row->total ?? 0;
                        @endphp
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="p-3 font-medium text-gray-800">
                                {{ $guru->nama }}
                            </td>

                            <td class="p-3 text-center">
                                <input type="number"
                                       name="jumlah_hadir[{{ $guru->id }}]"
                                       value="{{ $hadir }}"
                                       min="0"
                                       class="border-gray-300 rounded-lg w-24 text-center focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            </td>

                            <td class="p-3 text-right font-semibold text-indigo-600">
                                Rp {{ number_format($total) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 text-right">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-lg transition font-semibold">
                    Simpan Data Tahfidz
                </button>
            </div>
        </div>

    </form>

</div>
@endsection
