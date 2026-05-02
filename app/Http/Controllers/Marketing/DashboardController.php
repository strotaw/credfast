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
            'newCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_MENUNGGU)->count(),
            'processedCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_DIPROSES)->count(),
            'missingCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_DATA_KURANG)->count(),
            'recommendedCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_DIREKOMENDASIKAN)->count(),
            'rejectedCount' => PengajuanKredit::query()->where('status_pengajuan', PengajuanKredit::STATUS_TIDAK_DIREKOMENDASIKAN)->count(),
            'latestPengajuan' => PengajuanKredit::query()->with(['user', 'motor'])->latest()->take(8)->get(),
        ]);
    }
}
