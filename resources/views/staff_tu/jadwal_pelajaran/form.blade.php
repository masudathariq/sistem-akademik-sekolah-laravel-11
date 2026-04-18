@extends('layouts.staff_tu')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-2 flex-wrap">
        <a href="{{ route('staff_tu.jadwal_pelajaran.index') }}" class="hover:text-blue-600 transition">Jadwal & Kurikulum</a>
        <span>›</span>
        <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}" class="hover:text-blue-600 transition">Hari {{ ucfirst($hari) }}</a>
        <span>›</span>
        <span class="text-blue-600 font-medium">Input Jadwal</span>
    </div>

    {{-- PAGE HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            ✏️ Input Jadwal Mengajar
        </h1>
        <p class="text-gray-500 mt-1 text-sm">
            Tambahkan sesi jadwal mengajar untuk guru di bawah ini. Pastikan tidak ada bentrok jam pelajaran.
        </p>
    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
            <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold">Terdapat kesalahan pada form:</p>
                <ul class="text-sm mt-1 space-y-0.5 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- FORM UTAMA --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                {{-- FORM HEADER --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600
                                flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr($guru->nama, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">{{ $guru->nama }}</p>
                        <p class="text-xs text-gray-400">Hari: <span class="font-semibold text-blue-600">{{ ucfirst($hari) }}</span></p>
                    </div>
                </div>

                {{-- FORM BODY --}}
                <form action="{{ route('staff_tu.jadwal_pelajaran.store') }}" method="POST" class="px-6 py-6 space-y-5">
                    @csrf
                    <input type="hidden" name="guru_id" value="{{ $guru->id }}">
                    <input type="hidden" name="hari" value="{{ $hari }}">

                    {{-- MATA PELAJARAN --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            📚 Mata Pelajaran
                            <span class="text-red-500 ml-0.5">*</span>
                        </label>
                        <select name="mata_pelajaran_id"
                                class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm text-gray-700
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                       bg-white transition @error('mata_pelajaran_id') border-red-400 bg-red-50 @enderror">
                            <option value="" disabled selected>-- Pilih mata pelajaran --</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id }}" {{ old('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}>
                                    {{ $mapel->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-400 mt-1">Pilih mata pelajaran yang akan diajarkan pada sesi ini.</p>
                        @error('mata_pelajaran_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ROMBEL --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            🏫 Kelas / Rombongan Belajar
                            <span class="text-red-500 ml-0.5">*</span>
                        </label>
                        <select name="rombel_id"
                                class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm text-gray-700
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                       bg-white transition @error('rombel_id') border-red-400 bg-red-50 @enderror">
                            <option value="" disabled selected>-- Pilih kelas / rombel --</option>
                            @foreach($rombels as $rombel)
                                <option value="{{ $rombel->id }}" {{ old('rombel_id') == $rombel->id ? 'selected' : '' }}>
                                    Tingkat {{ $rombel->tingkat }} — {{ $rombel->kode_rombel }} {{ $rombel->nama_rombel }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-400 mt-1">Pilih kelas yang akan menerima pelajaran ini.</p>
                        @error('rombel_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- JAM MULAI & SELESAI --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                ⏰ Jam Mulai
                                <span class="text-red-500 ml-0.5">*</span>
                            </label>
                            <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                   class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm text-gray-700
                                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          transition @error('jam_mulai') border-red-400 bg-red-50 @enderror">
                            @error('jam_mulai')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                ⏰ Jam Selesai
                                <span class="text-red-500 ml-0.5">*</span>
                            </label>
                            <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                                   class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm text-gray-700
                                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          transition @error('jam_selesai') border-red-400 bg-red-50 @enderror">
                            @error('jam_selesai')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 -mt-3">Pastikan jam selesai lebih akhir dari jam mulai.</p>

                    {{-- ACTIONS --}}
                    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm
                                       font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Jadwal
                        </button>
                        <a href="{{ route('staff_tu.jadwal_pelajaran.showGuru', $hari) }}"
                           class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-600
                                  hover:bg-gray-50 text-sm font-medium px-5 py-2.5 rounded-xl transition-colors">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- SIDEBAR INFO --}}
        <div class="space-y-4">

            {{-- PANDUAN --}}
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4">
                <p class="text-sm font-semibold text-blue-800 flex items-center gap-2 mb-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/>
                    </svg>
                    Panduan Pengisian
                </p>
                <ul class="space-y-2 text-xs text-blue-700">
                    <li class="flex items-start gap-2">
                        <span class="mt-0.5 w-4 h-4 bg-blue-200 text-blue-700 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[10px]">1</span>
                        Pilih <strong>mata pelajaran</strong> yang akan diajarkan.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-0.5 w-4 h-4 bg-blue-200 text-blue-700 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[10px]">2</span>
                        Pilih <strong>kelas atau rombel</strong> yang menjadi sasaran.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-0.5 w-4 h-4 bg-blue-200 text-blue-700 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[10px]">3</span>
                        Isi <strong>jam mulai</strong> dan <strong>jam selesai</strong> pelajaran.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-0.5 w-4 h-4 bg-blue-200 text-blue-700 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[10px]">4</span>
                        Klik <strong>Simpan Jadwal</strong> untuk menyimpan data.
                    </li>
                </ul>
            </div>

            {{-- PERINGATAN --}}
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
                <p class="text-sm font-semibold text-amber-800 flex items-center gap-2 mb-2">
                    ⚠️ Perhatian
                </p>
                <p class="text-xs text-amber-700 leading-relaxed">
                    Pastikan tidak ada bentrok jadwal dengan guru lain pada jam yang sama di kelas yang sama.
                    Periksa kembali sebelum menyimpan.
                </p>
            </div>

            {{-- INFO GURU --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Info Guru</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600
                                flex items-center justify-center text-white font-bold flex-shrink-0">
                        {{ strtoupper(substr($guru->nama, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $guru->nama }}</p>
                        <p class="text-xs text-gray-400">{{ $guru->nip ?? 'NIP tidak tersedia' }}</p>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100 grid grid-cols-2 gap-2 text-xs text-gray-500">
                    <div>
                        <p class="text-gray-400">Hari</p>
                        <p class="font-semibold text-gray-700">{{ ucfirst($hari) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Status</p>
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 font-semibold px-2 py-0.5 rounded-full text-[11px]">
                            ● Aktif
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection