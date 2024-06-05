<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
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
                'id' => 2,
                'name' => 'featured_classes',
                'order' => 1,
            ],
            [
                'id' => 4,
                'name' => 'best_rates',
                'order' => 3,
            ],
            [
                'id' => 5,
                'name' => 'best_sellers',
                'order' => 5,
            ],
            [
                'id' => 6,
                'name' => 'free_classes',
                'order' => 6,
            ],
            [
                'id' => 7,
                'name' => 'trend_categories',
                'order' => 4,
            ],
            [
                'id' => 8,
                'name' => 'full_advertising_banner',
                'order' => 7,
            ],
            [
                'id' => 9,
                'name' => 'discount_classes',
                'order' => 8,
            ],
            [
                'id' => 10,
                'name' => 'store_products',
                'order' => 9,
            ],
            [
                'id' => 11,
                'name' => 'subscribes',
                'order' => 10,
            ],
            [
                'id' => 12,
                'name' => 'become_instructor',
                'order' => 11,
            ],
            [
                'id' => 13,
                'name' => 'forum_section',
                'order' => 12,
            ],
            [
                'id' => 14,
                'name' => 'find_instructors',
                'order' => 13,
            ],
            [
                'id' => 15,
                'name' => 'reward_program',
                'order' => 15,
            ],
            [
                'id' => 16,
                'name' => 'instructors',
                'order' => 16,
            ],
            [
                'id' => 17,
                'name' => 'video_or_image_section',
                'order' => 14,
            ],
            [
                'id' => 19,
                'name' => 'half_advertising_banner',
                'order' => 17,
            ],
            [
                'id' => 20,
                'name' => 'organizations',
                'order' => 18,
            ],
            [
                'id' => 21,
                'name' => 'blog',
                'order' => 19,
            ],
            [
                'id' => 31,
                'name' => 'upcoming_courses',
                'order' => 2,
            ],
            [
                'id' => 32,
                'name' => 'testimonials',
                'order' => 20,
            ],
            [
                'id' => 34,
                'name' => 'iklan_banner',
                'order' => 22,
            ],
        ];

        foreach ($data as $item) {
            HomeSection::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
