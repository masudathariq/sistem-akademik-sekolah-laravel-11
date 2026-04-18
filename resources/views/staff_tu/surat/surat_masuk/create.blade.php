@extends('layouts.staff_tu')

@section('title', 'Tambah Surat Masuk')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Tambah Surat Masuk
        </h2>
        <a href="{{ route('staff_tu.surat_masuk.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl p-6">

        <form action="{{ route('staff_tu.surat_masuk.store') }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nomor Surat --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nomor Surat <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="nomor_surat"
                           value="{{ old('nomor_surat') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('nomor_surat') border-red-500 @enderror"
                           required>
                    @error('nomor_surat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Jenis Surat
                    </label>
                    <select name="jenis"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('jenis') border-red-500 @enderror">
                        <option value="">-- Pilih Jenis --</option>
                        @foreach(['Surat Dinas','Surat Undangan','Surat Edaran','Surat Keterangan','Surat Pemberitahuan','Lainnya'] as $jenis)
                            <option value="{{ $jenis }}" {{ old('jenis') == $jenis ? 'selected' : '' }}>
                                {{ $jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Surat --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Surat <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                           name="tanggal_surat"
                           value="{{ old('tanggal_surat') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('tanggal_surat') border-red-500 @enderror"
                           required>
                    @error('tanggal_surat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Diterima --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Diterima <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                           name="tanggal_diterima"
                           value="{{ old('tanggal_diterima', date('Y-m-d')) }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('tanggal_diterima') border-red-500 @enderror"
                           required>
                    @error('tanggal_diterima')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pengirim --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Pengirim <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="pengirim"
                           value="{{ old('pengirim') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('pengirim') border-red-500 @enderror"
                           required>
                    @error('pengirim')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Diteruskan Ke --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Diteruskan Ke
                    </label>
                    <input type="text"
                           name="diteruskan_ke"
                           value="{{ old('diteruskan_ke') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('diteruskan_ke') border-red-500 @enderror"
                           placeholder="Contoh: Kepala Sekolah">
                    @error('diteruskan_ke')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Perihal --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Perihal <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="perihal"
                           value="{{ old('perihal') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('perihal') border-red-500 @enderror"
                           required>
                    @error('perihal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Isi Surat
                    </label>
                    <textarea name="isi"
                              rows="5"
                              class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('isi') border-red-500 @enderror"
                              placeholder="Ringkasan isi surat...">{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lampiran --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lampiran
                    </label>
                    <input type="file"
                           name="lampiran"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('lampiran') border-red-500 @enderror"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <p class="text-xs text-gray-500 mt-1">
                        Format: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)
                    </p>
                    @error('lampiran')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('status') border-red-500 @enderror"
                            required>
                        <option value="Belum Dibaca" {{ old('status','Belum Dibaca') == 'Belum Dibaca' ? 'selected' : '' }}>
                            Belum Dibaca
                        </option>
                        <option value="Sudah Dibaca" {{ old('status') == 'Sudah Dibaca' ? 'selected' : '' }}>
                            Sudah Dibaca
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Catatan
                    </label>
                    <textarea name="catatan"
                              rows="3"
                              class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 @error('catatan') border-red-500 @enderror"
                              placeholder="Catatan tambahan...">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('staff_tu.surat_masuk.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
