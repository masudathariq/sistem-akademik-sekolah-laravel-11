<style>
.rekap-table { width:100%; border-collapse:collapse; font-size:.8125rem; }
.rekap-table thead th {
    background:#f9fafb; color:#6b7280;
    font-size:.6875rem; font-weight:700;
    text-transform:uppercase; letter-spacing:.05em;
    padding:.625rem .875rem; border-bottom:1px solid #f3f4f6;
    white-space:nowrap;
}
.rekap-table tbody td {
    padding:.75rem .875rem;
    color:#374151;
    border-bottom:1px solid #f9fafb;
    vertical-align:middle;
}
.rekap-table tbody tr:last-child td { border-bottom:none; }
.rekap-table tbody tr:hover { background:#fafafa; }
.tc { text-align:center; }
.num-total { font-weight:700; color:#1d4ed8; }
.num-l     { font-weight:600; color:#0284c7; }
.num-p     { font-weight:600; color:#db2777; }
.badge-pondok { background:#f3e8ff; color:#7c3aed; }
.badge-umum   { background:#dbeafe; color:#1d4ed8; }
.kategori-badge {
    display:inline-block;
    padding:2px 10px; border-radius:99px;
    font-size:.7rem; font-weight:700;
    text-transform:capitalize;
}
.empty-row { text-align:center; padding:2.5rem 1rem; color:#9ca3af; font-size:.875rem; }

/* mobile card view */
@media (max-width: 600px) {
    .rekap-tbl-wrap { display:none; }
    .rekap-cards { display:flex; flex-direction:column; gap:.625rem; }
    .rekap-card {
        border:1px solid #e5e7eb; border-radius:10px;
        padding:.875rem 1rem; background:#fff;
    }
    .rekap-card-top {
        display:flex; align-items:center;
        justify-content:space-between; margin-bottom:.5rem;
    }
    .rekap-card-rombel { font-weight:700; color:#111827; font-size:.875rem; }
    .rekap-card-tingkat { font-size:.75rem; color:#9ca3af; margin-top:2px; }
    .rekap-card-nums {
        display:flex; gap:1.25rem; margin-top:.5rem;
    }
    .rekap-card-num { text-align:center; }
    .rekap-card-num .val { font-size:1.125rem; font-weight:700; line-height:1; }
    .rekap-card-num .lbl { font-size:.6875rem; color:#9ca3af; margin-top:2px; }
}
@media (min-width: 601px) {
    .rekap-cards { display:none; }
}
</style>

{{-- Desktop Table --}}
<div class="rekap-tbl-wrap" style="overflow-x:auto;">
    <table class="rekap-table">
        <thead>
            <tr>
                <th class="tc">Tingkat</th>
                <th>Rombel</th>
                <th class="tc">Kategori</th>
                <th class="tc">Total</th>
                <th class="tc">Laki-laki</th>
                <th class="tc">Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekapRombel as $row)
            <tr>
                <td class="tc" style="font-weight:600;">Kelas {{ $row['tingkat_label'] ?? \App\Models\Tatausaha\Rombel::formatTingkat($row['tingkat']) }}</td>
                <td>{{ $row['rombel'] }}</td>
                <td class="tc">
                    <span class="kategori-badge {{ $row['kategori'] === 'pondok' ? 'badge-pondok' : 'badge-umum' }}">
                        {{ ucfirst($row['kategori']) }}
                    </span>
                </td>
                <td class="tc num-total">{{ $row['total'] }}</td>
                <td class="tc num-l">{{ $row['L'] }}</td>
                <td class="tc num-p">{{ $row['P'] }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty-row">Belum ada data rombel</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile Cards --}}
<div class="rekap-cards">
    @forelse($rekapRombel as $row)
    <div class="rekap-card">
        <div class="rekap-card-top">
            <div>
                <div class="rekap-card-rombel">{{ $row['rombel'] }}</div>
                <div class="rekap-card-tingkat">Kelas {{ $row['tingkat_label'] ?? \App\Models\Tatausaha\Rombel::formatTingkat($row['tingkat']) }}</div>
            </div>
            <span class="kategori-badge {{ $row['kategori'] === 'pondok' ? 'badge-pondok' : 'badge-umum' }}">
                {{ ucfirst($row['kategori']) }}
            </span>
        </div>
        <div class="rekap-card-nums">
            <div class="rekap-card-num">
                <div class="val num-total">{{ $row['total'] }}</div>
                <div class="lbl">Total</div>
            </div>
            <div class="rekap-card-num">
                <div class="val num-l">{{ $row['L'] }}</div>
                <div class="lbl">L</div>
            </div>
            <div class="rekap-card-num">
                <div class="val num-p">{{ $row['P'] }}</div>
                <div class="lbl">P</div>
            </div>
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:2rem;color:#9ca3af;font-size:.875rem;">Belum ada data rombel</div>
    @endforelse
</div>
