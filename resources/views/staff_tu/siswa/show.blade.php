@extends('layouts.staff_tu')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header dengan tombol kembali -->
    <div class="flex items-center mb-6">
        <a href="{{ url('/staff_tu/siswa') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-semibold text-gray-800 ml-4">Detail Siswa</h1>
    </div>

    <!-- Card Detail -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header Card: Nama Siswa -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800">{{ $siswa->nama_siswa }}</h2>
        </div>

        <!-- Body Card: Data Grid -->
        <div class="p-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">NISN</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->nisn }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">NIS</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->nis }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir->format('d-m-Y') }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Umur</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->tanggal_lahir->age }} tahun</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->alamat }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Ayah</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->ayah }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Ibu</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->ibu }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Wali</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siswa->wali ?? '-' }}</dd>
                </div>
                <div class="border-b border-gray-100 pb-2">
                    <dt class="text-sm font-medium text-gray-500">Rombel</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($siswa->rombel)
                            {{ $siswa->rombel->tingkat }} {{ $siswa->rombel->kode_rombel }} - {{ $siswa->rombel->nama_rombel }}
                        @else
                            <span class="text-gray-400">Belum ditempatkan</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection