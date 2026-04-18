@if(!empty($rekapTingkat))
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
    .stats-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f0f4ff;
        padding: 1.75rem;
        border-radius: 24px;
    }

    /* ── KPI CARDS ── */
    .kpi-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    @media (min-width: 768px) {
        .kpi-row { grid-template-columns: repeat(4, 1fr); }
    }

    .kpi-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 8px rgba(30,64,175,.07);
        transition: transform .2s, box-shadow .2s;
    }
    .kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(30,64,175,.12);
    }

    .kpi-icon {
        width: 46px; height: 46px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .kpi-icon.blue   { background: #eff6ff; color: #1d4ed8; }
    .kpi-icon.sky    { background: #e0f2fe; color: #0284c7; }
    .kpi-icon.pink   { background: #fdf2f8; color: #db2777; }
    .kpi-icon.green  { background: #f0fdf4; color: #16a34a; }

    .kpi-body { display: flex; flex-direction: column; min-width: 0; }
    .kpi-value {
        font-size: 1.55rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.15;
    }
    .kpi-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-top: 2px;
    }
    .kpi-badge {
        font-size: 0.68rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        margin-top: 4px;
        display: inline-block;
        width: fit-content;
    }
    .badge-blue  { background: #dbeafe; color: #1d4ed8; }
    .badge-sky   { background: #e0f2fe; color: #0369a1; }
    .badge-pink  { background: #fce7f3; color: #be185d; }
    .badge-green { background: #dcfce7; color: #15803d; }

    /* ── MAIN CHART GRID ── */
    .chart-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }

    @media (min-width: 1024px) {
        .chart-grid { grid-template-columns: 2fr 1fr; }
    }

    .chart-card {
        background: #fff;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(30,64,175,.06);
        transition: box-shadow .2s;
    }
    .chart-card:hover { box-shadow: 0 6px 20px rgba(30,64,175,.11); }

    .chart-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.25rem;
    }
    .chart-card-title {
        font-size: 0.85rem;
        font-weight: 800;
        color: #1e3a8a;
        text-transform: uppercase;
        letter-spacing: .06em;
    }
    .chart-card-sub {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 2px;
        font-weight: 500;
    }

    .chip {
        font-size: 0.67rem;
        font-weight: 700;
        border-radius: 20px;
        padding: 3px 10px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .chip-live { background: #dcfce7; color: #15803d; }
    .chip-live::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #22c55e;
        animation: pulse-dot 1.5s infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; }
        50% { opacity: .3; }
    }

    .chart-wrap { position: relative; width: 100%; }
    .h-260 { height: 260px; }
    .h-220 { height: 220px; }

    /* ── BOTTOM ROW ── */
    .chart-grid-bottom {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
        margin-top: 1.25rem;
    }

    @media (min-width: 768px) {
        .chart-grid-bottom { grid-template-columns: 1fr 1fr; }
    }

    /* ── DONUT LEGEND ── */
    .donut-legend {
        display: flex;
        flex-direction: column;
        gap: .6rem;
        margin-top: 1rem;
    }
    .legend-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .legend-dot {
        width: 10px; height: 10px;
        border-radius: 3px;
        flex-shrink: 0;
    }
    .legend-name {
        font-size: 0.78rem;
        color: #475569;
        font-weight: 600;
        flex: 1;
        margin-left: .5rem;
    }
    .legend-pct {
        font-size: 0.78rem;
        font-weight: 800;
        color: #0f172a;
    }
    .legend-bar-wrap {
        width: 60px;
        height: 6px;
        background: #f1f5f9;
        border-radius: 4px;
        margin: 0 .75rem;
        overflow: hidden;
    }
    .legend-bar-fill {
        height: 100%;
        border-radius: 4px;
    }

    /* ── RANK TABLE ── */
    .rank-table { width: 100%; border-collapse: collapse; }
    .rank-table th {
        font-size: 0.68rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .05em;
        padding: .5rem .6rem;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    .rank-table td {
        font-size: 0.82rem;
        padding: .6rem .6rem;
        border-bottom: 1px solid #f8fafc;
        color: #334155;
        font-weight: 500;
        vertical-align: middle;
    }
    .rank-table tr:last-child td { border-bottom: none; }
    .rank-num {
        width: 24px; height: 24px;
        border-radius: 8px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 0.75rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .rank-bar-bg {
        height: 6px;
        background: #f1f5f9;
        border-radius: 4px;
        overflow: hidden;
    }
    .rank-bar-fill {
        height: 100%;
        border-radius: 4px;
        background: linear-gradient(90deg, #1d4ed8, #60a5fa);
    }
    .gender-split {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 0.72rem;
        font-weight: 700;
    }
    .gender-m { color: #0284c7; }
    .gender-f { color: #db2777; }
</style>

@php
    $chartLabels  = array_map(fn($t) => 'Kelas ' . $t, array_keys($rekapTingkat));
    $chartTotal   = array_column(array_values($rekapTingkat), 'total');
    $chartL       = array_column(array_values($rekapTingkat), 'L');
    $chartP       = array_column(array_values($rekapTingkat), 'P');
    $chartTotalL  = array_sum($chartL);
    $chartTotalP  = array_sum($chartP);
    $grandTotal   = $chartTotalL + $chartTotalP;
    $pctL         = $grandTotal > 0 ? round($chartTotalL / $grandTotal * 100, 1) : 0;
    $pctP         = $grandTotal > 0 ? round($chartTotalP / $grandTotal * 100, 1) : 0;

    // Avg per kelas
    $avgPerKelas  = count($chartTotal) > 0 ? round(array_sum($chartTotal) / count($chartTotal)) : 0;

    // Kelas terbanyak
    $maxIdx       = array_search(max($chartTotal), $chartTotal);
    $maxKelas     = $chartLabels[$maxIdx] ?? '-';
@endphp

<div id="chartData"
    data-labels='@json($chartLabels)'
    data-total='@json($chartTotal)'
    data-l='@json($chartL)'
    data-p='@json($chartP)'
    data-total-l='{{ $chartTotalL }}'
    data-total-p='{{ $chartTotalP }}'
    style="display:none;"></div>

<div class="stats-wrapper">

    {{-- ── KPI CARDS ── --}}
    <div class="kpi-row">
        <div class="kpi-card">
            <div class="kpi-icon blue">👥</div>
            <div class="kpi-body">
                <span class="kpi-value">{{ number_format($grandTotal) }}</span>
                <span class="kpi-label">Total Siswa</span>
                <span class="kpi-badge badge-blue">Semua Kelas</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon sky">♂</div>
            <div class="kpi-body">
                <span class="kpi-value">{{ number_format($chartTotalL) }}</span>
                <span class="kpi-label">Laki-laki</span>
                <span class="kpi-badge badge-sky">{{ $pctL }}%</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon pink">♀</div>
            <div class="kpi-body">
                <span class="kpi-value">{{ number_format($chartTotalP) }}</span>
                <span class="kpi-label">Perempuan</span>
                <span class="kpi-badge badge-pink">{{ $pctP }}%</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon green">📊</div>
            <div class="kpi-body">
                <span class="kpi-value">{{ $avgPerKelas }}</span>
                <span class="kpi-label">Rata-rata / Kelas</span>
                <span class="kpi-badge badge-green">Terbanyak: {{ $maxKelas }}</span>
            </div>
        </div>
    </div>

    {{-- ── ROW 1: Bar Total + Donut ── --}}
    <div class="chart-grid">

        {{-- Bar: Total Siswa per Kelas --}}
        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <div class="chart-card-title">Populasi Siswa per Kelas</div>
                    <div class="chart-card-sub">Jumlah total siswa setiap tingkatan</div>
                </div>
                <span class="chip chip-live">Live</span>
            </div>
            <div class="chart-wrap h-260">
                <canvas id="chartTotal"></canvas>
            </div>
        </div>

        {{-- Donut: Proporsi Gender --}}
        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <div class="chart-card-title">Proporsi Gender</div>
                    <div class="chart-card-sub">Keseluruhan siswa aktif</div>
                </div>
            </div>
            <div class="chart-wrap h-220">
                <canvas id="chartDonut"></canvas>
            </div>
            <div class="donut-legend">
                <div class="legend-item">
                    <div class="legend-dot" style="background:#0ea5e9;"></div>
                    <span class="legend-name">Laki-laki</span>
                    <div class="legend-bar-wrap">
                        <div class="legend-bar-fill" @style(['width' => $pctL.'%', 'background' => '#0ea5e9'])></div>
                    </div>
                    <span class="legend-pct">{{ $pctL }}%</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background:#ec4899;"></div>
                    <span class="legend-name">Perempuan</span>
                    <div class="legend-bar-wrap">
                        <div class="legend-bar-fill" @style(['width' => $pctP.'%', 'background' => '#ec4899'])></div>
                    </div>
                    <span class="legend-pct">{{ $pctP }}%</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ── ROW 2: Stacked Bar + Rank Table ── --}}
    <div class="chart-grid-bottom">

        {{-- Stacked Bar: L vs P per Kelas --}}
        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <div class="chart-card-title">Distribusi Gender per Kelas</div>
                    <div class="chart-card-sub">Perbandingan laki-laki & perempuan</div>
                </div>
            </div>
            <div class="chart-wrap h-260">
                <canvas id="chartLvP"></canvas>
            </div>
        </div>

        {{-- Rank Table --}}
        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <div class="chart-card-title">Rangking Kelas</div>
                    <div class="chart-card-sub">Berdasarkan jumlah siswa terbanyak</div>
                </div>
            </div>
            <table class="rank-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kelas</th>
                        <th>Jumlah</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody id="rankTableBody"></tbody>
            </table>
        </div>

    </div>

</div>{{-- .stats-wrapper --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const el      = document.getElementById('chartData');
    const labels  = JSON.parse(el.dataset.labels);
    const total   = JSON.parse(el.dataset.total);
    const dataL   = JSON.parse(el.dataset.l);
    const dataP   = JSON.parse(el.dataset.p);
    const totalL  = parseInt(el.dataset.totalL);
    const totalP  = parseInt(el.dataset.totalP);
    const grand   = totalL + totalP;

    const fontFamily = "'Plus Jakarta Sans', sans-serif";

    Chart.defaults.font.family = fontFamily;
    Chart.defaults.color       = '#64748b';

    /* ── Helpers ── */
    function barGradient(ctx, canvas, c1, c2) {
        const g = ctx.createLinearGradient(0, 0, 0, canvas.height);
        g.addColorStop(0, c1);
        g.addColorStop(1, c2);
        return g;
    }

    /* ─────────────────────────────────────────
       1. BAR – Total Siswa per Kelas
    ───────────────────────────────────────── */
    const ctxTotal  = document.getElementById('chartTotal').getContext('2d');
    const gradBlue  = barGradient(ctxTotal, ctxTotal.canvas, '#1d4ed8', '#93c5fd');

    new Chart(ctxTotal, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Total Siswa',
                data: total,
                backgroundColor: gradBlue,
                borderRadius: { topLeft: 8, topRight: 8 },
                borderSkipped: false,
                barThickness: 36,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e3a8a',
                    titleColor: '#bfdbfe',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y} siswa`
                    }
                }
            },
            scales: {
                y: {
                    grid: { color: '#f1f5f9', drawBorder: false },
                    border: { dash: [4, 4] },
                    ticks: { font: { size: 11 }, padding: 6 }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, weight: '600' } }
                }
            }
        }
    });

    /* ─────────────────────────────────────────
       2. STACKED BAR – L vs P
    ───────────────────────────────────────── */
    const ctxLvP = document.getElementById('chartLvP').getContext('2d');

    new Chart(ctxLvP, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'Laki-laki',
                    data: dataL,
                    backgroundColor: '#0ea5e9',
                    borderRadius: { topLeft: 0, topRight: 0, bottomLeft: 6, bottomRight: 6 },
                    borderSkipped: 'bottom',
                },
                {
                    label: 'Perempuan',
                    data: dataP,
                    backgroundColor: '#f472b6',
                    borderRadius: { topLeft: 6, topRight: 6 },
                    borderSkipped: 'bottom',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        padding: 16,
                        font: { size: 11, weight: '600' }
                    }
                },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleColor: '#94a3b8',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 10,
                }
            },
            scales: {
                x: { stacked: true, grid: { display: false }, ticks: { font: { size: 11 } } },
                y: { stacked: true, grid: { color: '#f1f5f9' }, border: { dash: [4, 4] }, ticks: { font: { size: 11 } } }
            }
        }
    });

    /* ─────────────────────────────────────────
       3. DOUGHNUT – Proporsi
    ───────────────────────────────────────── */
    new Chart(document.getElementById('chartDonut'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [totalL, totalP],
                backgroundColor: ['#0ea5e9', '#ec4899'],
                borderWidth: 4,
                borderColor: '#ffffff',
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleColor: '#94a3b8',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 10,
                    callbacks: {
                        label: ctx => ` ${ctx.parsed} siswa (${((ctx.parsed/grand)*100).toFixed(1)}%)`
                    }
                }
            }
        },
        plugins: [{
            id: 'centerText',
            afterDraw: (chart) => {
                const { width, height, ctx } = chart;
                ctx.restore();

                const cx = width  / 2;
                const cy = height / 2;

                ctx.textAlign    = 'center';
                ctx.textBaseline = 'middle';

                ctx.font      = `800 2rem '${fontFamily}'`;
                ctx.fillStyle = '#0f172a';
                ctx.fillText(grand, cx, cy - 12);

                ctx.font      = `600 0.7rem '${fontFamily}'`;
                ctx.fillStyle = '#94a3b8';
                ctx.fillText('Total Siswa', cx, cy + 14);

                ctx.save();
            }
        }]
    });

    /* ─────────────────────────────────────────
       4. RANK TABLE
    ───────────────────────────────────────── */
    const maxTotal = Math.max(...total);
    const sorted   = labels
        .map((l, i) => ({ label: l, total: total[i], l: dataL[i], p: dataP[i] }))
        .sort((a, b) => b.total - a.total);

    const tbody = document.getElementById('rankTableBody');
    sorted.forEach((row, idx) => {
        const pctBar = maxTotal > 0 ? Math.round(row.total / maxTotal * 100) : 0;
        tbody.innerHTML += `
            <tr>
                <td><span class="rank-num">${idx + 1}</span></td>
                <td style="font-weight:700;color:#1e3a8a">${row.label}</td>
                <td>
                    <div style="font-weight:800;color:#0f172a;margin-bottom:4px">${row.total}</div>
                    <div class="rank-bar-bg" style="width:80px">
                        <div class="rank-bar-fill" style="width:${pctBar}%"></div>
                    </div>
                </td>
                <td>
                    <div class="gender-split">
                        <span class="gender-m">♂ ${row.l}</span>
                        <span style="color:#cbd5e1">·</span>
                        <span class="gender-f">♀ ${row.p}</span>
                    </div>
                </td>
            </tr>`;
    });
});
</script>

@else
<div style="font-family:'Plus Jakarta Sans',sans-serif;background:#f8fafc;border:2px dashed #e2e8f0;border-radius:20px;padding:3rem;text-align:center;">
    <div style="font-size:2.5rem;margin-bottom:.75rem;">📊</div>
    <p style="color:#94a3b8;font-weight:600;margin:0;">Data statistik belum tersedia untuk periode ini.</p>
</div>
@endif