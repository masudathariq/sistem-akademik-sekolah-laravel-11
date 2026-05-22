<style>
/* ── Base ── */
.rt-wrap {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

/* ── DESKTOP TABLE ── */
.rt-tbl-wrap { overflow-x: auto; }

.rt-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .8125rem;
}

.rt-table thead th {
    background: #f8faff;
    color: #94a3b8;
    font-size: .6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    padding: .75rem 1rem;
    border-bottom: 2px solid #eff2ff;
    white-space: nowrap;
    text-align: center;
}
.rt-table thead th:first-child { text-align: left; }

.rt-table tbody td {
    padding: .75rem 1rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
    text-align: center;
}
.rt-table tbody td:first-child { text-align: left; }
.rt-table tbody tr:last-child td { border-bottom: none; }
.rt-table tbody tr { transition: background .15s; }
.rt-table tbody tr:hover td { background: #f8faff; }

/* Kelas cell */
.rt-kelas {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
}
.rt-kelas-badge {
    width: 28px; height: 28px;
    border-radius: 8px;
    background: #eff6ff;
    color: #1d4ed8;
    font-size: .7rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.rt-kelas-label {
    font-weight: 600;
    color: #1e293b;
    font-size: .8125rem;
}

/* Number cells */
.num-total {
    font-weight: 800;
    color: #1d4ed8;
    font-size: .9375rem;
}
.num-l { font-weight: 700; color: #0284c7; }
.num-p { font-weight: 700; color: #db2777; }

/* Mini progress bar in total cell */
.rt-total-cell { min-width: 110px; }
.rt-bar-bg {
    height: 4px;
    background: #eff6ff;
    border-radius: 4px;
    margin-top: 4px;
    overflow: hidden;
}
.rt-bar-fill {
    height: 100%;
    border-radius: 4px;
    background: linear-gradient(90deg, #1d4ed8, #60a5fa);
    transition: width .4s ease;
}

/* Gender split pill */
.rt-gender-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
.rt-gender-pill {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: .7rem;
    font-weight: 700;
}
.pill-l { background: #e0f2fe; color: #0284c7; }
.pill-p { background: #fce7f3; color: #be185d; }

/* Ratio bar */
.rt-ratio-wrap { min-width: 90px; }
.rt-ratio-bar {
    height: 6px;
    border-radius: 4px;
    overflow: hidden;
    display: flex;
    margin-top: 4px;
}
.rt-ratio-l { background: #0ea5e9; height: 100%; }
.rt-ratio-p { background: #f472b6; height: 100%; }
.rt-ratio-label {
    font-size: .68rem;
    color: #94a3b8;
    font-weight: 600;
    margin-top: 3px;
    display: flex;
    justify-content: space-between;
}

/* Empty row */
.empty-row td {
    text-align: center;
    padding: 2.5rem 1rem;
    color: #94a3b8;
    font-size: .875rem;
}

/* ── MOBILE CARDS ── */
@media (max-width: 600px) {
    .rt-tbl-wrap { display: none; }
    .rt-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .625rem;
    }
}
@media (min-width: 601px) {
    .rt-cards { display: none; }
}

.rt-card {
    border: 1px solid #e8eeff;
    border-radius: 14px;
    padding: .875rem 1rem;
    background: #fff;
    transition: box-shadow .2s, transform .2s;
}
.rt-card:hover {
    box-shadow: 0 4px 16px rgba(30,64,175,.10);
    transform: translateY(-2px);
}
.rt-card-header {
    display: flex;
    align-items: center;
    gap: .5rem;
    margin-bottom: .75rem;
    padding-bottom: .6rem;
    border-bottom: 1px solid #f1f5f9;
}
.rt-card-badge {
    width: 26px; height: 26px;
    border-radius: 8px;
    background: #eff6ff;
    color: #1d4ed8;
    font-size: .68rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
}
.rt-card-tingkat {
    font-size: .75rem;
    color: #475569;
    font-weight: 700;
}
.rt-card-nums {
    display: flex;
    gap: .5rem;
    align-items: flex-end;
}
.rt-card-num { flex: 1; }
.rt-card-num .val {
    font-size: 1.125rem;
    font-weight: 800;
    line-height: 1.1;
}
.rt-card-num .lbl {
    font-size: .6rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-top: 2px;
    color: #94a3b8;
}
.rt-card-ratio {
    height: 4px;
    border-radius: 4px;
    overflow: hidden;
    display: flex;
    margin-top: .625rem;
}
</style>

@php
    $maxTotal = collect($rekapTingkat)->max('total') ?: 1;
@endphp

<div class="rt-wrap">

    {{-- ── DESKTOP TABLE ── --}}
    <div class="rt-tbl-wrap">
        <table class="rt-table">
            <thead>
                <tr>
                    <th>Tingkat</th>
                    <th>Total Siswa</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Rasio L : P</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekapTingkat as $tingkat => $data)
                @php
                    $pctBar = $maxTotal > 0 ? round($data['total'] / $maxTotal * 100) : 0;
                    $total  = $data['total'] ?: 1;
                    $ratioL = round($data['L'] / $total * 100);
                    $ratioP = 100 - $ratioL;
                @endphp
                <tr>
                    {{-- Kelas --}}
                    <td>
                        <div class="rt-kelas">
                            <span class="rt-kelas-badge">{{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}</span>
                            <span class="rt-kelas-label">Kelas {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}</span>
                        </div>
                    </td>

                    {{-- Total --}}
                    <td class="rt-total-cell">
                        <span class="num-total">{{ $data['total'] }}</span>
                        <div class="rt-bar-bg">
                            <div class="rt-bar-fill" @style(['width: '.$pctBar.'%'])></div>
                        </div>
                    </td>

                    {{-- Laki-laki --}}
                    <td>
                        <span class="rt-gender-pill pill-l">
                            L {{ $data['L'] }}
                        </span>
                    </td>

                    {{-- Perempuan --}}
                    <td>
                        <span class="rt-gender-pill pill-p">
                            P {{ $data['P'] }}
                        </span>
                    </td>

                    {{-- Rasio --}}
                    <td class="rt-ratio-wrap">
                        <div class="rt-ratio-label">
                            <span style="color:#0284c7;">{{ $ratioL }}%</span>
                            <span style="color:#db2777;">{{ $ratioP }}%</span>
                        </div>
                        <div class="rt-ratio-bar">
<div class="rt-ratio-l" @style(['width: '.$ratioL.'%'])></div>
<div class="rt-ratio-p" @style(['width: '.$ratioP.'%'])></div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row">
                    <td colspan="5">
                        <div style="font-size:1.5rem;margin-bottom:.5rem;font-weight:800;color:#1d4ed8;">Data</div>
                        Data belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── MOBILE CARDS ── --}}
    <div class="rt-cards">
        @forelse($rekapTingkat as $tingkat => $data)
        @php
            $total  = $data['total'] ?: 1;
            $ratioL = round($data['L'] / $total * 100);
            $ratioP = 100 - $ratioL;
        @endphp
        <div class="rt-card">
            <div class="rt-card-header">
                <div class="rt-card-badge">{{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}</div>
                <div class="rt-card-tingkat">Kelas {{ \App\Models\Tatausaha\Rombel::formatTingkat($tingkat) }}</div>
            </div>
            <div class="rt-card-nums">
                <div class="rt-card-num">
                    <div class="val num-total">{{ $data['total'] }}</div>
                    <div class="lbl">Total</div>
                </div>
                <div class="rt-card-num">
                    <div class="val num-l">{{ $data['L'] }}</div>
                    <div class="lbl">L</div>
                </div>
                <div class="rt-card-num">
                    <div class="val num-p">{{ $data['P'] }}</div>
                    <div class="lbl">P</div>
                </div>
            </div>
            <div class="rt-card-ratio">
<div class="rt-ratio-l" @style(['width: '.$ratioL.'%'])></div>
<div class="rt-ratio-p" @style(['width: '.$ratioP.'%'])></div>
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:2rem;color:#94a3b8;font-size:.875rem;grid-column:span 2;">
            <div style="font-size:1.5rem;margin-bottom:.5rem;font-weight:800;color:#1d4ed8;">Data</div>
            Data belum tersedia
        </div>
        @endforelse
    </div>

</div>
