<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Laporan CEO CredFast</title><style>body{font-family:Arial,sans-serif;padding:32px;color:#111827}table{width:100%;border-collapse:collapse;margin-top:16px}th,td{border:1px solid #d1d5db;padding:10px;text-align:left}h1,h2{margin:0 0 12px}.grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin:24px 0}.card{border:1px solid #d1d5db;border-radius:16px;padding:16px}</style></head>
<body>
    <h1>Laporan Penjualan CEO CredFast</h1>
    <p>Dibuat pada {{ $generatedAt->format('d M Y H:i') }}</p>
    <div class="grid">
        <div class="card"><strong>Kredit Dibuka</strong><br>{{ $totalOpenedCredits }}</div>
        <div class="card"><strong>Nilai Kontrak</strong><br>Rp {{ number_format($totalSalesValue, 0, ',', '.') }}</div>
        <div class="card"><strong>Margin Keuntungan</strong><br>{{ number_format($profitMargin, 2, ',', '.') }}%</div>
        <div class="card"><strong>Margin Penjualan</strong><br>{{ number_format($salesMargin, 2, ',', '.') }}%</div>
    </div>
    <h2>Kredit Dibuka Bulanan</h2>
    <table><thead><tr><th>Bulan</th><th>Total Kredit</th></tr></thead><tbody>@foreach($monthlyOpenedCredits as $point)<tr><td>{{ $point['label'] }}</td><td>{{ $point['total'] }}</td></tr>@endforeach</tbody></table>
    <h2>Motor Paling Banyak Terjual</h2>
    <table><thead><tr><th>Motor</th><th>Total Terjual</th></tr></thead><tbody>@foreach($topMotors as $motor)<tr><td>{{ $motor->nama_motor }}</td><td>{{ $motor->total_terjual }}</td></tr>@endforeach</tbody></table>
    <h2>Pelanggan yang Buka Kredit</h2>
    <table><thead><tr><th>Tanggal</th><th>No Kontrak</th><th>Pelanggan</th><th>Motor</th><th>Status</th><th>Total</th><th>Sisa</th></tr></thead><tbody>@foreach($openedCredits as $item)<tr><td>{{ $item->tgl_mulai_kredit->format('d M Y') }}</td><td>{{ $item->no_kontrak }}</td><td>{{ $item->pengajuanKredit?->user?->name ?? '-' }}</td><td>{{ $item->pengajuanKredit?->motor?->nama_motor ?? '-' }}</td><td>{{ $item->status_kredit }}</td><td>Rp {{ number_format($item->total_kredit, 0, ',', '.') }}</td><td>Rp {{ number_format($item->sisa_kredit, 0, ',', '.') }}</td></tr>@endforeach</tbody></table>
</body>
</html>
