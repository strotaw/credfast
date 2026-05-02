<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kredit;
use Illuminate\View\View;

class KreditController extends Controller
{
    public function index(): View
    {
        return view('user.kredit.index', [
            'kreditList' => Kredit::query()
                ->with(['pengajuanKredit.motor.jenisMotor', 'metodeBayar', 'pengiriman'])
                ->whereHas('pengajuanKredit', fn ($query) => $query->where('user_id', auth()->id()))
                ->latest()
                ->paginate(10),
        ]);
    }

    public function show(Kredit $kredit): View
    {
        abort_if($kredit->pengajuanKredit->user_id !== auth()->id(), 403);

        return view('user.kredit.show', [
            'kredit' => $kredit->load(['pengajuanKredit.motor.jenisMotor', 'metodeBayar', 'pengiriman', 'angsuran']),
        ]);
    }
}
