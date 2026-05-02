<?php

namespace Database\Seeders;

use App\Models\JenisCicilan;
use Illuminate\Database\Seeder;

class JenisCicilanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['lama_cicilan' => 6, 'margin_kredit' => 5],
            ['lama_cicilan' => 12, 'margin_kredit' => 10],
            ['lama_cicilan' => 24, 'margin_kredit' => 18],
            ['lama_cicilan' => 36, 'margin_kredit' => 25],
        ];

        foreach ($items as $item) {
            JenisCicilan::updateOrCreate(
                ['lama_cicilan' => $item['lama_cicilan']],
                $item,
            );
        }
    }
}
