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
        return view('ceo.laporan.penjualan', [
            'topMotors' => ReportService::topMotors(10),
            'monthlyApplications' => ReportService::monthlyApplications(12),
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
        return view('ceo.laporan.print', [
            'generatedAt' => now(),
            'monthlyRevenue' => ReportService::monthlyRevenue(12),
            'topMotors' => ReportService::topMotors(10),
            'badCredits' => ReportService::badCredits(20),
            'totalProfit' => ReportService::totalProfit(),
        ]);
    }

    public function exportExcel(): Response
    {
        $rows = ["No Kontrak,Customer,Motor,Status Kredit,Sisa Kredit"];

        Kredit::query()
            ->with(['pengajuanKredit.user', 'pengajuanKredit.motor'])
            ->get()
            ->each(function (Kredit $kredit) use (&$rows) {
                $rows[] = implode(',', [
                    $kredit->no_kontrak,
                    $this->escapeCsv($kredit->pengajuanKredit->user->name),
                    $this->escapeCsv($kredit->pengajuanKredit->motor->nama_motor),
                    $kredit->status_kredit,
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
