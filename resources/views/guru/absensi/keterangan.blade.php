@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Riwayat Izin & Sakit</h1>
        <a href="{{ route('guru.absensi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="mb-4 flex space-x-2">
        <select name="bulan" class="border px-2 py-1 rounded">
            @for($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
            @endfor
        </select>
        <input type="number" name="tahun" value="{{ $tahun }}" class="border px-2 py-1 rounded w-24">
        <select name="status" class="border px-2 py-1 rounded">
            <option value="">Semua Status</option>
            <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
            <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Filter</button>
    </form>

    <!-- Statistik -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="bg-yellow-100 p-3 rounded">
            <span class="text-sm">Total Izin: <strong>{{ $totalIzin }}</strong></span>
        </div>
        <div class="bg-red-100 p-3 rounded">
            <span class="text-sm">Total Sakit: <strong>{{ $totalSakit }}</strong></span>
        </div>
    </div>

    <!-- Tabel Keterangan -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Tanggal</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Keterangan</th>
                    <th class="border px-3 py-2">Waktu Submit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keterangan as $index => $k)
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border px-3 py-2">
                        {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                        <br>
                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($k->tanggal)->isoFormat('dddd') }}</span>
                    </td>
                    <td class="border px-3 py-2 text-center">
                        @if($k->status == 'izin')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Izin</span>
                        @elseif($k->status == 'sakit')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Sakit</span>
                        @endif
                    </td>
                    <td class="border px-3 py-2">
                        <p class="text-sm">{{ $k->keterangan }}</p>
                    </td>
                    <td class="border px-3 py-2 text-sm text-gray-600">
                        {{ $k->created_at ? $k->created_at->format('d M Y, H:i') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border px-3 py-6 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Belum ada riwayat izin/sakit
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination jika perlu -->
    @if($keterangan->hasPages())
    <div class="mt-4">
        {{ $keterangan->links() }}
    </div>
    @endif
</div>
@endsection