<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Kredit;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Models\User;
use App\Support\CreditWorkflow;
use App\Support\ReportService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        CreditWorkflow::syncOverdueStatuses();

        return view('admin.dashboard', [
            'totalUser' => User::query()->where('role', User::ROLE_USER)->count(),
            'totalMotor' => Motor::query()->count(),
            'totalPengajuan' => PengajuanKredit::query()->count(),
            'totalKreditAktif' => Kredit::query()->where('status_kredit', Kredit::STATUS_AKTIF)->count(),
            'pembayaranMenunggu' => Angsuran::query()->whereIn('status', [Angsuran::STATUS_DIBAYAR, Angsuran::STATUS_TELAT])->count(),
            'totalKreditMacet' => Kredit::query()->where('status_kredit', Kredit::STATUS_MACET)->count(),
            'pendapatanBulanIni' => collect(ReportService::monthlyRevenue(1))->first()['total'] ?? 0,
            'recentPengajuan' => PengajuanKredit::query()->with(['pelanggan.user', 'motor', 'marketing'])->latest()->take(8)->get(),
        ]);
    }
}
