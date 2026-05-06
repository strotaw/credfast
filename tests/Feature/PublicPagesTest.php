<?php

namespace Tests\Feature;

use App\Models\Asuransi;
use App\Models\JenisCicilan;
use App\Models\JenisMotor;
use App\Models\Motor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully(): void
    {
        $jenis = JenisMotor::create([
            'merk' => 'Honda',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);

        Motor::create([
            'jenis_motor_id' => $jenis->id,
            'nama_motor' => 'Honda Vario Test',
            'harga_jual' => 25000000,
            'deskripsi_motor' => 'Unit test motor',
            'stok' => 5,
            'status' => 'tersedia',
        ]);

        $response = $this->get(route('home'));

        $response
            ->assertOk()
            ->assertSee('CredFast')
            ->assertSee('Apa itu CredFast?')
            ->assertSee('Motor yang tersedia')
            ->assertSee('Honda Vario Test');
    }

    public function test_simulasi_page_loads_with_motor_query(): void
    {
        $jenis = JenisMotor::create([
            'merk' => 'Honda',
            'tipe' => 'skuter',
            'deskripsi_jenis' => 'Skuter',
        ]);

        $motor = Motor::create([
            'jenis_motor_id' => $jenis->id,
            'nama_motor' => 'Honda Vario Simulasi',
            'harga_jual' => 25000000,
            'deskripsi_motor' => 'Unit test simulasi',
            'stok' => 5,
            'status' => 'tersedia',
        ]);

        JenisCicilan::create([
            'lama_cicilan' => 12,
            'margin_kredit' => 10,
        ]);

        Asuransi::create([
            'nama_perusahaan_asuransi' => 'PT Test Asuransi',
            'nama_asuransi' => 'Asuransi Test',
            'margin_asuransi' => 2.5,
            'no_rekening' => '123456',
        ]);

        $response = $this->get(route('public.simulasi', ['motor_id' => $motor->id]));

        $response
            ->assertOk()
            ->assertSee('Honda Vario Simulasi')
            ->assertSee('Asuransi Test');
    }
}
