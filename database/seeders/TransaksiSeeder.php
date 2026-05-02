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
        $user = User::query()->where('email', 'user@gmail.com')->firstOrFail();
        $userTwo = User::query()->where('email', 'nina@gmail.com')->firstOrFail();
        $marketing = User::query()->where('email', 'marketing@gmail.com')->firstOrFail();
        $admin = User::query()->where('email', 'admin@gmail.com')->firstOrFail();
        $motor = Motor::query()->where('nama_motor', 'Honda Vario 160 CBS')->firstOrFail();
        $motorTwo = Motor::query()->where('nama_motor', 'Yamaha R15 Connected')->firstOrFail();
        $tenor12 = JenisCicilan::query()->where('lama_cicilan', 12)->firstOrFail();
        $tenor24 = JenisCicilan::query()->where('lama_cicilan', 24)->firstOrFail();
        $asuransi = Asuransi::query()->first();
        $metode = MetodeBayar::query()->first();

        $pending = PengajuanService::create($user, $motor, $tenor12, $asuransi, 5000000, [], [
            'status_pengajuan' => PengajuanKredit::STATUS_MENUNGGU,
        ]);

        $recommended = PengajuanService::create($userTwo, $motorTwo, $tenor24, $asuransi, 7000000, [], [
            'marketing_id' => $marketing->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DIREKOMENDASIKAN,
            'catatan_marketing' => 'Prospek bagus, dokumen lengkap.',
        ]);

        $approved = PengajuanService::create($user, $motorTwo, $tenor12, $asuransi, 9000000, [], [
            'marketing_id' => $marketing->id,
            'admin_id' => $admin->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'catatan_marketing' => 'Layak pembiayaan.',
        ]);

        $rejected = PengajuanService::create($userTwo, $motor, $tenor12, null, 2000000, [], [
            'marketing_id' => $marketing->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITOLAK,
            'keterangan_status_pengajuan' => 'Slip gaji belum memenuhi kriteria.',
        ]);

        $createdKredit = CreditWorkflow::createKredit($approved->fresh(['motor', 'jenisCicilan']), $metode, Carbon::now()->subMonths(2)->startOfMonth());
        $createdKredit->pengiriman()->update([
            'status_kirim' => Pengiriman::STATUS_DIKIRIM,
            'tgl_kirim' => Carbon::now()->subDays(5),
            'nama_kurir' => 'Rizal Kurir',
            'telpon_kurir' => '081355566677',
        ]);

        $angsuranList = $createdKredit->angsuran()->orderBy('angsuran_ke')->get();
        foreach ($angsuranList->take(2) as $angsuran) {
            $angsuran->update([
                'status' => Angsuran::STATUS_VALID,
                'tanggal_bayar' => $angsuran->tanggal_jatuh_tempo,
                'verified_by' => $admin->id,
                'verified_at' => Carbon::parse($angsuran->tanggal_jatuh_tempo)->setHour(10),
                'total_bayar' => $angsuran->nominal,
            ]);
        }

        CreditWorkflow::refreshKreditStatus($createdKredit->fresh());

        $macetApplication = PengajuanService::create($userTwo, $motor, $tenor24, $asuransi, 6500000, [], [
            'marketing_id' => $marketing->id,
            'admin_id' => $admin->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
        ]);

        $macetKredit = CreditWorkflow::createKredit($macetApplication->fresh(['motor', 'jenisCicilan']), $metode, Carbon::now()->subMonths(5)->startOfMonth());
        $macetKredit->update([
            'status_kredit' => Kredit::STATUS_MACET,
            'keterangan_status_kredit' => 'Beberapa angsuran melewati jatuh tempo.',
        ]);

        $lateAngsuran = $macetKredit->angsuran()->orderBy('angsuran_ke')->take(3)->get();
        foreach ($lateAngsuran as $angsuran) {
            $angsuran->update([
                'status' => Angsuran::STATUS_TELAT,
                'denda' => 50000,
                'total_bayar' => $angsuran->nominal + 50000,
            ]);
        }
    }
}
