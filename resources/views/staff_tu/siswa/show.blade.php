@extends('layouts.staff_tu')

@section('content')

<div class="min-h-screen bg-slate-100 py-8">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">

            <div class="flex items-center gap-4">

                <a href="{{ url('/staff_tu/siswa') }}"
                   class="w-11 h-11 rounded-xl bg-white border border-slate-200 shadow-sm flex items-center justify-center hover:bg-slate-50 transition">

                    <svg class="w-5 h-5 text-slate-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>

                    </svg>

                </a>

                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        Detail Siswa
                    </h1>

                    <p class="text-sm text-slate-500 mt-1">
                        Informasi lengkap biodata siswa
                    </p>
                </div>

            </div>

        </div>

        <!-- Main Card -->
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

            <!-- Top Header -->
            <div class="border-b border-slate-200 bg-slate-50 px-8 py-6">

                <div class="flex flex-col md:flex-row md:items-center gap-5">

                    <!-- Avatar -->
                    <div class="w-20 h-20 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-2xl font-bold shadow-md">
                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                    </div>

                    <!-- Identity -->
                    <div class="flex-1">

                        <h2 class="text-2xl font-bold text-slate-800">
                            {{ $siswa->nama_siswa }}
                        </h2>

                        <div class="flex flex-wrap gap-3 mt-3">

                            <div class="px-4 py-2 rounded-xl bg-white border border-slate-200">
                                <p class="text-xs text-slate-500">
                                    NISN
                                </p>

                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $siswa->nisn }}
                                </p>
                            </div>

                            <div class="px-4 py-2 rounded-xl bg-white border border-slate-200">
                                <p class="text-xs text-slate-500">
                                    NIS
                                </p>

                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $siswa->nis }}
                                </p>
                            </div>

                            <div class="px-4 py-2 rounded-xl bg-white border border-slate-200">
                                <p class="text-xs text-slate-500">
                                    Jenis Kelamin
                                </p>

                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Form Section -->
            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Tempat, Tanggal Lahir
                        </label>

                        <div class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-800 font-medium">
                            {{ $siswa->tempat_lahir }},
                            {{ $siswa->tanggal_lahir->format('d-m-Y') }}
                        </div>
                    </div>

                    <!-- Umur -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Umur
                        </label>

                        <div class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-800 font-medium">
                            {{ $siswa->tanggal_lahir->age }} Tahun
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Alamat
                        </label>

                        <div class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-800 leading-relaxed">
                            {{ $siswa->alamat }}
                        </div>
                    </div>

                    <!-- Ayah -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Nama Ayah
                        </label>

                        <div class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-800 font-medium">
                            {{ $siswa->ayah }}
                        </div>
                    </div>

                    <!-- Ibu -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Nama Ibu
                        </label>

                        <div class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-800 font-medium">
                            {{ $siswa->ibu }}
                        </div>
                    </div>

                    <!-- Wali -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Wali
                        </label>

                        <div class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-800 font-medium">
                            {{ $siswa->wali ?? '-' }}
                        </div>
                    </div>

                    <!-- Rombel -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Rombel
                        </label>

                        <div class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">

                            @if($siswa->rombel)

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold">
                                        {{ $siswa->rombel->tingkat_romawi }}
                                    </div>

                                    <div>
                                        <h3 class="font-semibold text-slate-800">
                                            {{ $siswa->rombel->kode_rombel }}
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            {{ $siswa->rombel->nama_rombel }}
                                        </p>
                                    </div>

                                </div>

                            @else

                                <p class="text-slate-400">
                                    Belum ditempatkan
                                </p>

                            @endif

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection