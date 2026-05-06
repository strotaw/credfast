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
                'url_logo' => 'seed/logo/aman-berkendara.png',
            ],
            [
                'nama_perusahaan_asuransi' => 'PT Proteksi Nusantara',
                'nama_asuransi' => 'Asuransi Kehilangan & Kecelakaan',
                'margin_asuransi' => 1.75,
                'no_rekening' => '9988776655',
                'url_logo' => 'seed/logo/proteksi-nusantara.png',
            ],
            [
                'nama_perusahaan_asuransi' => 'PT Sentosa Proteksi Motor',
                'nama_asuransi' => 'Asuransi Comprehensive Fleet',
                'margin_asuransi' => 2.15,
                'no_rekening' => '5566778899',
                'url_logo' => 'seed/logo/sentosa-proteksi.png',
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
