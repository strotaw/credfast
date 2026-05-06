<?php

namespace Tests\Feature;

use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\JenisMotor;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Models\PengajuanKredit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PengajuanFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_pengajuan_kredit(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $user->syncPelangganProfile();
        $jenisMotor = JenisMotor::create([
            'merk' => 'Honda',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);

        $motor = Motor::create([
            'jenis_motor_id' => $jenisMotor->id,
            'nama_motor' => 'Honda PCX Test',
            'harga_jual' => 32000000,
            'deskripsi_motor' => 'Motor test',
            'stok' => 4,
            'status' => 'tersedia',
        ]);

        $cicilan = JenisCicilan::create([
            'lama_cicilan' => 12,
            'margin_kredit' => 10,
        ]);

        $asuransi = Asuransi::create([
            'nama_perusahaan_asuransi' => 'PT Aman',
            'nama_asuransi' => 'Asuransi Test',
            'margin_asuransi' => 2.5,
        ]);

        $metodeBayar = MetodeBayar::create([
            'nama_bank' => 'BCA',
            'nomor_rekening' => '1234567890',
            'atas_nama' => 'PT CredFast',
            'status' => MetodeBayar::STATUS_AKTIF,
        ]);

        $response = $this->actingAs($user)->post(route('user.pengajuan.store'), [
            'motor_id' => $motor->id,
            'jenis_cicilan_id' => $cicilan->id,
            'asuransi_id' => $asuransi->id,
            'metode_bayar_id' => $metodeBayar->id,
            'dp' => 5000000,
            'url_kk' => UploadedFile::fake()->create('kk.pdf', 100),
            'url_ktp' => UploadedFile::fake()->create('ktp.pdf', 100),
            'url_npwp' => UploadedFile::fake()->create('npwp.pdf', 100),
            'url_slip_gaji' => UploadedFile::fake()->create('slip.pdf', 100),
            'url_foto' => UploadedFile::fake()->create('foto.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('pengajuan_kredit', [
            'pelanggan_id' => $user->pelanggan->id,
            'motor_id' => $motor->id,
            'metode_bayar_id' => $metodeBayar->id,
            'status_pengajuan' => PengajuanKredit::STATUS_MENUNGGU_KONFIRMASI,
        ]);
    }

    public function test_admin_can_review_pengajuan_submitted_by_customer(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'name' => 'Pelanggan Review',
            'email' => 'pelanggan-review@example.com',
            'role' => User::ROLE_USER,
        ]);
        $user->syncPelangganProfile();
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $jenisMotor = JenisMotor::create([
            'merk' => 'Honda',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);

        $motor = Motor::create([
            'jenis_motor_id' => $jenisMotor->id,
            'nama_motor' => 'Honda Review Test',
            'harga_jual' => 30000000,
            'deskripsi_motor' => 'Motor untuk review admin',
            'stok' => 4,
            'status' => Motor::STATUS_TERSEDIA,
        ]);

        $cicilan = JenisCicilan::create([
            'lama_cicilan' => 12,
            'margin_kredit' => 10,
        ]);

        $metodeBayar = MetodeBayar::create([
            'nama_bank' => 'BCA',
            'nomor_rekening' => '1234567890',
            'atas_nama' => 'PT CredFast',
            'status' => MetodeBayar::STATUS_AKTIF,
        ]);

        $this->actingAs($user)->post(route('user.pengajuan.store'), [
            'motor_id' => $motor->id,
            'jenis_cicilan_id' => $cicilan->id,
            'metode_bayar_id' => $metodeBayar->id,
            'dp' => 5000000,
            'url_kk' => UploadedFile::fake()->create('kk.pdf', 100),
            'url_ktp' => UploadedFile::fake()->create('ktp.pdf', 100),
            'url_npwp' => UploadedFile::fake()->create('npwp.pdf', 100),
            'url_slip_gaji' => UploadedFile::fake()->create('slip.pdf', 100),
            'url_foto' => UploadedFile::fake()->create('foto.jpg', 100, 'image/jpeg'),
        ]);

        $pengajuan = PengajuanKredit::query()->firstOrFail();

        $this->actingAs($admin)
            ->get(route('admin.pengajuan.index'))
            ->assertOk()
            ->assertSee('Pelanggan Review')
            ->assertSee('Honda Review Test')
            ->assertSee('Detail');

        $this->actingAs($admin)
            ->get(route('admin.pengajuan.show', $pengajuan))
            ->assertOk()
            ->assertSee('Data Pengajuan')
            ->assertSee('Pelanggan Review')
            ->assertSee('Dokumen pelanggan')
            ->assertSee('Foto Diri');

        $this->actingAs($admin)
            ->put(route('admin.pengajuan.approve', $pengajuan), [
                'keterangan_status_pengajuan' => 'Dokumen pelanggan valid.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('pengajuan_kredit', [
            'id' => $pengajuan->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
            'admin_id' => $admin->id,
            'keterangan_status_pengajuan' => 'Dokumen pelanggan valid.',
        ]);
    }

    public function test_marketing_can_review_pengajuan_submitted_by_customer(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'name' => 'Pelanggan Marketing',
            'email' => 'pelanggan-marketing@example.com',
            'role' => User::ROLE_USER,
        ]);
        $user->syncPelangganProfile();
        $marketing = User::factory()->create(['role' => User::ROLE_MARKETING]);

        $jenisMotor = JenisMotor::create([
            'merk' => 'Yamaha',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);

        $motor = Motor::create([
            'jenis_motor_id' => $jenisMotor->id,
            'nama_motor' => 'Yamaha Review Marketing',
            'harga_jual' => 31000000,
            'deskripsi_motor' => 'Motor untuk review marketing',
            'stok' => 4,
            'status' => Motor::STATUS_TERSEDIA,
        ]);

        $cicilan = JenisCicilan::create([
            'lama_cicilan' => 12,
            'margin_kredit' => 10,
        ]);

        $metodeBayar = MetodeBayar::create([
            'nama_bank' => 'BRI',
            'nomor_rekening' => '9876543210',
            'atas_nama' => 'PT CredFast',
            'status' => MetodeBayar::STATUS_AKTIF,
        ]);

        $this->actingAs($user)->post(route('user.pengajuan.store'), [
            'motor_id' => $motor->id,
            'jenis_cicilan_id' => $cicilan->id,
            'metode_bayar_id' => $metodeBayar->id,
            'dp' => 5000000,
            'url_kk' => UploadedFile::fake()->create('kk.pdf', 100),
            'url_ktp' => UploadedFile::fake()->create('ktp.pdf', 100),
            'url_npwp' => UploadedFile::fake()->create('npwp.pdf', 100),
            'url_slip_gaji' => UploadedFile::fake()->create('slip.pdf', 100),
            'url_foto' => UploadedFile::fake()->create('foto.jpg', 100, 'image/jpeg'),
        ]);

        $pengajuan = PengajuanKredit::query()->firstOrFail();

        $this->actingAs($marketing)
            ->get(route('marketing.pengajuan.index'))
            ->assertOk()
            ->assertSee('Data Pengajuan Pelanggan')
            ->assertSee('Pelanggan Marketing')
            ->assertSee('Yamaha Review Marketing')
            ->assertSee('Detail');

        $this->actingAs($marketing)
            ->get(route('marketing.pengajuan.show', $pengajuan))
            ->assertOk()
            ->assertSee('Data Pengajuan')
            ->assertSee('Pelanggan Marketing')
            ->assertSee('Dokumen pelanggan')
            ->assertSee('Foto Diri');

        $this->actingAs($marketing)
            ->put(route('marketing.pengajuan.status', $pengajuan), [
                'status_pengajuan' => PengajuanKredit::STATUS_DIPROSES,
                'keterangan_status_pengajuan' => 'Sedang dihubungi marketing.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('pengajuan_kredit', [
            'id' => $pengajuan->id,
            'status_pengajuan' => PengajuanKredit::STATUS_DIPROSES,
            'marketing_id' => $marketing->id,
            'keterangan_status_pengajuan' => 'Sedang dihubungi marketing.',
        ]);
    }

    public function test_admin_creates_kredit_with_user_selected_payment_method(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $user->syncPelangganProfile();
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $jenisMotor = JenisMotor::create([
            'merk' => 'Honda',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);
        $motor = Motor::create([
            'jenis_motor_id' => $jenisMotor->id,
            'nama_motor' => 'Honda ADV Test',
            'harga_jual' => 36000000,
            'deskripsi_motor' => 'Motor test',
            'stok' => 3,
            'status' => Motor::STATUS_TERSEDIA,
        ]);
        $cicilan = JenisCicilan::create([
            'lama_cicilan' => 12,
            'margin_kredit' => 10,
        ]);
        $metodeBayar = MetodeBayar::create([
            'nama_bank' => 'Mandiri',
            'nomor_rekening' => '1122334455',
            'atas_nama' => 'PT CredFast',
            'status' => MetodeBayar::STATUS_AKTIF,
        ]);
        $pengajuan = PengajuanKredit::create([
            'pelanggan_id' => $user->pelanggan->id,
            'motor_id' => $motor->id,
            'jenis_cicilan_id' => $cicilan->id,
            'metode_bayar_id' => $metodeBayar->id,
            'tgl_pengajuan_kredit' => now()->toDateString(),
            'harga_cash' => 36000000,
            'dp' => 6000000,
            'harga_kredit' => 33000000,
            'cicilan_perbulan' => 2750000,
            'status_pengajuan' => PengajuanKredit::STATUS_DITERIMA,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.pengajuan.buat-kredit', $pengajuan), [
            'tgl_mulai_kredit' => now()->toDateString(),
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('kredit', [
            'pengajuan_kredit_id' => $pengajuan->id,
            'metode_bayar_id' => $metodeBayar->id,
        ]);
    }
}
