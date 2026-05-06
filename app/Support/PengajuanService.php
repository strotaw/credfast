<?php

namespace App\Support;

use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Models\User;

class PengajuanService
{
    /**
     * @param  array<string, string|null>  $documents
     * @param  array<string, mixed>  $extra
     */
    public static function create(
        User $user,
        Motor $motor,
        JenisCicilan $jenisCicilan,
        ?Asuransi $asuransi,
        int $dp,
        array $documents = [],
        array $extra = [],
    ): PengajuanKredit {
        $simulation = CreditCalculator::calculate($motor->harga_jual, $dp, $jenisCicilan, $asuransi);
        $user->syncPelangganProfile();
        $pelanggan = $user->pelanggan()->firstOrFail();

        return PengajuanKredit::create(array_merge([
            'pelanggan_id' => $pelanggan->id,
            'motor_id' => $motor->id,
            'jenis_cicilan_id' => $jenisCicilan->id,
            'asuransi_id' => $asuransi?->id,
            'tgl_pengajuan_kredit' => now()->toDateString(),
            'harga_cash' => $motor->harga_jual,
            'dp' => $dp,
            'harga_kredit' => $simulation['harga_kredit'],
            'biaya_asuransi_perbulan' => $simulation['biaya_asuransi_perbulan'],
            'cicilan_perbulan' => $simulation['cicilan_perbulan'],
            'url_kk' => $documents['url_kk'] ?? null,
            'url_ktp' => $documents['url_ktp'] ?? null,
            'url_npwp' => $documents['url_npwp'] ?? null,
            'url_slip_gaji' => $documents['url_slip_gaji'] ?? null,
            'url_foto' => $documents['url_foto'] ?? null,
            'status_pengajuan' => PengajuanKredit::STATUS_MENUNGGU_KONFIRMASI,
        ], $extra));
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public static function findOrCreateOfflineUser(array $payload): User
    {
        $user = User::firstOrNew(['email' => $payload['email']]);

        $user->fill([
            'name' => $payload['name'],
            'role' => User::ROLE_USER,
            'password' => $user->exists ? $user->password : 'password',
            'no_hp' => $payload['no_hp'] ?? null,
            'alamat' => $payload['alamat'] ?? null,
            'kota' => $payload['kota'] ?? null,
            'provinsi' => $payload['provinsi'] ?? null,
            'kode_pos' => $payload['kode_pos'] ?? null,
        ]);

        $user->save();
        $user->syncPelangganProfile();

        return $user;
    }
}
