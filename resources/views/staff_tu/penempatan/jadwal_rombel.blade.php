@extends('layouts.staff_tu')

@section('content')
<h2 class="text-xl font-bold mb-4">
    Jadwal Rombel: {{ $rombel->nama }}
</h2>

<p class="mb-6">
    Tahun Ajaran: <strong>{{ $tahunAktif->tahun_ajaran }}</strong> |
    Semester: <strong>{{ $tahunAktif->semester }}</strong> |
    Wali Kelas: <strong>{{ $rombel->waliKelas ? $rombel->waliKelas->nama : '-' }}</strong>
</p>

@foreach($haris as $hari)
    <div class="mb-6 bg-white shadow rounded p-4">
        <h3 class="font-semibold text-lg mb-3">{{ ucfirst($hari) }}</h3>

        @if(isset($jadwals[$hari]))
            @foreach($jadwals[$hari] as $jadwal)
                <div class="border rounded p-3 mb-2 bg-gray-50">
                    <div>
                        <strong>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</strong>
                    </div>
                    <div>
                        {{ $jadwal->mataPelajaran->nama }} - {{ $jadwal->guru->nama }}
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-gray-500">
                Belum ada jadwal
            </div>
        @endif
    </div>
@endforeach
@endsection