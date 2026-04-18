@extends('layouts.staff_tu')

@section('title', 'Detail Surat Masuk')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Surat Masuk
        </h2>
        <a href="{{ route('staff_tu.surat_masuk.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            ← Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- DETAIL UTAMA --}}
        <div class="lg:col-span-2 bg-white shadow-md rounded-xl p-6">

            <h3 class="text-lg font-semibold text-blue-600 mb-4">
                Informasi Surat Masuk
            </h3>

            <div class="space-y-3 text-sm">

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Nomor Surat</div>
                    <div>: <span class="font-semibold">{{ $suratMasuk->nomor_surat }}</span></div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Jenis Surat</div>
                    <div>:
                        @if($suratMasuk->jenis)
                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">
                                {{ $suratMasuk->jenis }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Tanggal Surat</div>
                    <div>: {{ \Carbon\Carbon::parse($suratMasuk->tanggal_surat)->format('d F Y') }}</div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Tanggal Diterima</div>
                    <div>: {{ \Carbon\Carbon::parse($suratMasuk->tanggal_diterima)->format('d F Y') }}</div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Pengirim</div>
                    <div>: <span class="font-semibold">{{ $suratMasuk->pengirim }}</span></div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Perihal</div>
                    <div>: <span class="font-semibold">{{ $suratMasuk->perihal }}</span></div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Diteruskan Ke</div>
                    <div>: {{ $suratMasuk->diteruskan_ke ?? '-' }}</div>
                </div>

                <div class="flex">
                    <div class="w-40 font-medium text-gray-600">Status</div>
                    <div>:
                        @if($suratMasuk->status === 'Sudah Dibaca')
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                Sudah Dibaca
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">
                                Belum Dibaca
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
                    @if($suratMasuk->isi)
                        {!! nl2br(e($suratMasuk->isi)) !!}
                    @else
                        <span class="text-gray-400 italic">Tidak ada isi surat</span>
                    @endif
                </div>
            </div>

            {{-- Lampiran --}}
            @if($suratMasuk->lampiran)
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Lampiran</h4>
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div>
                            <div class="font-semibold">
                                {{ $suratMasuk->lampiran }}
                            </div>
                            <div class="text-xs text-gray-500">File Lampiran</div>
                        </div>
                        <a href="{{ route('staff_tu.surat_masuk.download', $suratMasuk) }}"
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
                            {{ $suratMasuk->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div>
                        <div class="text-gray-500">Terakhir Diubah</div>
                        <div class="font-semibold">
                            {{ $suratMasuk->updated_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="bg-white shadow-md rounded-xl p-6">
                <h4 class="font-semibold text-gray-700 mb-4">Aksi</h4>

                <div class="space-y-3">
                    <a href="{{ route('staff_tu.surat_masuk.edit', $suratMasuk) }}"
                       class="block text-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                        Edit Surat
                    </a>

                    <form action="{{ route('staff_tu.surat_masuk.destroy', $suratMasuk) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Hapus Surat
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
