<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Asuransi;
use App\Models\Kredit;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Support\CreditWorkflow;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        CreditWorkflow::syncOverdueStatuses();

        $user = auth()->user();

        $pengajuanQuery = $user->pengajuanKredit();
        $kreditQuery = Kredit::query()->whereHas('pengajuanKredit', fn ($query) => $query->where('user_id', $user->id));
        $angsuranQuery = Angsuran::query()->whereHas('kredit.pengajuanKredit', fn ($query) => $query->where('user_id', $user->id));

        return view('user.dashboard', [
            'totalPengajuan' => (clone $pengajuanQuery)->count(),
            'pengajuanAktif' => (clone $pengajuanQuery)->whereIn('status_pengajuan', ['menunggu', 'diproses', 'survey', 'direkomendasikan'])->count(),
            'kreditAktif' => (clone $kreditQuery)->where('status_kredit', Kredit::STATUS_AKTIF)->count(),
            'angsuranBelumDibayar' => (clone $angsuranQuery)->whereIn('status', [Angsuran::STATUS_MENUNGGU, Angsuran::STATUS_TELAT, Angsuran::STATUS_DITOLAK])->count(),
            'pengajuanTerbaru' => $user->pengajuanKredit()->with(['motor', 'jenisCicilan'])->latest()->take(5)->get(),
            'kreditTerbaru' => $kreditQuery->with(['pengajuanKredit.motor', 'pengiriman'])->latest()->take(3)->get(),
            'carouselMotors' => Motor::query()->with('jenisMotor')->where('status', Motor::STATUS_TERSEDIA)->latest()->take(5)->get(),
            'metodeBayarList' => MetodeBayar::query()->where('status', MetodeBayar::STATUS_AKTIF)->latest()->take(4)->get(),
            'asuransiList' => Asuransi::query()->latest()->take(4)->get(),
        ]);
    }
}
