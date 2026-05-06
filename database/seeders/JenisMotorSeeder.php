<?php

namespace Database\Seeders;

use App\Models\JenisMotor;
use Illuminate\Database\Seeder;

class JenisMotorSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'merk' => 'Honda',
                'tipe' => 'skuter',
                'deskripsi_jenis' => 'Skuter matik irit dan nyaman untuk mobilitas harian.',
                'image_url' => 'seed/motor/honda-vario-160.png',
            ],
            [
                'merk' => 'Yamaha',
                'tipe' => 'skuter',
                'deskripsi_jenis' => 'Skuter premium dengan bagasi lega dan fitur konektivitas.',
                'image_url' => 'seed/motor/yamaha-nmax.jpg',
            ],
            [
                'merk' => 'Yamaha',
                'tipe' => 'sport_bike',
                'deskripsi_jenis' => 'Motor sport untuk performa tinggi dan gaya agresif.',
                'image_url' => 'seed/motor/yamaha-r15.jpg',
            ],
            [
                'merk' => 'Suzuki',
                'tipe' => 'bebek',
                'deskripsi_jenis' => 'Motor bebek tangguh untuk usaha dan keluarga.',
                'image_url' => 'seed/motor/suzuki-smash-fi.jpg',
            ],
            [
                'merk' => 'Suzuki',
                'tipe' => 'skuter',
                'deskripsi_jenis' => 'Skuter praktis untuk aktivitas perkotaan dan harian.',
                'image_url' => 'seed/motor/suzuki-address-fi.jpg',
            ],
            [
                'merk' => 'Kawasaki',
                'tipe' => 'dual_sport',
                'deskripsi_jenis' => 'Motor untuk jalanan kota dan semi adventure.',
                'image_url' => 'seed/motor/kawasaki-klx-150.jpg',
            ],
            [
                'merk' => 'Kawasaki',
                'tipe' => 'sport_bike',
                'deskripsi_jenis' => 'Sport bike fairing untuk pengendara yang ingin tampilan agresif.',
                'image_url' => 'seed/motor/kawasaki-ninja-250.jpg',
            ],
            [
                'merk' => 'Kawasaki',
                'tipe' => 'retro',
                'deskripsi_jenis' => 'Motor retro klasik dengan karakter santai dan elegan.',
                'image_url' => 'seed/motor/kawasaki-w175.jpg',
            ],
        ];

        foreach ($items as $item) {
            JenisMotor::updateOrCreate(
                ['merk' => $item['merk'], 'tipe' => $item['tipe']],
                $item,
            );
        }
    }
}
