@extends('layouts.staff_tu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 p-4 md:p-6">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur border border-blue-100 rounded-full px-3 py-1 text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-2 shadow-sm">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Kurikulum
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">
                Data <span class="text-blue-600">Mata Pelajaran</span>
            </h1>
            <p class="text-slate-500 mt-1 text-sm">Kelola seluruh mata pelajaran yang tersedia.</p>
        </div>

        <a href="{{ route('staff_tu.mata_pelajaran.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-150 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Tambah Mapel
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white/90 backdrop-blur border border-white rounded-2xl shadow-md overflow-hidden">

        {{-- TABLE HEADER BAR --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 bg-slate-50/80">
            <p class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Daftar Mata Pelajaran
            </p>
            <span class="text-xs bg-blue-50 text-blue-600 font-semibold px-2.5 py-1 rounded-full border border-blue-100">
                {{ $mapels->count() }} data
            </span>
        </div>

        {{-- DESKTOP TABLE --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-900 to-indigo-800 text-white text-left">
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider w-12 text-center">No</th>
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider w-36">Kode Mapel</th>
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider">Nama Mata Pelajaran</th>
                        <th class="px-4 py-3.5 font-semibold text-xs uppercase tracking-wider w-36 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($mapels as $mapel)
                    <tr class="hover:bg-blue-50/60 transition-colors duration-100 group">
                        <td class="px-4 py-3.5 text-center">
                            <span class="w-6 h-6 inline-flex items-center justify-center bg-slate-100 group-hover:bg-blue-100 text-slate-500 group-hover:text-blue-600 text-xs font-bold rounded-full transition-colors">
                                {{ $loop->iteration }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5">
                            <span class="inline-flex items-center bg-slate-100 text-slate-600 text-xs font-mono font-bold px-2.5 py-1 rounded-lg">
                                {{ $mapel->kode_mapel }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0 shadow-sm">
                                    {{ strtoupper(substr($mapel->nama_mapel, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-slate-700">{{ $mapel->nama_mapel }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('staff_tu.mata_pelajaran.edit', $mapel->id) }}"
                                   class="inline-flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('staff_tu.mata_pelajaran.destroy', $mapel->id) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <p class="text-slate-600 font-semibold">Belum ada mata pelajaran</p>
                                <p class="text-slate-400 text-xs">Tambahkan mata pelajaran pertama Anda.</p>
                                <a href="{{ route('staff_tu.mata_pelajaran.create') }}"
                                   class="mt-1 inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-xl transition shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    Tambah Mapel
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MOBILE CARD LIST --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse($mapels as $mapel)
            <div class="p-4 hover:bg-blue-50/40 transition-colors">
                <div class="flex items-center justify-between gap-3 mb-2">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-sm font-bold flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr($mapel->nama_mapel, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm leading-tight">{{ $mapel->nama_mapel }}</p>
                            <span class="inline-flex items-center bg-slate-100 text-slate-500 text-[10px] font-mono font-bold px-2 py-0.5 rounded mt-0.5">
                                {{ $mapel->kode_mapel }}
                            </span>
                        </div>
                    </div>
                    <span class="w-6 h-6 inline-flex items-center justify-center bg-slate-100 text-slate-400 text-xs font-bold rounded-full flex-shrink-0">
                        {{ $loop->iteration }}
                    </span>
                </div>
                <div class="flex gap-2 mt-2.5">
                    <a href="{{ route('staff_tu.mata_pelajaran.edit', $mapel->id) }}"
                       class="flex-1 inline-flex items-center justify-center gap-1.5 bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-700 text-xs font-semibold px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('staff_tu.mata_pelajaran.destroy', $mapel->id) }}"
                          method="POST" class="flex-1"
                          onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-1.5 bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 text-xs font-semibold px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="px-4 py-14 text-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <p class="text-slate-600 font-semibold text-sm">Belum ada mata pelajaran</p>
                    <a href="{{ route('staff_tu.mata_pelajaran.create') }}"
                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-xl transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Tambah Mapel
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        {{-- FOOTER --}}
        @if($mapels->count() > 0)
        <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/80 flex items-center justify-between text-xs text-slate-400">
            <span>Total <strong class="text-slate-600">{{ $mapels->count() }}</strong> mata pelajaran terdaftar</span>
        </div>
        @endif

    </div>

</div>
@endsection