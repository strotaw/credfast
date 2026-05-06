<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKredit;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('marketing.dashboard', [
            'newCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_MENUNGGU_KONFIRMASI)->count(),
            'processedCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_DIPROSES)->count(),
            'cancelledBuyerCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_DIBATALKAN_PEMBELI)->count(),
            'problemCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_BERMASALAH)->count(),
            'acceptedCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_DITERIMA)->count(),
            'latestPengajuan' => PengajuanKredit::query()->with(['pelanggan.user', 'motor'])->latest()->take(8)->get(),
        ]);
    }
}
