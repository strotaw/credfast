<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kredit;
use Illuminate\View\View;

class KreditController extends Controller
{
    public function index(): View
    {
        auth()->user()->syncPelangganProfile();
        $pelanggan = auth()->user()->pelanggan()->firstOrFail();

        return view('user.kredit.index', [
            'kreditList' => Kredit::query()
                ->with(['pengajuanKredit.motor.jenisMotor', 'metodeBayar', 'pengiriman'])
                ->whereHas('pengajuanKredit', fn ($query) => $query->where('pelanggan_id', $pelanggan->id))
                ->latest()
                ->paginate(10),
        ]);
    }

    public function show(Kredit $kredit): View
    {
        abort_if($kredit->pengajuanKredit->pelanggan?->user_id !== auth()->id(), 403);

        return view('user.kredit.show', [
            'kredit' => $kredit->load(['pengajuanKredit.motor.jenisMotor', 'metodeBayar', 'pengiriman', 'angsuran']),
        ]);
    }
}
