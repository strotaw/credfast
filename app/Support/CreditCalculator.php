<?php

namespace App\Support;

use App\Models\Asuransi;
use App\Models\JenisCicilan;
use InvalidArgumentException;

class CreditCalculator
{
    /**
     * @return array<string, float|int>
     */
    public static function calculate(float|int $hargaMotor, float|int $dp, JenisCicilan $jenisCicilan, ?Asuransi $asuransi = null): array
    {
        if ($dp > $hargaMotor) {
            throw new InvalidArgumentException('DP tidak boleh lebih besar dari harga motor.');
        }

        $pokokKredit = $hargaMotor - $dp;
        $marginNominal = $pokokKredit * ((float) $jenisCicilan->margin_kredit / 100);
        $biayaAsuransiTotal = $asuransi ? $hargaMotor * ((float) $asuransi->margin_asuransi / 100) : 0;
        $hargaKredit = $pokokKredit + $marginNominal + $biayaAsuransiTotal;
        $biayaAsuransiPerBulan = $biayaAsuransiTotal / $jenisCicilan->lama_cicilan;
        $cicilanPerBulan = $hargaKredit / $jenisCicilan->lama_cicilan;

        return [
            'pokok_kredit' => round($pokokKredit, 2),
            'margin_nominal' => round($marginNominal, 2),
            'biaya_asuransi_total' => round($biayaAsuransiTotal, 2),
            'harga_kredit' => round($hargaKredit, 2),
            'biaya_asuransi_perbulan' => round($biayaAsuransiPerBulan, 2),
            'cicilan_perbulan' => round($cicilanPerBulan, 2),
        ];
    }
}
