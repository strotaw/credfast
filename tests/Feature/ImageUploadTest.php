<?php

namespace Tests\Feature;

use App\Models\Asuransi;
use App\Models\JenisMotor;
use App\Models\MetodeBayar;
use App\Models\Motor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_motor_image_and_public_catalog_shows_it(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $jenisMotor = JenisMotor::create([
            'merk' => 'Honda',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.motor.store'), [
            'jenis_motor_id' => $jenisMotor->id,
            'nama_motor' => 'Honda Vario Foto',
            'harga_jual' => 25000000,
            'deskripsi_motor' => 'Motor dengan foto utama',
            'warna' => 'Merah',
            'kapasitas_mesin' => '160cc',
            'tahun' => 2026,
            'stok' => 5,
            'status' => Motor::STATUS_TERSEDIA,
            'foto1' => $this->fakePngUpload('motor.png'),
        ]);

        $response->assertRedirect(route('admin.motor.index'));

        $motor = Motor::query()->firstOrFail();

        Storage::disk('public')->assertExists($motor->foto1);

        $this->get(route('public.motor'))
            ->assertOk()
            ->assertSee('/storage/'.$motor->foto1, false);
    }

    public function test_motor_image_upload_rejects_pdf(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $jenisMotor = JenisMotor::create([
            'merk' => 'Honda',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);

        $response = $this->actingAs($admin)->from(route('admin.motor.create'))->post(route('admin.motor.store'), [
            'jenis_motor_id' => $jenisMotor->id,
            'nama_motor' => 'Honda Vario PDF',
            'harga_jual' => 25000000,
            'deskripsi_motor' => 'Motor dengan file salah',
            'stok' => 5,
            'status' => Motor::STATUS_TERSEDIA,
            'foto1' => UploadedFile::fake()->create('motor.pdf', 100, 'application/pdf'),
        ]);

        $response->assertRedirect(route('admin.motor.create'));
        $response->assertSessionHasErrors('foto1');
    }

    public function test_user_can_upload_profile_photo_and_profile_page_shows_it(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => User::ROLE_USER]);

        $response = $this->actingAs($user)->put(route('user.profil.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'no_hp' => $user->no_hp,
            'alamat' => $user->alamat,
            'kota' => $user->kota,
            'provinsi' => $user->provinsi,
            'kode_pos' => $user->kode_pos,
            'foto' => $this->fakePngUpload('profile.png'),
        ]);

        $response->assertRedirect();

        $user->refresh();

        Storage::disk('public')->assertExists($user->foto);

        $this->actingAs($user)->get(route('user.profil.edit'))
            ->assertOk()
            ->assertSee('/storage/'.$user->foto, false);
    }

    public function test_profile_photo_upload_rejects_pdf(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);

        $response = $this->actingAs($user)->from(route('user.profil.edit'))->put(route('user.profil.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'foto' => UploadedFile::fake()->create('profile.pdf', 100, 'application/pdf'),
        ]);

        $response->assertRedirect(route('user.profil.edit'));
        $response->assertSessionHasErrors('foto');
    }

    public function test_admin_can_upload_master_data_images_and_they_are_rendered(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->actingAs($admin)->post(route('admin.asuransi.store'), [
            'nama_perusahaan_asuransi' => 'PT Aman',
            'nama_asuransi' => 'Asuransi Logo',
            'margin_asuransi' => 2.5,
            'url_logo' => $this->fakePngUpload('asuransi.png'),
        ])->assertRedirect(route('admin.asuransi.index'));

        $this->actingAs($admin)->post(route('admin.metode-bayar.store'), [
            'nama_bank' => 'BCA',
            'nomor_rekening' => '1234567890',
            'atas_nama' => 'PT CredFast',
            'status' => MetodeBayar::STATUS_AKTIF,
            'url_logo' => $this->fakePngUpload('bank.png'),
        ])->assertRedirect(route('admin.metode-bayar.index'));

        $this->actingAs($admin)->post(route('admin.jenis-motor.store'), [
            'merk' => 'Yamaha',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
            'image_url' => $this->fakePngUpload('jenis.png'),
        ])->assertRedirect(route('admin.jenis-motor.index'));

        $asuransi = Asuransi::query()->firstOrFail();
        $metodeBayar = MetodeBayar::query()->firstOrFail();
        $jenisMotor = JenisMotor::query()->where('merk', 'Yamaha')->firstOrFail();

        Storage::disk('public')->assertExists($asuransi->url_logo);
        Storage::disk('public')->assertExists($metodeBayar->url_logo);
        Storage::disk('public')->assertExists($jenisMotor->image_url);

        $this->actingAs($admin)->get(route('admin.asuransi.index'))->assertSee('/storage/'.$asuransi->url_logo, false);
        $this->actingAs($admin)->get(route('admin.metode-bayar.index'))->assertSee('/storage/'.$metodeBayar->url_logo, false);
        $this->actingAs($admin)->get(route('admin.jenis-motor.index'))->assertSee('/storage/'.$jenisMotor->image_url, false);
    }

    public function test_master_data_image_upload_rejects_pdf(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this->actingAs($admin)->from(route('admin.asuransi.create'))->post(route('admin.asuransi.store'), [
            'nama_perusahaan_asuransi' => 'PT Aman',
            'nama_asuransi' => 'Asuransi PDF',
            'margin_asuransi' => 2.5,
            'url_logo' => UploadedFile::fake()->create('logo.pdf', 100, 'application/pdf'),
        ]);

        $response->assertRedirect(route('admin.asuransi.create'));
        $response->assertSessionHasErrors('url_logo');
    }

    private function fakePngUpload(string $name): File
    {
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAFgwJ/lK3QnQAAAABJRU5ErkJggg==');

        return UploadedFile::fake()
            ->createWithContent($name, $png)
            ->mimeType('image/png');
    }
}
