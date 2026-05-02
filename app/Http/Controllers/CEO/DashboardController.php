<?php

namespace App\Http\Controllers\CEO;

use App\Http\Controllers\Controller;
use App\Models\Kredit;
use App\Models\PengajuanKredit;
use App\Support\ReportService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('ceo.dashboard', [
            'totalProfit' => ReportService::totalProfit(),
            'totalRevenue' => ReportService::totalRevenue(),
            'totalKreditAktif' => Kredit::query()->where('status_kredit', Kredit::STATUS_AKTIF)->count(),
            'totalKreditMacet' => Kredit::query()->where('status_kredit', Kredit::STATUS_MACET)->count(),
            'totalPengajuanDiterima' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_DITERIMA)->count(),
            'monthlyRevenue' => ReportService::monthlyRevenue(6),
            'monthlyApplications' => ReportService::monthlyApplications(6),
            'creditStatusBreakdown' => ReportService::creditStatusBreakdown(),
            'topMotors' => ReportService::topMotors(5),
            'badCredits' => ReportService::badCredits(10),
        ]);
    }
}
