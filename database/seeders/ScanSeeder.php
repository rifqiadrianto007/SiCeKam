<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scan;

class ScanSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = ['A', 'B', 'C', 'D', 'E'];

        foreach ($blocks as $block) {
            Scan::updateOrCreate(
                ['blok' => $block],
                [
                    'jumlah_ayam' => rand(50, 200),
                    'ayam_sakit' => rand(0, 10),

                ]
            );
        }
    }
}
