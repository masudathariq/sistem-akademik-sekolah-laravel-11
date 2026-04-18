<style>
.rtk-table { width:100%; border-collapse:collapse; font-size:.8125rem; }
.rtk-table thead th {
    background:#f9fafb; color:#6b7280;
    font-size:.6875rem; font-weight:700;
    text-transform:uppercase; letter-spacing:.05em;
    padding:.625rem .875rem; border-bottom:1px solid #f3f4f6;
    white-space:nowrap;
}
.rtk-table tbody td {
    padding:.75rem .875rem; color:#374151;
    border-bottom:1px solid #f9fafb; vertical-align:middle;
}
.rtk-table tbody tr:last-child td { border-bottom:none; }
.rtk-table tbody tr:hover { background:#fafafa; }
.tc { text-align:center; }
.num-total { font-weight:700; color:#1d4ed8; }
.num-l     { font-weight:600; color:#0284c7; }
.num-p     { font-weight:600; color:#db2777; }
.badge-pondok { background:#f3e8ff; color:#7c3aed; }
.badge-umum   { background:#dbeafe; color:#1d4ed8; }
.kategori-badge {
    display:inline-block; padding:2px 10px; border-radius:99px;
    font-size:.7rem; font-weight:700; text-transform:capitalize;
}
.empty-row { text-align:center; padding:2.5rem 1rem; color:#9ca3af; font-size:.875rem; }

@media (max-width: 600px) {
    .rtk-tbl-wrap { display:none; }
    .rtk-cards { display:flex; flex-direction:column; gap:.625rem; }
    .rtk-card {
        border:1px solid #e5e7eb; border-radius:10px;
        padding:.875rem 1rem; background:#fff;
        display:flex; align-items:center; gap:1rem;
    }
    .rtk-card-left { flex:1; }
    .rtk-card-tingkat { font-weight:700; color:#111827; font-size:.875rem; }
    .rtk-card-nums { display:flex; gap:1.25rem; }
    .rtk-card-num .val { font-size:1.125rem; font-weight:700; line-height:1; }
    .rtk-card-num .lbl { font-size:.6875rem; color:#9ca3af; margin-top:2px; }
}
@media (min-width: 601px) {
    .rtk-cards { display:none; }
}
</style>

{{-- Desktop --}}
<div class="rtk-tbl-wrap" style="overflow-x:auto;">
    <table class="rtk-table">
        <thead>
            <tr>
                <th class="tc">Tingkat</th>
                <th class="tc">Kategori</th>
                <th class="tc">Total</th>
                <th class="tc">Laki-laki</th>
                <th class="tc">Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekapTingkatKategori as $tingkat => $dataKategori)
                @foreach($dataKategori as $kategori => $data)
                <tr>
                    <td class="tc" style="font-weight:600;">Kelas {{ $tingkat }}</td>
                    <td class="tc">
                        <span class="kategori-badge {{ $kategori === 'pondok' ? 'badge-pondok' : 'badge-umum' }}">
                            {{ ucfirst($kategori) }}
                        </span>
                    </td>
                    <td class="tc num-total">{{ $data['total'] }}</td>
                    <td class="tc num-l">{{ $data['L'] }}</td>
                    <td class="tc num-p">{{ $data['P'] }}</td>
                </tr>
                @endforeach
            @empty
            <tr><td colspan="5" class="empty-row">Data belum tersedia</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile --}}
<div class="rtk-cards">
    @forelse($rekapTingkatKategori as $tingkat => $dataKategori)
        @foreach($dataKategori as $kategori => $data)
        <div class="rtk-card">
            <div class="rtk-card-left">
                <div class="rtk-card-tingkat">Kelas {{ $tingkat }}</div>
                <div style="margin-top:4px;">
                    <span class="kategori-badge {{ $kategori === 'pondok' ? 'badge-pondok' : 'badge-umum' }}">
                        {{ ucfirst($kategori) }}
                    </span>
                </div>
            </div>
            <div class="rtk-card-nums">
                <div class="rtk-card-num" style="text-align:center;">
                    <div class="val num-total">{{ $data['total'] }}</div>
                    <div class="lbl">Total</div>
                </div>
                <div class="rtk-card-num" style="text-align:center;">
                    <div class="val num-l">{{ $data['L'] }}</div>
                    <div class="lbl">L</div>
                </div>
                <div class="rtk-card-num" style="text-align:center;">
                    <div class="val num-p">{{ $data['P'] }}</div>
                    <div class="lbl">P</div>
                </div>
            </div>
        </div>
        @endforeach
    @empty
    <div style="text-align:center;padding:2rem;color:#9ca3af;font-size:.875rem;">Data belum tersedia</div>
    @endforelse
</div>