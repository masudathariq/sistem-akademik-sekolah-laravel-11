@extends('layouts.bendahara')

@section('title','Tahfidz Guru')

@section('content')

<div class="max-w-7xl mx-auto space-y-6 pb-24">

    {{-- HEADER --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-700 via-blue-700 to-indigo-600 shadow-2xl">

        <div class="absolute right-0 top-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative p-7 md:p-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">
                        Input Tahfidz Guru
                    </h1>

                    <p class="text-indigo-100 text-sm mt-2 leading-relaxed max-w-2xl">
                        Kelola data kehadiran tahfidz guru dan sistem akan menghitung total honor otomatis berdasarkan jumlah hadir.
                    </p>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/10 px-5 py-4 rounded-2xl text-white">
                    <p class="text-xs text-indigo-100 uppercase tracking-wider mb-1">
                        Periode Aktif
                    </p>

                    <div class="text-xl font-bold">
                        {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->translatedFormat('F') }}
                        {{ $tahun }}
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- INFO --}}
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5 shadow-sm">

        <div class="flex items-start gap-4">

            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-700"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>

            <div class="text-sm text-blue-800 leading-relaxed">
                <p class="font-semibold mb-2">
                    Informasi Pengisian Tahfidz
                </p>

                <ul class="space-y-1 text-blue-700">
                    <li>• Pilih bulan dan tahun terlebih dahulu</li>
                    <li>• Isi jumlah hadir untuk setiap guru</li>
                    <li>• Sistem menghitung total honor otomatis</li>
                </ul>
            </div>

        </div>

    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-2xl shadow-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <form method="GET"
          class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Bulan
                </label>

                <select name="bulan"
                        class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                    @foreach(range(1,12) as $b)
                        <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Tahun
                </label>

                <input type="number"
                       name="tahun"
                       value="{{ $tahun }}"
                       class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex items-end">
                <button type="submit"
                        class="w-full bg-slate-900 hover:bg-black text-white px-6 py-3 rounded-xl font-semibold shadow transition">
                    Tampilkan Data
                </button>
            </div>

        </div>

    </form>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('bendahara.tahfidz.store') }}">

        @csrf

        <input type="hidden" name="bulan" value="{{ $bulan }}">
        <input type="hidden" name="tahun" value="{{ $tahun }}">

        {{-- HARGA --}}
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Harga Tahfidz per Hadir
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Nominal honor setiap kehadiran tahfidz guru
                    </p>
                </div>

                <div class="flex items-center gap-3">

                    <div class="px-4 py-3 rounded-xl bg-slate-100 text-slate-600 font-semibold">
                        Rp
                    </div>

                    <input type="number"
                           name="harga"
                           value="{{ $harga }}"
                           required
                           class="rounded-xl border-slate-300 w-56 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                </div>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

            {{-- TABLE HEADER --}}
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-lg font-bold text-slate-800">
                            Data Tahfidz Guru
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Total {{ $gurus->count() }} guru
                        </p>
                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-900">

                        <tr>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-white">
                                Nama Guru
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-white">
                                Jumlah Hadir
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-white">
                                Total Honor
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($gurus as $guru)

                            @php
                                $row = $data[$guru->id] ?? null;
                                $hadir = $row->jumlah_hadir ?? 0;
                                $total = $row->total ?? 0;
                            @endphp

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-4">

                                        <div class="w-11 h-11 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($guru->nama,0,1)) }}
                                        </div>

                                        <div>

                                            <div class="font-semibold text-slate-800">
                                                {{ $guru->nama }}
                                            </div>

                                            <div class="text-xs text-slate-400 mt-1">
                                                Guru Tahfidz
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-4 text-center">

                                    <input type="number"
                                           name="jumlah_hadir[{{ $guru->id }}]"
                                           value="{{ $hadir }}"
                                           min="0"
                                           class="w-24 rounded-xl border-slate-300 text-center font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                                </td>

                                <td class="px-6 py-4 text-center">

                                    <div class="inline-flex items-center px-4 py-2 rounded-xl bg-indigo-50 text-indigo-700 font-bold">

                                        Rp {{ number_format($total,0,',','.') }}

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- FOOTER --}}
            <div class="px-6 py-5 border-t border-slate-200 bg-slate-50 text-right">

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-2xl shadow-lg transition font-semibold">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7">
                        </path>

                    </svg>

                    Simpan Data Tahfidz

                </button>

            </div>

        </div>

    </form>

</div>

@endsection