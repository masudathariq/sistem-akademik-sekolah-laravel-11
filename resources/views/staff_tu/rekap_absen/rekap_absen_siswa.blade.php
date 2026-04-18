@extends('layouts.staff_tu')

@section('title', 'Rekap Absensi Siswa')

@section('content')
<div class="space-y-6 pb-24">

    {{-- HEADER --}}
    <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5">
        <h1 class="text-2xl font-bold text-gray-800">
            Rekap Absensi Siswa
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Monitoring kehadiran siswa berdasarkan rombel dan periode bulan
        </p>
    </div>


    {{-- FILTER CARD --}}
    <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Rombel --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Rombongan Belajar
                </label>
                <select name="rombel_id"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih Rombel --</option>
                    @foreach($rombels as $rombel)
                        <option value="{{ $rombel->id }}"
                            {{ request('rombel_id') == $rombel->id ? 'selected' : '' }}>
                            {{ $rombel->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Bulan --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Periode Bulan
                </label>
                <input type="month"
                       name="bulan"
                       value="{{ request('bulan') }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                       required>
            </div>

            {{-- Tombol --}}
            <div class="flex items-end gap-2 md:col-span-2">
                <button type="submit"
                        class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition">
                    Tampilkan
                </button>

                @if(request('rombel_id') && $rekap->count())
                    <a href="{{ route('staff_tu.rekap_absen.rekap_absen_siswa_cetak', [
                        'rombel_id' => request('rombel_id'),
                        'bulan' => request('bulan')
                    ]) }}"
                       target="_blank"
                       class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                       🖨️ Cetak Rekap
                    </a>
                @endif
            </div>

        </form>
    </div>


    {{-- DATA TABLE --}}
    @if($rekap->count())

    <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">

            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-center w-16">No</th>
                        <th class="px-6 py-4 text-left">Nama Siswa</th>
                        <th class="px-6 py-4 text-center">H</th>
                        <th class="px-6 py-4 text-center">I</th>
                        <th class="px-6 py-4 text-center">S</th>
                        <th class="px-6 py-4 text-center">A</th>
                        <th class="px-6 py-4 text-center">B</th>
                    </tr>
                </thead>

<tbody class="divide-y divide-gray-100 text-gray-700">
    @foreach($rekap as $row)
    <tr class="hover:bg-gray-50 transition">
        <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
        <td class="px-6 py-3 font-medium">{{ $row->siswa->nama_siswa }}</td>
        <td class="px-6 py-3 text-center text-green-600 font-semibold">{{ $row->hadir }}</td>
        <td class="px-6 py-3 text-center text-blue-600 font-semibold">{{ $row->izin }}</td>
        <td class="px-6 py-3 text-center text-yellow-600 font-semibold">{{ $row->sakit }}</td>
        <td class="px-6 py-3 text-center text-red-600 font-semibold">{{ $row->alpha }}</td>
        <td class="px-6 py-3 text-center text-purple-600 font-semibold">{{ $row->bolos }}</td>
    </tr>
    @endforeach

    {{-- SUMMARY ROW --}}
    <tr class="bg-gray-100 font-bold text-gray-800">
        <td class="px-6 py-3 text-center" colspan="2">Terbanyak</td>

        {{-- Hadir --}}
        <td class="px-6 py-3 text-center text-green-600">
            @php
                $maxHadir = $rekap->max('hadir');
                $namaHadir = $rekap->filter(fn($r) => $r->hadir == $maxHadir)->pluck('siswa.nama_siswa')->join(', ');
            @endphp
            {{ $namaHadir ?: '-' }}
        </td>

        {{-- Izin --}}
        <td class="px-6 py-3 text-center text-blue-600">
            @php
                $maxIzin = $rekap->max('izin');
                $namaIzin = $rekap->filter(fn($r) => $r->izin == $maxIzin)->pluck('siswa.nama_siswa')->join(', ');
            @endphp
            {{ $namaIzin ?: '-' }}
        </td>

        {{-- Sakit --}}
        <td class="px-6 py-3 text-center text-yellow-600">
            @php
                $maxSakit = $rekap->max('sakit');
                $namaSakit = $rekap->filter(fn($r) => $r->sakit == $maxSakit)->pluck('siswa.nama_siswa')->join(', ');
            @endphp
            {{ $namaSakit ?: '-' }}
        </td>

        {{-- Alpha --}}
        <td class="px-6 py-3 text-center text-red-600">
            @php
                $maxAlpha = $rekap->max('alpha');
                $namaAlpha = $rekap->filter(fn($r) => $r->alpha == $maxAlpha)->pluck('siswa.nama_siswa')->join(', ');
            @endphp
            {{ $namaAlpha ?: '-' }}
        </td>

        {{-- Bolos --}}
        <td class="px-6 py-3 text-center text-purple-600">
            @php
                $maxBolos = $rekap->max('bolos');
                $namaBolos = $rekap->filter(fn($r) => $r->bolos == $maxBolos)->pluck('siswa.nama_siswa')->join(', ');
            @endphp
            {{ $namaBolos ?: '-' }}
        </td>
    </tr>
</tbody>

            </table>

        </div>
    </div>

    @else

    {{-- EMPTY STATE --}}
    <div class="bg-white border border-dashed border-gray-300 rounded-xl p-10 text-center text-gray-500">
        <p class="text-sm">
            Silakan pilih <strong>Rombongan Belajar</strong> dan
            <strong>Periode Bulan</strong> untuk menampilkan data rekap.
        </p>
    </div>

    @endif

</div>
@endsection
