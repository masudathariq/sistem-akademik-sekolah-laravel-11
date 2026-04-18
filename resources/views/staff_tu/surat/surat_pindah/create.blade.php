@extends('layouts.staff_tu')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-7">
        <a href="{{ route('staff_tu.surat-pindah.index') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-400 hover:text-gray-700 mb-4 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <p class="text-xs font-bold text-blue-700 uppercase tracking-widest mb-1">Tata Usaha</p>
        <h1 class="text-2xl font-bold text-gray-900">Buat Surat Keterangan Pindah</h1>
        <p class="text-sm text-gray-400 mt-1">Lengkapi semua data di bawah ini, lalu klik <strong class="text-gray-600">Simpan Surat</strong>.</p>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
        <div class="flex items-center gap-2 text-sm font-bold text-red-700 mb-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Mohon periksa kembali isian berikut:
        </div>
        <ul class="text-sm text-red-600 space-y-1 pl-6 list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('staff_tu.surat-pindah.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- SECTION 1: Data Surat --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">Data Surat</p>
                    <p class="text-xs text-gray-400">Nomor dan tanggal penerbitan surat</p>
                </div>
            </div>
            <div class="px-6 py-5 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Surat <span class="text-red-400">*</span></label>
                    <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}"
                           placeholder="Contoh: 001/MTs/2025"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Surat <span class="text-red-400">*</span></label>
                    <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition" required>
                </div>
            </div>
        </div>

        {{-- SECTION 2: Data Siswa --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">Data Siswa</p>
                    <p class="text-xs text-gray-400">Identitas lengkap siswa yang pindah</p>
                </div>
            </div>
            <div class="px-6 py-5 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Siswa <span class="text-red-400">*</span></label>
                    <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}"
                           placeholder="Nama lengkap siswa"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Kelamin</label>
                    <select name="jenis_kelamin"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition bg-white">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                           placeholder="Kota/Kabupaten"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">NIS</label>
                    <input type="text" name="nis" value="{{ old('nis') }}"
                           placeholder="Nomor Induk Siswa"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}"
                           placeholder="Nomor Induk Siswa Nasional"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kelas Saat Ini</label>
                    <input type="text" name="kelas" value="{{ old('kelas') }}"
                           placeholder="Contoh: IX A"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Siswa</label>
                    <textarea name="alamat_siswa" rows="3"
                              placeholder="Alamat lengkap tempat tinggal siswa"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition resize-none">{{ old('alamat_siswa') }}</textarea>
                </div>
            </div>
        </div>

        {{-- SECTION 3: Data Orang Tua --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">Data Orang Tua / Wali</p>
                    <p class="text-xs text-gray-400">Informasi wali yang bertanggung jawab</p>
                </div>
            </div>
            <div class="px-6 py-5 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Wali</label>
                    <input type="text" name="nama_wali" value="{{ old('nama_wali') }}"
                           placeholder="Nama lengkap orang tua/wali"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}"
                           placeholder="Contoh: Wiraswasta"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Wali</label>
                    <textarea name="alamat_wali" rows="3"
                              placeholder="Alamat lengkap orang tua/wali"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-500 transition resize-none">{{ old('alamat_wali') }}</textarea>
                </div>
            </div>
        </div>

        {{-- SECTION 4: Data Pindah --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">Data Pindah Sekolah</p>
                    <p class="text-xs text-gray-400">Tujuan dan alasan kepindahan</p>
                </div>
            </div>
            <div class="px-6 py-5 grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sekolah Tujuan</label>
                    <input type="text" name="sekolah_tujuan" value="{{ old('sekolah_tujuan') }}"
                           placeholder="Nama sekolah tujuan"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-100 focus:border-orange-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alasan Pindah</label>
                    <input type="text" name="alasan_pindah" value="{{ old('alasan_pindah') }}"
                           placeholder="Contoh: Ikut orang tua pindah domisili"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-100 focus:border-orange-500 transition">
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-1 pb-6">
            <p class="text-xs text-gray-400"><span class="text-red-400 font-bold">*</span> Wajib diisi</p>
            <div class="flex items-center gap-3">
                <a href="{{ route('staff_tu.surat-pindah.index') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-gray-500 hover:text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                    Batal
                </a>
                <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Surat
                </button>
            </div>
        </div>

    </form>
</div>
</div>
@endsection