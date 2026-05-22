@once
    @push('scripts')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @endpush
@endonce

@if (!empty($rekapTingkat))
    <style>
        .stats-wrapper {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f4ff;
            padding: 1.75rem;
            border-radius: 24px;
        }

        .kpi-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        @media (min-width: 768px) {
            .kpi-row {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .kpi-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
            box-shadow: 0 2px 8px rgba(30, 64, 175, .07);
            transition: transform .2s, box-shadow .2s;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, .12);
        }

        .kpi-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: .95rem;
            flex-shrink: 0;
        }

        .kpi-icon.blue {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .kpi-icon.sky {
            background: #e0f2fe;
            color: #0284c7;
        }

        .kpi-icon.pink {
            background: #fdf2f8;
            color: #db2777;
        }

        .kpi-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .kpi-body {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .kpi-value {
            font-size: 1.55rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.15;
            overflow-wrap: anywhere;
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
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .badge-blue {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-sky {
            background: #e0f2fe;
            color: #0369a1;
        }

        .badge-pink {
            background: #fce7f3;
            color: #be185d;
        }

        .badge-green {
            background: #dcfce7;
            color: #15803d;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }

        @media (min-width: 1024px) {
            .chart-grid {
                grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
            }
        }

        .chart-card {
            background: #fff;
            border-radius: 20px;
            padding: 1.5rem;
            min-width: 0;
            box-shadow: 0 2px 8px rgba(30, 64, 175, .06);
            transition: box-shadow .2s;
        }

        .chart-card:hover {
            box-shadow: 0 6px 20px rgba(30, 64, 175, .11);
        }

        .chart-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
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
            white-space: nowrap;
        }

        .chip-live {
            background: #dcfce7;
            color: #15803d;
        }

        .chip-live::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse-dot 1.5s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .3;
            }
        }

        .chart-wrap {
            position: relative;
            width: 100%;
        }

        .h-260 {
            height: 260px;
        }

        .h-220 {
            height: 220px;
        }

        .chart-grid-bottom {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            margin-top: 1.25rem;
        }

        @media (min-width: 768px) {
            .chart-grid-bottom {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

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
            min-width: 0;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
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

        .rank-table {
            width: 100%;
            border-collapse: collapse;
        }

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

        .rank-table tr:last-child td {
            border-bottom: none;
        }

        .rank-num {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 0.75rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .rank-kelas {
            font-weight: 700;
            color: #1e3a8a;
            white-space: nowrap;
        }

        .rank-total {
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .rank-bar-bg {
            width: 80px;
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
            white-space: nowrap;
        }

        .gender-m {
            color: #0284c7;
        }

        .gender-f {
            color: #db2777;
        }

        .gender-separator {
            color: #cbd5e1;
        }

        .chart-fallback {
            padding: 1rem;
            border-radius: 12px;
            background: #fff7ed;
            color: #9a3412;
            font-size: .85rem;
            font-weight: 700;
        }
    </style>

    @php
        $chartLabels = array_map(fn($t) => 'Kelas ' . $t, array_keys($rekapTingkat));
        $chartTotal = array_map('intval', array_column(array_values($rekapTingkat), 'total'));
        $chartL = array_map('intval', array_column(array_values($rekapTingkat), 'L'));
        $chartP = array_map('intval', array_column(array_values($rekapTingkat), 'P'));
        $chartTotalL = array_sum($chartL);
        $chartTotalP = array_sum($chartP);
        $grandTotal = $chartTotalL + $chartTotalP;
        $pctL = $grandTotal > 0 ? round(($chartTotalL / $grandTotal) * 100, 1) : 0;
        $pctP = $grandTotal > 0 ? round(($chartTotalP / $grandTotal) * 100, 1) : 0;
        $avgPerKelas = count($chartTotal) > 0 ? round(array_sum($chartTotal) / count($chartTotal)) : 0;
        $maxTotalValue = !empty($chartTotal) ? max($chartTotal) : 0;
        $maxIdx = $maxTotalValue > 0 ? array_search($maxTotalValue, $chartTotal) : false;
        $maxKelas = $maxIdx !== false ? $chartLabels[$maxIdx] ?? '-' : '-';
    @endphp

    <div class="stats-wrapper">
        <div class="kpi-row">
            <div class="kpi-card">
                <div class="kpi-icon blue">All</div>
                <div class="kpi-body">
                    <span class="kpi-value">{{ number_format($grandTotal) }}</span>
                    <span class="kpi-label">Total Siswa</span>
                    <span class="kpi-badge badge-blue">Semua Kelas</span>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon sky">L</div>
                <div class="kpi-body">
                    <span class="kpi-value">{{ number_format($chartTotalL) }}</span>
                    <span class="kpi-label">Laki-laki</span>
                    <span class="kpi-badge badge-sky">{{ $pctL }}%</span>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon pink">P</div>
                <div class="kpi-body">
                    <span class="kpi-value">{{ number_format($chartTotalP) }}</span>
                    <span class="kpi-label">Perempuan</span>
                    <span class="kpi-badge badge-pink">{{ $pctP }}%</span>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon green">Avg</div>
                <div class="kpi-body">
                    <span class="kpi-value">{{ $avgPerKelas }}</span>
                    <span class="kpi-label">Rata-rata / Kelas</span>
                    <span class="kpi-badge badge-green">Terbanyak: {{ $maxKelas }}</span>
                </div>
            </div>
        </div>

        <div class="chart-grid">
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
                            <div class="legend-bar-fill" @style(['width' => $pctL . '%', 'background' => '#0ea5e9'])></div>
                        </div>
                        <span class="legend-pct">{{ $pctL }}%</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#ec4899;"></div>
                        <span class="legend-name">Perempuan</span>
                        <div class="legend-bar-wrap">
                            <div class="legend-bar-fill" @style(['width' => $pctP . '%', 'background' => '#ec4899'])></div>
                        </div>
                        <span class="legend-pct">{{ $pctP }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="chart-grid-bottom">
            <div class="chart-card">
                <div class="chart-card-header">
                    <div>
                        <div class="chart-card-title">Distribusi Gender per Kelas</div>
                        <div class="chart-card-sub">Perbandingan laki-laki dan perempuan</div>
                    </div>
                </div>
                <div class="chart-wrap h-260">
                    <canvas id="chartLvP"></canvas>
                </div>
            </div>

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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Check if Chart.js is loaded
                if (typeof Chart === 'undefined') {
                    console.error('Chart.js library not loaded');
                    document.querySelectorAll('.chart-wrap').forEach((wrap) => {
                        wrap.innerHTML = '<div class="chart-fallback">Chart.js library tidak dimuat</div>';
                    });
                    return;
                }

                const payload = {
                    labels: @json($chartLabels),
                    total: @json($chartTotal),
                    dataL: @json($chartL),
                    dataP: @json($chartP),
                    totalL: @json($chartTotalL),
                    totalP: @json($chartTotalP)
                };

                console.log('Chart data loaded:', payload);

                const labels = payload.labels;
                const total = payload.total;
                const dataL = payload.dataL;
                const dataP = payload.dataP;
                const totalL = Number(payload.totalL || 0);
                const totalP = Number(payload.totalP || 0);
                const grand = totalL + totalP;
                const fontFamily = "'Plus Jakarta Sans', sans-serif";

                Chart.defaults.font.family = fontFamily;
                Chart.defaults.color = '#64748b';

                function barGradient(ctx, canvas, c1, c2) {
                    const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
                    gradient.addColorStop(0, c1);
                    gradient.addColorStop(1, c2);
                    return gradient;
                }

                function percent(value) {
                    return grand > 0 ? ((value / grand) * 100).toFixed(1) : '0.0';
                }

                // Register custom plugin for doughnut chart
                const centerTextPlugin = {
                    id: 'centerText',
                    afterDraw: (chart) => {
                        const { width, height, ctx } = chart;
                        const cx = width / 2;
                        const cy = height / 2;

                        ctx.save();
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.font = `800 2rem ${fontFamily}`;
                        ctx.fillStyle = '#0f172a';
                        ctx.fillText(grand, cx, cy - 12);
                        ctx.font = `600 0.7rem ${fontFamily}`;
                        ctx.fillStyle = '#94a3b8';
                        ctx.fillText('Total Siswa', cx, cy + 14);
                        ctx.restore();
                    }
                };

                // Chart 1: Total Siswa
                const canvasTotal = document.getElementById('chartTotal');
                if (canvasTotal) {
                    try {
                        const ctx = canvasTotal.getContext('2d');
                        const gradBlue = barGradient(ctx, canvasTotal, '#1d4ed8', '#93c5fd');
                        new Chart(canvasTotal, {
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
                                            label: (ctx) => ` ${ctx.parsed.y} siswa`
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        grid: { color: '#f1f5f9', drawBorder: false },
                                        border: { dash: [4, 4] },
                                        ticks: { precision: 0, font: { size: 11 }, padding: 6 }
                                    },
                                    x: {
                                        grid: { display: false },
                                        ticks: { font: { size: 11, weight: '600' } }
                                    }
                                }
                            }
                        });
                        console.log('Chart 1 (Total) created successfully');
                    } catch (err) {
                        console.error('Error creating Chart 1:', err);
                    }
                } else {
                    console.warn('Canvas element chartTotal not found');
                }

                // Chart 2: Distribusi Gender per Kelas
                const canvasLvP = document.getElementById('chartLvP');
                if (canvasLvP) {
                    try {
                        new Chart(canvasLvP, {
                            type: 'bar',
                            data: {
                                labels,
                                datasets: [
                                    {
                                        label: 'Laki-laki',
                                        data: dataL,
                                        backgroundColor: '#0ea5e9',
                                        borderRadius: { bottomLeft: 6, bottomRight: 6 },
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
                                    x: {
                                        stacked: true,
                                        grid: { display: false },
                                        ticks: { font: { size: 11 } }
                                    },
                                    y: {
                                        stacked: true,
                                        beginAtZero: true,
                                        grid: { color: '#f1f5f9' },
                                        border: { dash: [4, 4] },
                                        ticks: { precision: 0, font: { size: 11 } }
                                    }
                                }
                            }
                        });
                        console.log('Chart 2 (LvP) created successfully');
                    } catch (err) {
                        console.error('Error creating Chart 2:', err);
                    }
                } else {
                    console.warn('Canvas element chartLvP not found');
                }

                // Chart 3: Proporsi Gender (Doughnut)
                const canvasDonut = document.getElementById('chartDonut');
                if (canvasDonut) {
                    try {
                        new Chart(canvasDonut, {
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
                                            label: (ctx) => ` ${ctx.parsed} siswa (${percent(ctx.parsed)}%)`
                                        }
                                    }
                                }
                            },
                            plugins: [centerTextPlugin]
                        });
                        console.log('Chart 3 (Donut) created successfully');
                    } catch (err) {
                        console.error('Error creating Chart 3:', err);
                    }
                } else {
                    console.warn('Canvas element chartDonut not found');
                }

                // Ranking Table
                const maxTotal = Math.max(0, ...total);
                const sorted = labels
                    .map((label, index) => ({
                        label,
                        total: total[index],
                        l: dataL[index],
                        p: dataP[index]
                    }))
                    .sort((a, b) => b.total - a.total);

                const tbody = document.getElementById('rankTableBody');
                if (tbody) {
                    const fragment = document.createDocumentFragment();

                    sorted.forEach((row, index) => {
                        const pctBar = maxTotal > 0 ? Math.round(row.total / maxTotal * 100) : 0;
                        const tr = document.createElement('tr');

                        const rankTd = document.createElement('td');
                        const rank = document.createElement('span');
                        rank.className = 'rank-num';
                        rank.textContent = String(index + 1);
                        rankTd.append(rank);

                        const kelasTd = document.createElement('td');
                        kelasTd.className = 'rank-kelas';
                        kelasTd.textContent = row.label;

                        const totalTd = document.createElement('td');
                        const totalText = document.createElement('div');
                        totalText.className = 'rank-total';
                        totalText.textContent = row.total;
                        const barBg = document.createElement('div');
                        barBg.className = 'rank-bar-bg';
                        const barFill = document.createElement('div');
                        barFill.className = 'rank-bar-fill';
                        barFill.style.width = `${pctBar}%`;
                        barBg.append(barFill);
                        totalTd.append(totalText, barBg);

                        const genderTd = document.createElement('td');
                        const gender = document.createElement('div');
                        gender.className = 'gender-split';
                        const male = document.createElement('span');
                        male.className = 'gender-m';
                        male.textContent = `L ${row.l}`;
                        const separator = document.createElement('span');
                        separator.className = 'gender-separator';
                        separator.textContent = '/';
                        const female = document.createElement('span');
                        female.className = 'gender-f';
                        female.textContent = `P ${row.p}`;
                        gender.append(male, separator, female);
                        genderTd.append(gender);

                        tr.append(rankTd, kelasTd, totalTd, genderTd);
                        fragment.append(tr);
                    });

                    tbody.replaceChildren(fragment);
                    console.log('Ranking table populated');
                } else {
                    console.warn('rankTableBody element not found');
                }

            } catch (error) {
                console.error('Chart initialization error:', error);
                document.querySelectorAll('.chart-wrap').forEach((wrap) => {
                    wrap.innerHTML = '<div class="chart-fallback">Error: ' + error.message + '</div>';
                });
            }
        });
    </script>
@else
    <div
        style="font-family:'Plus Jakarta Sans',sans-serif;background:#f8fafc;border:2px dashed #e2e8f0;border-radius:20px;padding:3rem;text-align:center;">
        <div style="font-size:2.5rem;font-weight:800;color:#1d4ed8;margin-bottom:.75rem;">Chart</div>
        <p style="color:#94a3b8;font-weight:600;margin:0;">Data statistik belum tersedia untuk periode ini.</p>
    </div>
@endif
