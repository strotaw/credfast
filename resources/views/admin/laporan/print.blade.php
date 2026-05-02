<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Laporan Operasional CredFast</title><style>body{font-family:Arial,sans-serif;padding:32px;color:#0f172a}table{width:100%;border-collapse:collapse;margin-top:16px}th,td{border:1px solid #cbd5e1;padding:10px;text-align:left}h1,h2{margin:0 0 12px}.grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin:24px 0}.card{border:1px solid #cbd5e1;border-radius:16px;padding:16px}</style></head>
<body>
    <h1>Laporan Operasional CredFast</h1>
    <p>Dibuat pada {{ $generatedAt->format('d M Y H:i') }}</p>
    <div class="grid">
        <div class="card"><strong>Total Revenue</strong><br>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        <div class="card"><strong>Total Profit</strong><br>Rp {{ number_format($totalProfit, 0, ',', '.') }}</div>
    </div>
    <h2>Top Motor</h2>
    <table><thead><tr><th>Motor</th><th>Total Terjual</th></tr></thead><tbody>@foreach($topMotors as $motor)<tr><td>{{ $motor->nama_motor }}</td><td>{{ $motor->total_terjual }}</td></tr>@endforeach</tbody></table>
    <h2>Kredit Macet</h2>
    <table><thead><tr><th>No Kontrak</th><th>Pelanggan</th><th>Motor</th><th>Sisa</th></tr></thead><tbody>@foreach($badCredits as $kredit)<tr><td>{{ $kredit->no_kontrak }}</td><td>{{ $kredit->pengajuanKredit->user->name }}</td><td>{{ $kredit->pengajuanKredit->motor->nama_motor }}</td><td>Rp {{ number_format($kredit->sisa_kredit, 0, ',', '.') }}</td></tr>@endforeach</tbody></table>
</body>
</html>
