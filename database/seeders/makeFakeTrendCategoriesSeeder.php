<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class makeFakeTrendCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_id' => 609,
                'icon' => 'assets/admin/img/home/code.svg',
                'color' => 'rgba(32, 80, 117, 0.1)',
                'created_at' => 1605117336,
            ],
            [
                'category_id' => 611,
                'icon' => 'assets/admin/img/home/chart.svg',
                'color' => 'rgba(11, 57, 84, 0.5)',
                'created_at' => 1605117336,
            ],
            [
                'category_id' => 604,
                'icon' => 'assets/admin/img/home/pie-chart.svg',
                'color' => 'rgba(32, 80, 117, 0.1)',
                'created_at' => 1605117336,
            ],
            [
                'category_id' => 523,
                'icon' => 'assets/admin/img/home/umbrella.svg',
                'color' => 'rgba(11, 57, 84, 0.5)',
                'created_at' => 1605117336,
            ],
            [
                'category_id' => 602,
                'icon' => 'assets/admin/img/home/heart.svg',
                'color' => 'rgba(32, 80, 117, 0.1)',
                'created_at' => 1605117336,
            ],
            [
                'category_id' => 520,
                'icon' => 'assets/admin/img/home/briefcase.svg',
                'color' => 'rgba(11, 57, 84, 0.5)',
                'created_at' => 1605117336,
            ],
            // Add more data as needed
        ];

        // Insert data into trend_categories table
        DB::table('trend_categories')->insert($data);
    }
}
