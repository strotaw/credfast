<?php

namespace Tests\Feature;

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
            ->assertSee('Honda Vario Test');
    }
}
