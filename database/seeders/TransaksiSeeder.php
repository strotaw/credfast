<?php

namespace Database\Seeders;

use App\Models\Angsuran;
use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\Kredit;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Models\Pengiriman;
use App\Models\User;
use App\Support\CreditWorkflow;
use App\Support\PengajuanService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $admin = $this->user('admin@gmail.com');
        $marketing = $this->user('marketing@gmail.com');
        $marketingSurabaya = $this->user('marketing.surabaya@gmail.com');

        $user = $this->user('user@gmail.com');
        $nina = $this->user('nina@gmail.com');
        $budi = $this->user('budi@gmail.com');
        $sari = $this->user('sari@gmail.com');
        $dimas = $this->user('dimas@gmail.com');

        $tenor6 = $this->tenor(6);
        $tenor12 = $this->tenor(12);
        $tenor18 = $this->tenor(18);
        $tenor24 = $this->tenor(24);
        $tenor36 = $this->tenor(36);

        $allRisk = Asuransi::query()->where('nama_asuransi', 'Asuransi All Risk Premium')->firstOrFail();
        $tlo = Asuransi::query()->where('nama_asuransi', 'Asuransi Kehilangan & Kecelakaan')->firstOrFail();
        $fleet = Asuransi::query()->where('nama_asuransi', 'Asuransi Comprehensive Fleet')->firstOrFail();

        $bca = $this->metodeBayar('BCA');
        $bri = $this->metodeBayar('BRI');
        $mandiri = $this->metodeBayar('Mandiri');
        $bni = $this->metodeBayar('BNI');

        $pending = $this->pengajuan($user, $this->motor('Honda Vario 160 CBS'), $tenor12, $allRisk, 5000000, [
            'status_pengajuan' => PengajuanKredit::STATUS_MENUNGGU_KONFIRMASI,
            'tgl_pengajuan_kredit' => now()->subDays(4)->toDateString(),
            'metode_bayar_id' => $bca->id,
        ]);

        $this->pengajuan($nina, $this->motor('Yamaha R15 Connected'), $tenor24, $allRisk, 7000000, [
            'marketing_id' => $marketing->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DIPROSES,
            'catatan_marketing' => 'Prospek bagus, dokumen lengkap.',
            'tgl_pengajuan_kredit' => now()->subDays(10)->toDateString(),
            'metode_bayar_id' => $bri->id,
        ]);

        $this->pengajuan($nina, $this->motor('Suzuki Smash FI'), $tenor12, null, 2000000, [
            'marketing_id' => $marketing->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DIBATALKAN_PENJUAL,
            'keterangan_status_pengajuan' => 'Slip gaji belum memenuhi kriteria.',
            'tgl_pengajuan_kredit' => now()->subDays(15)->toDateString(),
            'metode_bayar_id' => $mandiri->id,
        ]);

        $this->pengajuan($sari, $this->motor('Suzuki Address FI'), $tenor18, $tlo, 3000000, [
            'marketing_id' => $marketingSurabaya->id,
            'status_pengajuan' => PengajuanKredit::STATUS_BERMASALAH,
            'keterangan_status_pengajuan' => 'NPWP dan slip gaji belum dilengkapi.',
            'tgl_pengajuan_kredit' => now()->subDays(2)->toDateString(),
            'metode_bayar_id' => $bni->id,
        ]);

        $this->pengajuan($budi, $this->motor('Kawasaki Ninja 250'), $tenor36, $fleet, 15000000, [
            'marketing_id' => $marketing->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DIPROSES,
            'catatan_marketing' => 'Survey rumah dijadwalkan pekan ini.',
            'tgl_pengajuan_kredit' => now()->subDays(6)->toDateString(),
            'metode_bayar_id' => $bca->id,
        ]);

        $this->pengajuan($dimas, $this->motor('Honda Scoopy Stylish'), $tenor6, $tlo, 2000000, [
            'status_pengajuan' => PengajuanKredit::STATUS_DIBATALKAN_PEMBELI,
            'keterangan_status_pengajuan' => 'User membatalkan pengajuan dari dashboard.',
            'tgl_pengajuan_kredit' => now()->subDays(9)->toDateString(),
            'metode_bayar_id' => $bri->id,
        ]);

        $r15Approved = $this->pengajuan($user, $this->motor('Yamaha R15 Connected'), $tenor12, $allRisk, 9000000, [
            'marketing_id' => $marketing->id,
            'admin_id' => $admin->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'catatan_marketing' => 'Layak pembiayaan.',
            'tgl_pengajuan_kredit' => now()->subMonths(2)->subDays(3)->toDateString(),
            'metode_bayar_id' => $bca->id,
        ]);
        $r15Kredit = $this->kredit($r15Approved, $bca, now()->subMonths(2)->startOfMonth());
        $this->resetAngsuran($r15Kredit);
        $this->markValidAngsuran($r15Kredit, 2, $admin);
        $this->syncKredit($r15Kredit, Kredit::STATUS_AKTIF);
        $this->pengiriman($r15Kredit, [
            'status_kirim' => Pengiriman::STATUS_DIKIRIM,
            'tgl_kirim' => now()->subDays(5),
            'nama_kurir' => 'Rizal Kurir',
            'telpon_kurir' => '081355566677',
            'bukti_foto' => 'seed/motor/yamaha-r15.jpg',
        ]);

        $pcxApproved = $this->pengajuan($budi, $this->motor('Honda PCX 160 ABS'), $tenor24, $fleet, 8000000, [
            'marketing_id' => $marketing->id,
            'admin_id' => $admin->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'catatan_marketing' => 'Riwayat pembayaran dan domisili valid.',
            'tgl_pengajuan_kredit' => now()->subMonths(5)->subDays(2)->toDateString(),
            'metode_bayar_id' => $mandiri->id,
        ]);
        $pcxKredit = $this->kredit($pcxApproved, $mandiri, now()->subMonths(5)->startOfMonth());
        $this->resetAngsuran($pcxKredit);
        $this->markValidAngsuran($pcxKredit, 5, $admin);
        $this->syncKredit($pcxKredit, Kredit::STATUS_AKTIF);
        $this->pengiriman($pcxKredit, [
            'status_kirim' => Pengiriman::STATUS_DITERIMA,
            'tgl_kirim' => now()->subMonths(4)->subDays(20),
            'tgl_tiba' => now()->subMonths(4)->subDays(18),
            'nama_kurir' => 'Dewi Logistics',
            'telpon_kurir' => '081377788899',
            'bukti_foto' => 'seed/motor/honda-pcx-160.jpg',
        ]);

        $nmaxApproved = $this->pengajuan($sari, $this->motor('Yamaha NMAX 155'), $tenor6, $tlo, 12000000, [
            'marketing_id' => $marketingSurabaya->id,
            'admin_id' => $admin->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'catatan_marketing' => 'DP besar dan tenor pendek.',
            'tgl_pengajuan_kredit' => now()->subMonths(6)->subDays(5)->toDateString(),
            'metode_bayar_id' => $bni->id,
        ]);
        $nmaxKredit = $this->kredit($nmaxApproved, $bni, now()->subMonths(6)->startOfMonth());
        $this->resetAngsuran($nmaxKredit);
        $this->markValidAngsuran($nmaxKredit, 6, $admin);
        $this->syncKredit($nmaxKredit);
        $this->pengiriman($nmaxKredit, [
            'status_kirim' => Pengiriman::STATUS_DITERIMA,
            'tgl_kirim' => now()->subMonths(5)->subDays(25),
            'tgl_tiba' => now()->subMonths(5)->subDays(23),
            'nama_kurir' => 'Made Express',
            'telpon_kurir' => '081399988877',
            'bukti_foto' => 'seed/motor/yamaha-nmax.jpg',
        ]);

        $klxApproved = $this->pengajuan($dimas, $this->motor('Kawasaki KLX 150'), $tenor24, $allRisk, 6500000, [
            'marketing_id' => $marketingSurabaya->id,
            'admin_id' => $admin->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'catatan_marketing' => 'Disetujui dengan catatan monitoring ketat.',
            'tgl_pengajuan_kredit' => now()->subMonths(5)->subDays(8)->toDateString(),
            'metode_bayar_id' => $bri->id,
        ]);
        $klxKredit = $this->kredit($klxApproved, $bri, now()->subMonths(5)->startOfMonth());
        $this->resetAngsuran($klxKredit);
        $this->markValidAngsuran($klxKredit, 1, $admin);
        $this->markLateAngsuran($klxKredit, 2, 4);
        $this->syncKredit($klxKredit, Kredit::STATUS_MACET, 'Beberapa angsuran melewati jatuh tempo.');
        $this->pengiriman($klxKredit, [
            'status_kirim' => Pengiriman::STATUS_DITERIMA,
            'tgl_kirim' => now()->subMonths(4)->subDays(25),
            'tgl_tiba' => now()->subMonths(4)->subDays(22),
            'nama_kurir' => 'Arif Courier',
            'telpon_kurir' => '081366655544',
            'bukti_foto' => 'seed/motor/kawasaki-klx-150.jpg',
        ]);

        $beatApproved = $this->pengajuan($nina, $this->motor('Honda BeAT Street'), $tenor12, $tlo, 3000000, [
            'marketing_id' => $marketing->id,
            'admin_id' => $admin->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'catatan_marketing' => 'Pembelian unit harian untuk operasional pribadi.',
            'tgl_pengajuan_kredit' => now()->subDays(20)->toDateString(),
            'metode_bayar_id' => $bca->id,
        ]);
        $beatKredit = $this->kredit($beatApproved, $bca, now()->subMonth()->startOfMonth());
        $this->resetAngsuran($beatKredit);
        $this->syncKredit($beatKredit, Kredit::STATUS_AKTIF);
        $this->pengiriman($beatKredit, [
            'status_kirim' => Pengiriman::STATUS_DIPROSES,
            'nama_kurir' => 'Tim Gudang CredFast',
            'telpon_kurir' => '081300011122',
            'bukti_foto' => 'seed/motor/honda-beat-street.png',
        ]);

        $pending->touch();
    }

    private function user(string $email): User
    {
        return User::query()->where('email', $email)->firstOrFail();
    }

    private function motor(string $name): Motor
    {
        return Motor::query()->where('nama_motor', $name)->firstOrFail();
    }

    private function tenor(int $months): JenisCicilan
    {
        return JenisCicilan::query()->where('lama_cicilan', $months)->firstOrFail();
    }

    private function metodeBayar(string $bank): MetodeBayar
    {
        return MetodeBayar::query()->where('nama_bank', $bank)->firstOrFail();
    }

    /**
     * @param  array<string, mixed>  $extra
     */
    private function pengajuan(User $user, Motor $motor, JenisCicilan $jenisCicilan, ?Asuransi $asuransi, int $dp, array $extra): PengajuanKredit
    {
        $user->syncPelangganProfile();
        $pelanggan = $user->pelanggan()->firstOrFail();

        $pengajuan = PengajuanKredit::query()
            ->where('pelanggan_id', $pelanggan->id)
            ->where('motor_id', $motor->id)
            ->where('dp', $dp)
            ->first();

        if (! $pengajuan) {
            return PengajuanService::create($user, $motor, $jenisCicilan, $asuransi, $dp, [], $extra);
        }

        $pengajuan->fill(array_merge([
            'jenis_cicilan_id' => $jenisCicilan->id,
            'asuransi_id' => $asuransi?->id,
        ], $extra));
        $pengajuan->save();

        return $pengajuan->fresh(['motor', 'jenisCicilan', 'metodeBayar']);
    }

    private function kredit(PengajuanKredit $pengajuan, MetodeBayar $metodeBayar, Carbon $startDate): Kredit
    {
        $pengajuan->update([
            'metode_bayar_id' => $metodeBayar->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
        ]);

        $kredit = $pengajuan->kredit()->first();

        if ($kredit) {
            return $kredit->fresh(['angsuran', 'pengiriman', 'pengajuanKredit.motor']);
        }

        return CreditWorkflow::createKredit($pengajuan->fresh(['motor', 'jenisCicilan', 'metodeBayar']), $metodeBayar, $startDate);
    }

    private function resetAngsuran(Kredit $kredit): void
    {
        $kredit->angsuran()->update([
            'tanggal_bayar' => null,
            'denda' => 0,
            'status' => Angsuran::STATUS_MENUNGGU,
            'verified_by' => null,
            'verified_at' => null,
            'keterangan' => null,
        ]);

        $kredit->angsuran()->get()->each(function (Angsuran $angsuran) {
            $angsuran->update(['total_bayar' => $angsuran->nominal]);
        });
    }

    private function markValidAngsuran(Kredit $kredit, int $count, User $admin): void
    {
        $kredit->angsuran()
            ->orderBy('angsuran_ke')
            ->take($count)
            ->get()
            ->each(function (Angsuran $angsuran) use ($admin) {
                $dueDate = Carbon::parse($angsuran->tanggal_jatuh_tempo);

                $angsuran->update([
                    'status' => Angsuran::STATUS_VALID,
                    'tanggal_bayar' => $dueDate->copy()->subDays(1),
                    'verified_by' => $admin->id,
                    'verified_at' => $dueDate->copy()->setHour(10),
                    'total_bayar' => $angsuran->nominal + $angsuran->denda,
                ]);
            });
    }

    private function markLateAngsuran(Kredit $kredit, int $from, int $to): void
    {
        $kredit->angsuran()
            ->whereBetween('angsuran_ke', [$from, $to])
            ->get()
            ->each(function (Angsuran $angsuran) {
                $angsuran->update([
                    'status' => Angsuran::STATUS_TELAT,
                    'denda' => 50000,
                    'total_bayar' => $angsuran->nominal + 50000,
                    'keterangan' => 'Belum dibayar melewati tanggal jatuh tempo.',
                ]);
            });
    }

    private function syncKredit(Kredit $kredit, ?string $status = null, ?string $note = null): void
    {
        CreditWorkflow::refreshKreditStatus($kredit->fresh(['angsuran']));

        if ($status) {
            $kredit->refresh()->update([
                'status_kredit' => $status,
                'keterangan_status_kredit' => $note,
            ]);
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function pengiriman(Kredit $kredit, array $data): void
    {
        $pengiriman = $kredit->pengiriman()->first();

        if (! $pengiriman) {
            $pengiriman = Pengiriman::create([
                'kredit_id' => $kredit->id,
                'no_invoice' => CreditWorkflow::generateInvoiceNumber(),
                'status_kirim' => Pengiriman::STATUS_DIPROSES,
            ]);
        }

        $pengiriman->update($data);
    }
}
