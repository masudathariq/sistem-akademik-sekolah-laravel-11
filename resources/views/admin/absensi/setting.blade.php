@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-50">

    <div class="max-w-4xl mx-auto px-6 py-6 space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-xl font-semibold text-slate-900">
                Pengaturan Absensi
            </h1>
            <p class="text-sm text-slate-500">
                Atur waktu absensi masuk dan pulang guru
            </p>
        </div>

        {{-- SUCCESS --}}
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.absensi.setting.store') }}" class="space-y-6">
            @csrf

            {{-- JAM MASUK --}}
            <div class="bg-white border rounded-xl">

                <div class="p-5 border-b">
                    <h3 class="font-semibold text-slate-800">
                        Jam Absen Masuk
                    </h3>
                    <p class="text-sm text-slate-500">
                        Rentang waktu guru dapat melakukan absensi masuk
                    </p>
                </div>

                <div class="p-5 grid sm:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm text-slate-600">Waktu Mulai</label>
                        <input type="time"
                               name="jam_masuk_mulai"
                               value="{{ $setting->jam_masuk_mulai ?? '' }}"
                               class="mt-1 w-full px-3 py-2 text-sm border rounded-lg 
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <p class="text-xs text-slate-400 mt-1">Contoh: 06:30</p>
                    </div>

                    <div>
                        <label class="text-sm text-slate-600">Waktu Selesai</label>
                        <input type="time"
                               name="jam_masuk_selesai"
                               value="{{ $setting->jam_masuk_selesai ?? '' }}"
                               class="mt-1 w-full px-3 py-2 text-sm border rounded-lg 
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <p class="text-xs text-slate-400 mt-1">Contoh: 07:30</p>
                    </div>

                </div>
            </div>

            {{-- JAM PULANG --}}
            <div class="bg-white border rounded-xl">

                <div class="p-5 border-b">
                    <h3 class="font-semibold text-slate-800">
                        Jam Absen Pulang
                    </h3>
                    <p class="text-sm text-slate-500">
                        Rentang waktu guru dapat melakukan absensi pulang
                    </p>
                </div>

                <div class="p-5 grid sm:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm text-slate-600">Waktu Mulai</label>
                        <input type="time"
                               name="jam_pulang_mulai"
                               value="{{ $setting->jam_pulang_mulai ?? '' }}"
                               class="mt-1 w-full px-3 py-2 text-sm border rounded-lg 
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <p class="text-xs text-slate-400 mt-1">Contoh: 13:00</p>
                    </div>

                    <div>
                        <label class="text-sm text-slate-600">Waktu Selesai</label>
                        <input type="time"
                               name="jam_pulang_selesai"
                               value="{{ $setting->jam_pulang_selesai ?? '' }}"
                               class="mt-1 w-full px-3 py-2 text-sm border rounded-lg 
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <p class="text-xs text-slate-400 mt-1">Contoh: 15:00</p>
                    </div>

                </div>
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end gap-3 pt-2">

                <button type="submit"
                    class="px-5 py-2 text-sm bg-blue-600 text-white rounded-lg 
                           hover:bg-blue-700 transition">
                    Simpan Pengaturan
                </button>

            </div>

        </form>

        {{-- INFO --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">
            <h4 class="text-sm font-medium text-blue-700 mb-1">
                Informasi
            </h4>
            <p class="text-sm text-blue-600">
                Guru hanya dapat melakukan absensi jika waktu saat ini berada dalam rentang yang telah ditentukan.
            </p>
        </div>

    </div>
</div>
@endsection