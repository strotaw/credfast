<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKredit;
use App\Models\User;
use Illuminate\View\View;

class FollowUpController extends Controller
{
    public function index(): View
    {
        return view('marketing.follow-up.index', [
            'pengajuanList' => PengajuanKredit::query()
                ->with(['user', 'motor', 'marketing'])
                ->whereIn('status_pengajuan', [
                    PengajuanKredit::STATUS_DIPROSES,
                    PengajuanKredit::STATUS_DATA_KURANG,
                    PengajuanKredit::STATUS_SURVEY,
                    PengajuanKredit::STATUS_DIREKOMENDASIKAN,
                ])
                ->latest()
                ->paginate(10),
        ]);
    }

    public function userPotensial(): View
    {
        $users = User::query()
            ->where('role', User::ROLE_USER)
            ->whereHas('pengajuanKredit', fn ($query) => $query->whereIn('status_pengajuan', [
                PengajuanKredit::STATUS_DIPROSES,
                PengajuanKredit::STATUS_SURVEY,
                PengajuanKredit::STATUS_DIREKOMENDASIKAN,
            ]))
            ->withCount('pengajuanKredit')
            ->latest()
            ->paginate(10);

        return view('marketing.follow-up.potensial', [
            'users' => $users,
        ]);
    }
}
