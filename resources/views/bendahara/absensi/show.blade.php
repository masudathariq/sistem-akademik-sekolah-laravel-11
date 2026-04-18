@extends('layouts.bendahara')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

    body { background: #f9fafb; }

    .wrap { max-width: 1100px; margin: 0 auto; padding: 2rem 1.25rem; }

    /* back */
    .back {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: .8125rem; font-weight: 500; color: #6b7280;
        text-decoration: none; margin-bottom: 1.5rem;
    }
    .back:hover { color: #111827; }

    /* header */
    .header { margin-bottom: 1.75rem; }
    .header h1 { font-size: 1.375rem; font-weight: 700; color: #111827; margin: 0 0 4px; }
    .header p  { font-size: .875rem; color: #6b7280; margin: 0; }

    /* stats row */
    .stats { display: flex; flex-wrap: wrap; gap: .75rem; margin-bottom: 1.75rem; }
    .stat {
        flex: 1 1 120px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem 1.125rem;
    }
    .stat-num { font-size: 1.625rem; font-weight: 700; color: #111827; line-height: 1; }
    .stat-lbl { font-size: .75rem; color: #9ca3af; margin-top: 4px; }
    .stat-num.green  { color: #059669; }
    .stat-num.yellow { color: #d97706; }
    .stat-num.red    { color: #dc2626; }

    /* table card */
    .card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }
    .card-head {
        padding: .875rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        display: flex; align-items: center; justify-content: space-between;
    }
    .card-head span { font-size: .9375rem; font-weight: 600; color: #111827; }
    .card-head small { font-size: .75rem; color: #9ca3af; }

    .tbl-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: .8125rem; }
    thead th {
        background: #f9fafb;
        color: #6b7280;
        font-size: .6875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
        padding: .625rem 1rem;
        text-align: left;
        border-bottom: 1px solid #f3f4f6;
        white-space: nowrap;
    }
    tbody td {
        padding: .75rem 1rem;
        color: #374151;
        border-bottom: 1px solid #f9fafb;
        vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: #fafafa; }

    .tc { text-align: center; }

    /* status badge */
    .badge {
        display: inline-block;
        padding: 2px 10px;
        border-radius: 99px;
        font-size: .7rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .badge-hadir  { background: #ecfdf5; color: #059669; }
    .badge-izin   { background: #fffbeb; color: #d97706; }
    .badge-sakit  { background: #fef2f2; color: #dc2626; }
    .badge-other  { background: #f3f4f6; color: #6b7280; }

    .mono  { font-variant-numeric: tabular-nums; }
    .muted { color: #d1d5db; }

    /* maps link */
    .maps-link {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: .75rem; color: #3b82f6; text-decoration: none;
    }
    .maps-link:hover { text-decoration: underline; }

    /* foto */
    .foto {
        width: 36px; height: 36px;
        object-fit: cover; border-radius: 6px;
        display: block; margin: 0 auto;
    }

    .empty { text-align: center; padding: 3rem 1rem; color: #9ca3af; font-size: .875rem; }

    @media (max-width: 600px) {
        .stats .stat { flex: 1 1 calc(50% - .375rem); }
    }
</style>

<div class="wrap">

    <a href="{{ route('bendahara.rekap') }}" class="back">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>

    <div class="header">
        <h1>{{ $guru->nama }}</h1>
        <p>Absensi {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->locale('id')->isoFormat('MMMM') }} {{ $tahun }}</p>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-num green">{{ $hadir }}</div>
            <div class="stat-lbl">Hadir</div>
        </div>
        <div class="stat">
            <div class="stat-num yellow">{{ $izin }}</div>
            <div class="stat-lbl">Izin</div>
        </div>
        <div class="stat">
            <div class="stat-num red">{{ $sakit }}</div>
            <div class="stat-lbl">Sakit</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $jumlahHari }}</div>
            <div class="stat-lbl">Hari Aktif</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $persenHadir }}%</div>
            <div class="stat-lbl">Kehadiran</div>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <span>Riwayat Harian</span>
            <small>{{ $absensi->count() }} catatan</small>
        </div>
        <div class="tbl-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th class="tc">Masuk</th>
                        <th class="tc">Pulang</th>
                        <th class="tc">Status</th>
                        <th>Lokasi</th>
                        <th class="tc">Maps</th>
                        <th class="tc">Foto</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $a)
                        @php
                            $s = strtolower($a->status ?? '');
                            $bc = match($s) {
                                'hadir'  => 'badge-hadir',
                                'izin'   => 'badge-izin',
                                'sakit'  => 'badge-sakit',
                                default  => 'badge-other'
                            };
                        @endphp
                        <tr>
                            <td>
                                <div style="font-weight:600;">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</div>
                                <div style="font-size:.7rem; color:#9ca3af;">{{ \Carbon\Carbon::parse($a->tanggal)->locale('id')->isoFormat('dddd') }}</div>
                            </td>
                            <td class="tc mono">{{ $a->jam_masuk ?? '—' }}</td>
                            <td class="tc mono">{{ $a->jam_pulang ?? '—' }}</td>
                            <td class="tc">
                                <span class="badge {{ $bc }}">{{ ucfirst($a->status ?? '-') }}</span>
                            </td>
                            <td style="color:#6b7280; font-size:.8rem;">{{ $a->lokasi ?? '—' }}</td>
                            <td class="tc">
                                @if($a->latitude && $a->longitude)
                                    <a href="https://www.google.com/maps?q={{ $a->latitude }},{{ $a->longitude }}" target="_blank" class="maps-link">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="muted">—</span>
                                @endif
                            </td>
                            <td class="tc">
                                @if($a->foto)
                                    <a href="{{ asset('storage/'.$a->foto) }}" target="_blank">
                                        <img src="{{ asset('storage/'.$a->foto) }}" class="foto" alt="foto">
                                    </a>
                                @else
                                    <span class="muted">—</span>
                                @endif
                            </td>
                            <td style="color:#6b7280; font-size:.8rem;">{{ $a->keterangan ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty">Belum ada data absensi untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection