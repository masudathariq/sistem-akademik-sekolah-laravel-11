@extends('layouts.guru')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">📋 Detail Raport Tahfidz</h2>
            <p class="text-sm text-gray-500 mt-0.5">Rincian lengkap penilaian hafalan siswa.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('guru.raport-tahfidz.index') }}"
               class="flex items-center gap-1 px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-lg hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <a href="{{ route('guru.raport-tahfidz.cetak', $siswa->id) }}"
               class="flex items-center gap-1 px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                🖨️ Cetak Raport
            </a>
            <a href="{{ route('guru.raport_tahfidz.download_pdf', $siswa->id) }}"
               class="flex items-center gap-1 px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition">
                ⬇️ Download PDF
            </a>
        </div>
    </div>

    {{-- Info Siswa --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-5">
        <div class="bg-gradient-to-r from-green-600 to-green-500 px-5 py-4 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-white text-green-700 font-bold flex items-center justify-center text-lg uppercase flex-shrink-0">
                {{ strtoupper(substr($siswa->nama_siswa, 0, 2)) }}
            </div>
            <div>
                <p class="text-white font-bold text-lg leading-tight">{{ $siswa->nama_siswa }}</p>
                <p class="text-green-100 text-sm">
                    Kelas {{ $siswa->rombel->tingkat ?? '-' }} &bull; {{ $siswa->rombel->nama_rombel ?? '-' }} &bull; NIS: {{ $siswa->nis ?? '-' }}
                </p>
            </div>
        </div>
    </div>

    {{-- A. Penilaian Aspek --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-5">
        <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
            <h3 class="font-semibold text-gray-700 text-sm">A. Penilaian Aspek Tahfidz</h3>
        </div>
        <div class="px-5 py-3 border-b border-gray-100 bg-yellow-50">
            <p class="text-xs text-gray-500">
                <span class="font-semibold">Keterangan:</span>
                <span class="ml-2">★ = Belum baik</span>
                <span class="ml-3">★★ = Cukup baik</span>
                <span class="ml-3">★★★ = Baik</span>
                <span class="ml-3">★★★★ = Sangat baik</span>
            </p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center w-10">No</th>
                        <th class="px-4 py-3 text-left">Aspek Penilaian</th>
                        <th class="px-4 py-3 text-center w-28">Nilai</th>
                        <th class="px-4 py-3 text-center w-48">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($aspeks as $index => $aspek)
                    @php $nilaiAngka = $nilai[$aspek->id] ?? 0; @endphp
                    <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }} hover:bg-green-50/30 transition">
                        <td class="px-4 py-3 text-center text-gray-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $aspek->nama_aspek }}</td>
                        <td class="px-4 py-3 text-center text-base">
                            @if($nilaiAngka > 0)
                                <span class="text-yellow-400">{!! str_repeat('★', $nilaiAngka) !!}</span><span class="text-gray-200">{!! str_repeat('★', 4 - $nilaiAngka) !!}</span>
                            @else
                                <span class="text-gray-300 text-xs italic">Belum dinilai</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($nilaiAngka > 0)
                                <span class="text-xs px-2 py-1 rounded-full
                                    {{ $nilaiAngka == 4 ? 'bg-green-100 text-green-700' :
                                       ($nilaiAngka == 3 ? 'bg-blue-100 text-blue-700' :
                                       ($nilaiAngka == 2 ? 'bg-yellow-100 text-yellow-700' :
                                       'bg-red-100 text-red-700')) }}">
                                    {{ $keterangan[$aspek->id] ?? '-' }}
                                </span>
                            @else
                                <span class="text-gray-300 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-400 italic text-sm">Belum ada aspek penilaian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- B. Ringkasan Hafalan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-5">
        <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
            <h3 class="font-semibold text-gray-700 text-sm">B. Ringkasan Hafalan</h3>
        </div>
        <div class="p-5">
            @if($hafalan)
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                        <p class="text-xs text-green-500 font-semibold mb-1">Pencapaian Munaqosah</p>
                        <p class="text-2xl font-bold text-green-700">{{ $pencapaian }}%</p>
                        <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full bg-green-200 text-green-800">
                            {{ $status }}
                        </span>
                    </div>
                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 text-center">
                        <p class="text-xs text-orange-500 font-semibold mb-1">📖 Hafalan Terakhir</p>
                        <p class="text-base font-bold text-gray-800">{{ $hafalan->surah_terakhir }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Ayat {{ $hafalan->ayat_terakhir }}</p>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                        <p class="text-xs text-blue-500 font-semibold mb-1">🎯 Target Lanjutan</p>
                        <p class="text-base font-bold text-gray-800">{{ $hafalan->surah_lanjut }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Ayat {{ $hafalan->ayat_lanjut }}</p>
                    </div>
                </div>
            @else
                <p class="text-sm text-gray-400 italic text-center py-4">Belum ada data hafalan.</p>
            @endif
        </div>
    </div>

    {{-- C. Nilai Ujian --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-5">
        <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
            <h3 class="font-semibold text-gray-700 text-sm">C. Nilai Ujian Tahfidz</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center w-10">No</th>
                        <th class="px-4 py-3 text-left">Nama Ujian</th>
                        <th class="px-4 py-3 text-center w-28">Nilai Angka</th>
                        <th class="px-4 py-3 text-center w-36">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ujian as $index => $u)
                    @php $ket = $u->keterangan ?? '-'; @endphp
                    <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }} hover:bg-green-50/30 transition">
                        <td class="px-4 py-3 text-center text-gray-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $u->nama_ujian }}</td>
                        <td class="px-4 py-3 text-center font-bold text-gray-800">{{ $u->nilai_ujian }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $ket === 'Sangat Baik' ? 'bg-green-100 text-green-700' :
                                   ($ket === 'Baik' ? 'bg-blue-100 text-blue-700' :
                                   ($ket === 'Cukup' ? 'bg-yellow-100 text-yellow-700' :
                                   'bg-gray-100 text-gray-500')) }}">
                                {{ $ket }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-400 italic text-sm">Belum ada nilai ujian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- D. Catatan Guru --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
            <h3 class="font-semibold text-gray-700 text-sm">D. Catatan Guru</h3>
        </div>
        <div class="p-5">
            @if($catatan)
                @php
                    $sentences  = explode('. ', $catatan);
                    $paragraphs = array_chunk($sentences, 3);
                @endphp
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-sm text-gray-700 leading-relaxed text-justify space-y-2">
                    @foreach($paragraphs as $para)
                        <p>{{ implode('. ', $para) }}{{ !str_ends_with(trim(end($para)), '.') ? '.' : '' }}</p>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 italic text-center py-4">Tidak ada catatan tambahan.</p>
            @endif
        </div>
    </div>

</div>
@endsection