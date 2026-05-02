<?php

namespace App\Http\Controllers\CEO;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Kredit;
use App\Models\PengajuanKredit;
use App\Models\Pengiriman;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function pengajuan(): View
    {
        return view('ceo.monitoring.pengajuan', [
            'items' => PengajuanKredit::query()->with(['user', 'motor', 'marketing', 'admin'])->latest()->paginate(15),
        ]);
    }

    public function kredit(): View
    {
        return view('ceo.monitoring.kredit', [
            'items' => Kredit::query()->with(['pengajuanKredit.user', 'pengajuanKredit.motor', 'metodeBayar'])->latest()->paginate(15),
        ]);
    }

    public function angsuran(): View
    {
        return view('ceo.monitoring.angsuran', [
            'items' => Angsuran::query()->with(['kredit.pengajuanKredit.user', 'kredit.pengajuanKredit.motor', 'verifiedBy'])->latest()->paginate(15),
        ]);
    }

    public function pengiriman(): View
    {
        return view('ceo.monitoring.pengiriman', [
            'items' => Pengiriman::query()->with(['kredit.pengajuanKredit.user', 'kredit.pengajuanKredit.motor'])->latest()->paginate(15),
        ]);
    }
}
