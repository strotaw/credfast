<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angsuran;
use App\Models\Kredit;
use App\Models\PengajuanKredit;
use App\Support\ReportService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(): View
    {
        return view('admin.laporan.index', [
            'totalRevenue' => ReportService::totalRevenue(),
            'totalProfit' => ReportService::totalProfit(),
            'monthlyRevenue' => ReportService::monthlyRevenue(6),
            'monthlyApplications' => ReportService::monthlyApplications(6),
            'creditStatusBreakdown' => ReportService::creditStatusBreakdown(),
            'topMotors' => ReportService::topMotors(),
            'badCredits' => ReportService::badCredits(),
        ]);
    }

    public function exportPdf(): View
    {
        return view('admin.laporan.print', [
            'generatedAt' => now(),
            'totalRevenue' => ReportService::totalRevenue(),
            'totalProfit' => ReportService::totalProfit(),
            'topMotors' => ReportService::topMotors(10),
            'badCredits' => ReportService::badCredits(10),
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
            'Content-Disposition' => 'attachment; filename="laporan-operasional-credfast.csv"',
        ]);
    }

    private function escapeCsv(string $value): string
    {
        return '"'.str_replace('"', '""', $value).'"';
    }
}
