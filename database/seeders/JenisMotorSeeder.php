<?php

namespace Database\Seeders;

use App\Models\JenisMotor;
use Illuminate\Database\Seeder;

class JenisMotorSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['merk' => 'Honda', 'tipe' => 'skuter', 'deskripsi_jenis' => 'Skuter matik irit dan nyaman untuk mobilitas harian.'],
            ['merk' => 'Yamaha', 'tipe' => 'sport_bike', 'deskripsi_jenis' => 'Motor sport untuk performa tinggi dan gaya agresif.'],
            ['merk' => 'Suzuki', 'tipe' => 'bebek', 'deskripsi_jenis' => 'Motor bebek tangguh untuk usaha dan keluarga.'],
            ['merk' => 'Kawasaki', 'tipe' => 'dual_sport', 'deskripsi_jenis' => 'Motor untuk jalanan kota dan semi adventure.'],
        ];

        foreach ($items as $item) {
            JenisMotor::updateOrCreate(
                ['merk' => $item['merk'], 'tipe' => $item['tipe']],
                $item,
            );
        }
    }
}
