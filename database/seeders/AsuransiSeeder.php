<?php

namespace Database\Seeders;

use App\Models\Asuransi;
use Illuminate\Database\Seeder;

class AsuransiSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nama_perusahaan_asuransi' => 'PT Aman Berkendara',
                'nama_asuransi' => 'Asuransi All Risk Premium',
                'margin_asuransi' => 2.5,
                'no_rekening' => '0011223344',
            ],
            [
                'nama_perusahaan_asuransi' => 'PT Proteksi Nusantara',
                'nama_asuransi' => 'Asuransi Kehilangan & Kecelakaan',
                'margin_asuransi' => 1.75,
                'no_rekening' => '9988776655',
            ],
        ];

        foreach ($items as $item) {
            Asuransi::updateOrCreate(
                ['nama_asuransi' => $item['nama_asuransi']],
                $item,
            );
        }
    }
}
