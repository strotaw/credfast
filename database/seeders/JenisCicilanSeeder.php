<?php

namespace Database\Seeders;

use App\Models\JenisCicilan;
use Illuminate\Database\Seeder;

class JenisCicilanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['lama_cicilan' => 3, 'margin_kredit' => 3],
            ['lama_cicilan' => 6, 'margin_kredit' => 5],
            ['lama_cicilan' => 12, 'margin_kredit' => 10],
            ['lama_cicilan' => 18, 'margin_kredit' => 14],
            ['lama_cicilan' => 24, 'margin_kredit' => 18],
            ['lama_cicilan' => 36, 'margin_kredit' => 25],
            ['lama_cicilan' => 48, 'margin_kredit' => 32],
        ];

        foreach ($items as $item) {
            JenisCicilan::updateOrCreate(
                ['lama_cicilan' => $item['lama_cicilan']],
                $item,
            );
        }
    }
}
