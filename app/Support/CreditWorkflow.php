<?php

namespace App\Support;

use App\Models\Angsuran;
use App\Models\Kredit;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CreditWorkflow
{
    public static function syncOverdueStatuses(): void
    {
        Angsuran::query()
            ->whereIn('status', [Angsuran::STATUS_MENUNGGU, Angsuran::STATUS_DIBAYAR, Angsuran::STATUS_DITOLAK])
            ->whereDate('tanggal_jatuh_tempo', '<', now()->toDateString())
            ->update([
                'status' => Angsuran::STATUS_TELAT,
                'denda' => 50000,
            ]);
    }

    public static function createKredit(PengajuanKredit $pengajuan, ?MetodeBayar $metodeBayar = null, ?Carbon $startDate = null): Kredit
    {
        if ($pengajuan->status_pengajuan !== PengajuanKredit::STATUS_DITERIMA) {
            throw new RuntimeException('Pengajuan belum disetujui.');
        }

        if ($pengajuan->kredit()->exists()) {
            throw new RuntimeException('Kredit untuk pengajuan ini sudah dibuat.');
        }

        $motor = $pengajuan->motor;
        if (! $motor || $motor->stok <= 0 || $motor->status !== Motor::STATUS_TERSEDIA) {
            throw new RuntimeException('Motor tidak tersedia untuk dibuatkan kredit.');
        }

        $startDate ??= now()->startOfDay();
        $endDate = $startDate->copy()->addMonths($pengajuan->jenisCicilan->lama_cicilan - 1);

        return DB::transaction(function () use ($pengajuan, $metodeBayar, $startDate, $endDate, $motor) {
            $kredit = Kredit::create([
                'pengajuan_kredit_id' => $pengajuan->id,
                'metode_bayar_id' => $metodeBayar?->id,
                'no_kontrak' => self::generateContractNumber(),
                'tgl_mulai_kredit' => $startDate->toDateString(),
                'tgl_selesai_kredit' => $endDate->toDateString(),
                'total_kredit' => $pengajuan->harga_kredit,
                'sisa_kredit' => $pengajuan->harga_kredit,
                'status_kredit' => Kredit::STATUS_AKTIF,
            ]);

            for ($i = 1; $i <= $pengajuan->jenisCicilan->lama_cicilan; $i++) {
                $jatuhTempo = $startDate->copy()->addMonths($i - 1);
                Angsuran::create([
                    'kredit_id' => $kredit->id,
                    'angsuran_ke' => $i,
                    'tanggal_jatuh_tempo' => $jatuhTempo->toDateString(),
                    'nominal' => $pengajuan->cicilan_perbulan,
                    'denda' => 0,
                    'total_bayar' => $pengajuan->cicilan_perbulan,
                    'status' => Angsuran::STATUS_MENUNGGU,
                ]);
            }

            Pengiriman::create([
                'kredit_id' => $kredit->id,
                'no_invoice' => self::generateInvoiceNumber(),
                'status_kirim' => Pengiriman::STATUS_DIPROSES,
            ]);

            $motor->decrement('stok');

            $motor->refresh();
            if ($motor->stok <= 0) {
                $motor->update(['status' => Motor::STATUS_HABIS]);
            }

            self::refreshKreditStatus($kredit->fresh(['angsuran']));

            return $kredit->fresh(['pengajuanKredit.user', 'pengajuanKredit.motor', 'angsuran', 'pengiriman']);
        });
    }

    public static function refreshKreditStatus(Kredit $kredit): void
    {
        $angsuran = $kredit->angsuran()->get();
        $paidAmount = $angsuran->where('status', Angsuran::STATUS_VALID)->sum('total_bayar');
        $hasOutstanding = $angsuran->contains(fn (Angsuran $item) => $item->status !== Angsuran::STATUS_VALID);

        $kredit->update([
            'sisa_kredit' => max(0, round($kredit->total_kredit - $paidAmount, 2)),
        ]);

        if (! $hasOutstanding) {
            $kredit->update([
                'status_kredit' => Kredit::STATUS_LUNAS,
                'sisa_kredit' => 0,
            ]);
        }
    }

    public static function generateContractNumber(): string
    {
        $datePart = now()->format('Ymd');
        $countToday = Kredit::query()
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        return sprintf('KM-%s-%04d', $datePart, $countToday);
    }

    public static function generateInvoiceNumber(): string
    {
        $datePart = now()->format('Ymd');
        $countToday = Pengiriman::query()
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        return sprintf('INV-KRM-%s-%04d', $datePart, $countToday);
    }
}
