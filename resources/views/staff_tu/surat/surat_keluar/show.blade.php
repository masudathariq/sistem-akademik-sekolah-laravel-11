@extends('layouts.staff_tu')

@section('title', 'Detail Surat Keluar')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Surat Keluar
        </h2>
        <a href="{{ route('staff_tu.surat_keluar.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            ← Kembali
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- DETAIL UTAMA --}}
        <div class="lg:col-span-2 bg-white shadow-md rounded-xl p-6">

            <h3 class="text-lg font-semibold text-blue-600 mb-4">
                Informasi Surat Keluar
            </h3>

            <div class="space-y-3 text-sm">

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Nomor Surat</div>
                    <div>: <span class="font-semibold">{{ $suratKeluar->nomor_surat }}</span></div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Jenis Surat</div>
                    <div>:
                        @if($suratKeluar->jenis)
                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">
                                {{ $suratKeluar->jenis }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Tanggal Surat</div>
                    <div>: {{ $suratKeluar->tanggal_surat->format('d F Y') }}</div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Tanggal Keluar</div>
                    <div>: {{ $suratKeluar->tanggal_keluar->format('d F Y') }}</div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Tujuan</div>
                    <div>: <span class="font-semibold">{{ $suratKeluar->tujuan }}</span></div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Perihal</div>
                    <div>: <span class="font-semibold">{{ $suratKeluar->perihal }}</span></div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Penandatangan</div>
                    <div>: {{ $suratKeluar->penandatangan ?? '-' }}</div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Status</div>
                    <div>:
                        @if($suratKeluar->status == 'Draf')
                            <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                                Draf
                            </span>
                        @elseif($suratKeluar->status == 'Terkirim')
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                Terkirim
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs bg-gray-200 text-gray-700 rounded-full">
                                Arsip
                            </span>
                        @endif
                    </div>
                </div>

            </div>

            <hr class="my-6">

            {{-- Isi Surat --}}
            <div class="mb-4">
                <h4 class="font-semibold text-gray-700 mb-2">Isi Surat</h4>
                <div class="p-4 bg-gray-50 rounded-lg text-sm leading-relaxed">
                    @if($suratKeluar->isi)
                        {!! nl2br(e($suratKeluar->isi)) !!}
                    @else
                        <span class="text-gray-400 italic">Tidak ada isi surat</span>
                    @endif
                </div>
            </div>

            {{-- Keterangan --}}
            @if($suratKeluar->keterangan)
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Keterangan</h4>
                    <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded text-sm">
                        {!! nl2br(e($suratKeluar->keterangan)) !!}
                    </div>
                </div>
            @endif

            {{-- Lampiran --}}
            @if($suratKeluar->lampiran)
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Lampiran</h4>
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div>
                            <div class="font-semibold">{{ $suratKeluar->lampiran_nama }}</div>
                            <div class="text-xs text-gray-500">File Lampiran</div>
                        </div>
                        <a href="{{ route('staff_tu.surat_keluar.download', $suratKeluar) }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Download
                        </a>
                    </div>
                </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- Timeline --}}
            <div class="bg-white shadow-md rounded-xl p-6">
                <h4 class="font-semibold text-gray-700 mb-4">Timeline</h4>

                <div class="text-sm space-y-3">
                    <div>
                        <div class="text-gray-500">Dibuat</div>
                        <div class="font-semibold">
                            {{ $suratKeluar->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div>
                        <div class="text-gray-500">Terakhir Diubah</div>
                        <div class="font-semibold">
                            {{ $suratKeluar->updated_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="bg-white shadow-md rounded-xl p-6">
                <h4 class="font-semibold text-gray-700 mb-4">Aksi</h4>

                <div class="space-y-3">

                    @if(!$suratKeluar->isArsip())
                        <a href="{{ route('staff_tu.surat_keluar.edit', $suratKeluar) }}"
                           class="block text-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                            Edit Surat
                        </a>
                    @endif

                    @if($suratKeluar->isDraf())
                        <button onclick="confirmKirim()"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Tandai Terkirim
                        </button>
                    @endif

                    @if($suratKeluar->isTerkirim())
                        <button onclick="confirmArsip()"
                                class="w-full px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                            Arsipkan
                        </button>
                    @endif

                    @if(!$suratKeluar->isArsip())
                        <button onclick="confirmDelete()"
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Hapus Surat
                        </button>
                    @endif

                </div>

                @if($suratKeluar->isArsip())
                    <div class="mt-4 p-3 bg-gray-100 text-gray-600 text-sm rounded">
                        Surat ini sudah diarsipkan dan tidak dapat diedit atau dihapus
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
