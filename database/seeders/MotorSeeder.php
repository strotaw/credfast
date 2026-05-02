<?php

namespace Database\Seeders;

use App\Models\JenisMotor;
use App\Models\Motor;
use Illuminate\Database\Seeder;

class MotorSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'jenis' => ['merk' => 'Honda', 'tipe' => 'skuter'],
                'nama_motor' => 'Honda Vario 160 CBS',
                'harga_jual' => 27600000,
                'deskripsi_motor' => 'Skutik premium dengan tampilan sporty, mesin 160cc eSP+, dan fitur modern.',
                'warna' => 'Matte Black',
                'kapasitas_mesin' => '160cc',
                'tahun' => 2025,
                'stok' => 8,
                'status' => Motor::STATUS_TERSEDIA,
            ],
            [
                'jenis' => ['merk' => 'Honda', 'tipe' => 'skuter'],
                'nama_motor' => 'Honda PCX 160 ABS',
                'harga_jual' => 36000000,
                'deskripsi_motor' => 'Skutik elegan dengan ABS, bagasi lega, dan kenyamanan premium.',
                'warna' => 'Majestic Matte Red',
                'kapasitas_mesin' => '160cc',
                'tahun' => 2025,
                'stok' => 6,
                'status' => Motor::STATUS_TERSEDIA,
            ],
            [
                'jenis' => ['merk' => 'Yamaha', 'tipe' => 'sport_bike'],
                'nama_motor' => 'Yamaha R15 Connected',
                'harga_jual' => 39800000,
                'deskripsi_motor' => 'Motor sport fairing dengan DNA R-Series dan konektivitas modern.',
                'warna' => 'Icon Blue',
                'kapasitas_mesin' => '155cc',
                'tahun' => 2025,
                'stok' => 4,
                'status' => Motor::STATUS_TERSEDIA,
            ],
            [
                'jenis' => ['merk' => 'Suzuki', 'tipe' => 'bebek'],
                'nama_motor' => 'Suzuki Smash FI',
                'harga_jual' => 19400000,
                'deskripsi_motor' => 'Motor bebek ekonomis dengan konsumsi bahan bakar irit.',
                'warna' => 'Titan Black',
                'kapasitas_mesin' => '115cc',
                'tahun' => 2024,
                'stok' => 5,
                'status' => Motor::STATUS_TERSEDIA,
            ],
            [
                'jenis' => ['merk' => 'Kawasaki', 'tipe' => 'dual_sport'],
                'nama_motor' => 'Kawasaki KLX 150',
                'harga_jual' => 33800000,
                'deskripsi_motor' => 'Dual purpose ringan untuk area kota dan off-road ringan.',
                'warna' => 'Lime Green',
                'kapasitas_mesin' => '150cc',
                'tahun' => 2025,
                'stok' => 3,
                'status' => Motor::STATUS_TERSEDIA,
            ],
        ];

        foreach ($items as $item) {
            $jenis = JenisMotor::query()
                ->where('merk', $item['jenis']['merk'])
                ->where('tipe', $item['jenis']['tipe'])
                ->firstOrFail();

            unset($item['jenis']);

            Motor::updateOrCreate(
                ['nama_motor' => $item['nama_motor']],
                array_merge($item, ['jenis_motor_id' => $jenis->id]),
            );
        }
    }
}
