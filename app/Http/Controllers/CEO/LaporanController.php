<?php

namespace App\Http\Controllers\CEO;

use App\Http\Controllers\Controller;
use App\Models\Kredit;
use App\Support\ReportService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function keuntungan(): View
    {
        return view('ceo.laporan.keuntungan', [
            'totalProfit' => ReportService::totalProfit(),
            'totalRevenue' => ReportService::totalRevenue(),
            'monthlyRevenue' => ReportService::monthlyRevenue(12),
        ]);
    }

    public function penjualan(): View
    {
        $openedCreditsQuery = Kredit::query()
            ->with(['pengajuanKredit.pelanggan.user', 'pengajuanKredit.motor'])
            ->latest('tgl_mulai_kredit');
        $totalSalesValue = (float) (clone $openedCreditsQuery)->sum('total_kredit');
        $totalProfit = ReportService::totalProfit();
        $totalSalesMargin = ReportService::totalSalesMargin();

        return view('ceo.laporan.penjualan', [
            'topMotors' => ReportService::topMotors(10),
            'monthlyOpenedCredits' => ReportService::monthlyOpenedCredits(12),
            'openedCredits' => (clone $openedCreditsQuery)->paginate(12),
            'totalOpenedCredits' => (clone $openedCreditsQuery)->count(),
            'totalSalesValue' => $totalSalesValue,
            'profitMargin' => ReportService::marginPercentage($totalProfit, $totalSalesValue),
            'salesMargin' => ReportService::marginPercentage($totalSalesMargin, ReportService::totalCashSalesValue()),
        ]);
    }

    public function kreditMacet(): View
    {
        return view('ceo.laporan.kredit_macet', [
            'badCredits' => ReportService::badCredits(20),
        ]);
    }

    public function exportPdf(): View
    {
        $totalSalesValue = (float) Kredit::query()->sum('total_kredit');
        $totalProfit = ReportService::totalProfit();
        $totalSalesMargin = ReportService::totalSalesMargin();

        return view('ceo.laporan.print', [
            'generatedAt' => now(),
            'monthlyOpenedCredits' => ReportService::monthlyOpenedCredits(12),
            'topMotors' => ReportService::topMotors(10),
            'openedCredits' => Kredit::query()
                ->with(['pengajuanKredit.pelanggan.user', 'pengajuanKredit.motor'])
                ->latest('tgl_mulai_kredit')
                ->get(),
            'totalOpenedCredits' => Kredit::query()->count(),
            'totalSalesValue' => $totalSalesValue,
            'profitMargin' => ReportService::marginPercentage($totalProfit, $totalSalesValue),
            'salesMargin' => ReportService::marginPercentage($totalSalesMargin, ReportService::totalCashSalesValue()),
        ]);
    }

    public function exportExcel(): Response
    {
        $rows = ['Tanggal Mulai,No Kontrak,Customer,Motor,Status Kredit,Total Kredit,Sisa Kredit'];

        Kredit::query()
            ->with(['pengajuanKredit.pelanggan.user', 'pengajuanKredit.motor'])
            ->latest('tgl_mulai_kredit')
            ->get()
            ->each(function (Kredit $kredit) use (&$rows) {
                $rows[] = implode(',', [
                    $kredit->tgl_mulai_kredit->format('Y-m-d'),
                    $kredit->no_kontrak,
                    $this->escapeCsv($kredit->pengajuanKredit?->user?->name ?? '-'),
                    $this->escapeCsv($kredit->pengajuanKredit?->motor?->nama_motor ?? '-'),
                    $kredit->status_kredit,
                    $kredit->total_kredit,
                    $kredit->sisa_kredit,
                ]);
            });

        return response(implode("\n", $rows), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan-ceo-credfast.csv"',
        ]);
    }

    private function escapeCsv(string $value): string
    {
        return '"'.str_replace('"', '""', $value).'"';
    }
}
