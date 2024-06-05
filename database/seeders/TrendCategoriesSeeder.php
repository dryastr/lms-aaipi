<?php

namespace Database\Seeders;

use App\Models\TrendCategory;
use Illuminate\Database\Seeder;

class TrendCategoriesSeeder extends Seeder
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
                'id' => 1,
                'category_id' => 526,
                'icon' => '/store/1/default_images/trend_categories_icons/briefcase.png',
                'color' => 'rgba(32, 80, 117, 0.1)',
            ],
            [
                'id' => 2,
                'category_id' => 611,
                'icon' => '/store/1/default_images/trend_categories_icons/bulb.png',
                'color' => 'rgba(11, 57, 84, 0.5)',
            ],
            [
                'id' => 3,
                'category_id' => 604,
                'icon' => '/store/1/default_images/trend_categories_icons/family.png',
                'color' => 'rgba(32, 80, 117, 0.1)',
            ],
            [
                'id' => 4,
                'category_id' => 523,
                'icon' => '/store/1/default_images/trend_categories_icons/muscle.png',
                'color' => 'rgba(11, 57, 84, 0.5)',
            ],
            [
                'id' => 5,
                'category_id' => 522,
                'icon' => '/store/1/default_images/trend_categories_icons/connection.png',
                'color' => 'rgba(32, 80, 117, 0.1)',
            ],
            [
                'id' => 6,
                'category_id' => 524,
                'icon' => '/store/1/default_images/trend_categories_icons/palette.png',
                'color' => 'rgba(11, 57, 84, 0.5)',
            ],
        ];

        TrendCategory::truncate();

        foreach ($data as $item) {
        TrendCategory::create($item);
        }
    }
}
