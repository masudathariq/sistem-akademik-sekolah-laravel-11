@extends('layouts.bendahara')

@section('title', 'Dashboard Bendahara')
@section('page-title', 'Dashboard Bendahara')

@section('content')
@php
    $rupiah = fn ($value) => 'Rp ' . number_format((float) $value, 0, ',', '.');
    $tabunganCoverage = $jumlahSiswa > 0 ? round(($siswaPunyaTabungan / $jumlahSiswa) * 100) : 0;
    $maxHarian = max(1, $rekapHarian->max(fn ($item) => max($item['setor'], $item['tarik'])));
    $maxBulanan = max(1, $rekapBulanan->max(fn ($item) => max($item['setor'], $item['tarik'])));
    $adaRekapHarian = $rekapHarian->sum('setor') + $rekapHarian->sum('tarik') > 0;
    $adaRekapBulanan = $rekapBulanan->sum('setor') + $rekapBulanan->sum('tarik') > 0;
@endphp

<div class="mx-auto max-w-7xl space-y-6">
    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm md:p-6">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl">
                <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Dashboard Bendahara</p>
                <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-900 md:text-3xl">
                    Ringkasan keuangan sekolah
                </h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Pantau setoran, penarikan, saldo tabungan siswa, dan rekap gaji dari satu halaman yang terhubung langsung dengan data sistem.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row lg:flex-col xl:flex-row">
                <a href="{{ route('bendahara.tabungan-siswa.index') }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700">
                    Kelola Tabungan
                </a>
                <a href="{{ route('bendahara.rekap-gaji.index') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                    Rekap Gaji
                </a>
            </div>
        </div>

        <div class="mt-5 grid gap-3 border-t border-slate-100 pt-5 sm:grid-cols-3">
            <div class="rounded-xl bg-slate-50 px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Hari ini</p>
                <p class="mt-1 text-sm font-bold text-slate-900">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="rounded-xl bg-slate-50 px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tahun ajaran</p>
                <p class="mt-1 text-sm font-bold text-slate-900">{{ $tahunAktif?->tahun_ajaran ?? 'Belum diatur' }}</p>
            </div>
            <div class="rounded-xl bg-slate-50 px-4 py-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Semester</p>
                <p class="mt-1 text-sm font-bold text-slate-900">{{ $tahunAktif?->semester ?? '-' }}</p>
            </div>
        </div>
    </section>

    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach([
            ['label' => 'Total Pemasukan', 'value' => $rupiah($totalSetoran), 'note' => 'Akumulasi semua setoran tabungan', 'tone' => 'emerald', 'icon' => 'M12 19V5m0 0l-6 6m6-6l6 6'],
            ['label' => 'Total Tabungan Siswa', 'value' => $rupiah($totalTabungan), 'note' => $siswaPunyaTabungan . ' siswa memiliki saldo aktif', 'tone' => 'blue', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
            ['label' => 'Jumlah Transaksi', 'value' => number_format($jumlahTransaksi, 0, ',', '.'), 'note' => 'Total setoran dan penarikan', 'tone' => 'violet', 'icon' => 'M9 5h6M9 12h6m-6 4h6M5 7a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7z'],
            ['label' => 'Total Penarikan', 'value' => $rupiah($totalPenarikan), 'note' => 'Akumulasi semua penarikan tabungan', 'tone' => 'rose', 'icon' => 'M12 5v14m0 0l6-6m-6 6l-6-6'],
        ] as $card)
            @php
                $tone = [
                    'emerald' => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
                    'blue' => 'bg-blue-50 text-blue-700 ring-blue-100',
                    'violet' => 'bg-violet-50 text-violet-700 ring-violet-100',
                    'rose' => 'bg-rose-50 text-rose-700 ring-rose-100',
                ][$card['tone']];
            @endphp
            <article class="flex min-h-[150px] flex-col justify-between rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <p class="max-w-[12rem] text-xs font-bold uppercase tracking-wide text-slate-500">{{ $card['label'] }}</p>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl ring-1 {{ $tone }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}" />
                        </svg>
                    </div>
                </div>
                <div class="mt-5">
                    <p class="break-words text-2xl font-black leading-tight text-slate-900">{{ $card['value'] }}</p>
                    <p class="mt-2 text-sm leading-5 text-slate-500">{{ $card['note'] }}</p>
                </div>
            </article>
        @endforeach
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-black text-slate-900">Rekap Transaksi Tabungan</h3>
                    <p class="mt-1 text-sm text-slate-500">Setoran dan penarikan berdasarkan periode.</p>
                </div>
                <a href="{{ route('bendahara.tabungan-siswa.index') }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-3.5 py-2 text-sm font-bold text-white hover:bg-blue-700">
                    Buka Data Tabungan
                </a>
            </div>

            <div class="p-5">
                <div class="grid gap-3 md:grid-cols-3">
                    @foreach($rekapPeriode as $item)
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm font-black text-slate-900">{{ $item['label'] }}</p>
                                <span class="rounded-full bg-white px-2.5 py-1 text-xs font-bold text-slate-600 ring-1 ring-slate-200">
                                    {{ number_format($item['transaksi'], 0, ',', '.') }} trx
                                </span>
                            </div>
                            <dl class="mt-4 space-y-3 text-sm">
                                <div class="flex items-center justify-between gap-3">
                                    <dt class="text-slate-500">Setoran</dt>
                                    <dd class="text-right font-black text-emerald-700">{{ $rupiah($item['setor']) }}</dd>
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <dt class="text-slate-500">Penarikan</dt>
                                    <dd class="text-right font-black text-rose-700">{{ $rupiah($item['tarik']) }}</dd>
                                </div>
                            </dl>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Cakupan Tabungan</h3>
                        <p class="mt-1 text-sm text-slate-500">Siswa dengan saldo tabungan aktif.</p>
                    </div>
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-black text-blue-700">{{ $tabunganCoverage }}%</span>
                </div>
                <div class="mt-5">
                    <div class="flex items-end justify-between gap-4">
                        <p class="text-4xl font-black text-slate-900">{{ $siswaPunyaTabungan }}</p>
                        <p class="text-right text-sm text-slate-500">dari <span class="font-black text-slate-900">{{ $jumlahSiswa }}</span> siswa</p>
                    </div>
                    <div class="mt-4 h-3 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-blue-600" style="width: {{ min(100, $tabunganCoverage) }}%;"></div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 p-5">
                    <h3 class="text-lg font-black text-slate-900">Rekap Gaji Bulan Ini</h3>
                    <p class="mt-1 text-sm text-slate-500">Ringkasan slip gaji yang sudah dikirim.</p>
                </div>
                <dl class="divide-y divide-slate-100 p-5 pt-0 text-sm">
                    @foreach([
                        ['label' => 'Slip terkirim', 'value' => number_format($ringkasanGaji['slip_bulan_ini'], 0, ',', '.'), 'class' => 'text-slate-900'],
                        ['label' => 'Total gaji', 'value' => $rupiah($ringkasanGaji['total_gaji_bulan_ini']), 'class' => 'text-slate-900'],
                        ['label' => 'Penambahan', 'value' => $rupiah($ringkasanGaji['total_penambahan_bulan_ini']), 'class' => 'text-emerald-700'],
                        ['label' => 'Pengurangan', 'value' => $rupiah($ringkasanGaji['total_pengurangan_bulan_ini']), 'class' => 'text-rose-700'],
                    ] as $row)
                        <div class="flex items-center justify-between gap-4 py-3 first:pt-5">
                            <dt class="text-slate-500">{{ $row['label'] }}</dt>
                            <dd class="text-right font-black {{ $row['class'] }}">{{ $row['value'] }}</dd>
                        </div>
                    @endforeach
                </dl>
                <div class="border-t border-slate-100 p-5">
                    <a href="{{ route('bendahara.rekap-gaji.index') }}" class="inline-flex w-full items-center justify-center rounded-lg border border-slate-200 px-3 py-2.5 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                        Lihat Rekap Gaji
                    </a>
                </div>
            </div>
        </aside>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-black text-slate-900">Transaksi Terbaru</h3>
                    <p class="mt-1 text-sm text-slate-500">Daftar setoran dan penarikan terakhir dari tabungan siswa.</p>
                </div>
                <span class="w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-black text-slate-600">{{ number_format($jumlahTransaksi, 0, ',', '.') }} transaksi</span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[720px] w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-black uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Tanggal</th>
                            <th class="px-5 py-3">Siswa</th>
                            <th class="px-5 py-3">Jenis</th>
                            <th class="px-5 py-3 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($transaksiTerbaru as $trx)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-600">{{ $trx->tanggal?->translatedFormat('d M Y') ?? '-' }}</td>
                                <td class="px-5 py-4">
                                    <div class="font-black text-slate-900">{{ $trx->tabunganSiswa?->siswa?->nama_siswa ?? 'Siswa tidak ditemukan' }}</div>
                                    <div class="mt-0.5 max-w-md truncate text-xs text-slate-500">{{ $trx->keterangan ?: 'Tanpa keterangan' }}</div>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-black {{ $trx->jenis === 'setor' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ $trx->jenis === 'setor' ? 'Setoran' : 'Penarikan' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-right font-black {{ $trx->jenis === 'setor' ? 'text-emerald-700' : 'text-rose-700' }}">
                                    {{ $trx->jenis === 'setor' ? '+' : '-' }} {{ $rupiah($trx->nominal) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-12 text-center">
                                    <p class="text-sm font-bold text-slate-700">Belum ada transaksi tabungan siswa.</p>
                                    <p class="mt-1 text-sm text-slate-500">Transaksi terbaru akan tampil di sini setelah bendahara menambahkan setoran atau penarikan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 p-5">
                    <h3 class="text-lg font-black text-slate-900">Saldo Tabungan Terbesar</h3>
                    <p class="mt-1 text-sm text-slate-500">Lima siswa dengan saldo tertinggi.</p>
                </div>
                <div class="space-y-3 p-5">
                    @forelse($saldoTerbesar as $tabungan)
                        <div class="flex items-center justify-between gap-4 rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-black text-slate-900">{{ $tabungan->siswa?->nama_siswa ?? 'Siswa tidak ditemukan' }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">Saldo tabungan</p>
                            </div>
                            <p class="shrink-0 text-sm font-black text-blue-700">{{ $rupiah($tabungan->saldo) }}</p>
                        </div>
                    @empty
                        <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-8 text-center">
                            <p class="text-sm font-bold text-slate-700">Belum ada saldo tabungan.</p>
                            <p class="mt-1 text-sm text-slate-500">Daftar akan terisi setelah siswa memiliki saldo.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 p-5">
                    <h3 class="text-lg font-black text-slate-900">Akses Cepat</h3>
                    <p class="mt-1 text-sm text-slate-500">Menu utama bendahara yang sering digunakan.</p>
                </div>
                <div class="grid grid-cols-2 gap-3 p-5">
                    @foreach([
                        ['label' => 'Tabungan', 'route' => route('bendahara.tabungan-siswa.index')],
                        ['label' => 'Rekap Gaji', 'route' => route('bendahara.rekap-gaji.index')],
                        ['label' => 'Gaji Pokok', 'route' => route('bendahara.gaji-pokok.index')],
                        ['label' => 'Penambahan', 'route' => route('bendahara.penambahan.index')],
                        ['label' => 'Pengurangan', 'route' => route('bendahara.pengurangan.index')],
                        ['label' => 'Rekap Absen', 'route' => route('bendahara.rekap')],
                    ] as $shortcut)
                        <a href="{{ $shortcut['route'] }}" class="flex min-h-14 items-center justify-center rounded-xl border border-slate-200 px-3 py-3 text-center text-sm font-bold text-slate-700 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                            {{ $shortcut['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
