<?php

namespace Database\Seeders;

use App\Models\MetodeBayar;
use Illuminate\Database\Seeder;

class MetodeBayarSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama_bank' => 'BCA', 'nomor_rekening' => '1234567890', 'atas_nama' => 'PT Kredit Motor Nusantara', 'status' => MetodeBayar::STATUS_AKTIF],
            ['nama_bank' => 'BRI', 'nomor_rekening' => '9876543210', 'atas_nama' => 'PT Kredit Motor Nusantara', 'status' => MetodeBayar::STATUS_AKTIF],
            ['nama_bank' => 'Mandiri', 'nomor_rekening' => '1122334455', 'atas_nama' => 'PT Kredit Motor Nusantara', 'status' => MetodeBayar::STATUS_AKTIF],
        ];

        foreach ($items as $item) {
            MetodeBayar::updateOrCreate(
                ['nama_bank' => $item['nama_bank']],
                $item,
            );
        }
    }
}
