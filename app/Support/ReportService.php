<?php

namespace App\Support;

use App\Models\Angsuran;
use App\Models\Kredit;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use Illuminate\Support\Collection;

class ReportService
{
    /**
     * @return array<int, array{label: string, total: float}>
     */
    public static function monthlyRevenue(int $months = 6): array
    {
        $points = collect();

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->startOfMonth()->subMonths($i);
            $points->push([
                'key' => $date->format('Y-m'),
                'label' => $date->translatedFormat('M Y'),
                'total' => 0.0,
            ]);
        }

        $totals = Angsuran::query()
            ->where('status', Angsuran::STATUS_VALID)
            ->whereNotNull('verified_at')
            ->get()
            ->groupBy(fn (Angsuran $angsuran) => $angsuran->verified_at->format('Y-m'))
            ->map(fn (Collection $group) => (float) $group->sum('total_bayar'));

        return $points->map(function (array $point) use ($totals) {
            $point['total'] = round((float) ($totals[$point['key']] ?? 0), 2);

            return $point;
        })->values()->all();
    }

    /**
     * @return array<int, array{label: string, total: int}>
     */
    public static function monthlyApplications(int $months = 6): array
    {
        $points = collect();

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->startOfMonth()->subMonths($i);
            $points->push([
                'key' => $date->format('Y-m'),
                'label' => $date->translatedFormat('M Y'),
                'total' => 0,
            ]);
        }

        $totals = PengajuanKredit::query()
            ->get()
            ->groupBy(fn (PengajuanKredit $pengajuan) => $pengajuan->created_at->format('Y-m'))
            ->map(fn (Collection $group) => $group->count());

        return $points->map(function (array $point) use ($totals) {
            $point['total'] = (int) ($totals[$point['key']] ?? 0);

            return $point;
        })->values()->all();
    }

    /**
     * @return array<string, int>
     */
    public static function creditStatusBreakdown(): array
    {
        return Kredit::query()
            ->selectRaw('status_kredit, COUNT(*) as total')
            ->groupBy('status_kredit')
            ->pluck('total', 'status_kredit')
            ->map(fn ($total) => (int) $total)
            ->all();
    }

    public static function totalRevenue(): float
    {
        return (float) Angsuran::query()
            ->where('status', Angsuran::STATUS_VALID)
            ->sum('total_bayar');
    }

    public static function totalProfit(): float
    {
        $marginProfit = (float) Kredit::query()
            ->with('pengajuanKredit')
            ->get()
            ->sum(fn (Kredit $kredit) => $kredit->total_kredit - $kredit->pengajuanKredit->harga_cash);

        $dendaProfit = (float) Angsuran::query()
            ->where('status', Angsuran::STATUS_VALID)
            ->sum('denda');

        return round($marginProfit + $dendaProfit, 2);
    }

    public static function topMotors(int $limit = 5): Collection
    {
        return Motor::query()
            ->withCount(['pengajuanKredit as total_terjual' => fn ($query) => $query->whereHas('kredit')])
            ->orderByDesc('total_terjual')
            ->take($limit)
            ->get();
    }

    public static function badCredits(int $limit = 10): Collection
    {
        return Kredit::query()
            ->with(['pengajuanKredit.user', 'pengajuanKredit.motor'])
            ->where('status_kredit', Kredit::STATUS_MACET)
            ->latest()
            ->take($limit)
            ->get();
    }
}
