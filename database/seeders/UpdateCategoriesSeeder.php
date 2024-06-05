<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class UpdateCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $data = [
                [
                    'id' => 522,
                    'slug' => 'Academics',
                    'parent_id' => null,
                    'icon' => '/store/1/default_images/categories_icons/feather.png',
                    'order' => 1
                ],
                [
                    'id' => 523,
                    'slug' => 'Manajemen Pengawasan Intern',
                    'parent_id' => null,
                    'icon' => '/store/1/default_images/categories_icons/heart.png',
                    'order' => 5
                ],
                [
                    'id' => 524,
                    'slug' => 'Manajemen Pengawasan Intern',
                    'parent_id' => null,
                    'icon' => '/store/1/default_images/categories_icons/umbrella.png',
                    'order' => 4
                ],
                [
                    'id' => 525,
                    'slug' => 'Marketing',
                    'parent_id' => null,
                    'icon' => '/store/1/default_images/categories_icons/umbrella.png',
                    'order' => 4
                ],
                [
                    'id' => 526,
                    'slug' => 'Pengembangan Metodologi Pengawasan',
                    'parent_id' => null,
                    'icon' => '/store/1/default_images/categories_icons/umbrella.png',
                    'order' => 4
                ],
                [
                    'id' => 528,
                    'slug' => 'Development',
                    'parent_id' => null,
                    'icon' => '/store/1/default_images/categories_icons/code.png',
                    'order' => 1
                ],
                [
                    'id' => 604,
                    'slug' => 'Analisis Proses Bisnis Mitra Pengawasan',
                    'parent_id' => 524,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/sun.png',
                    'order' => 1
                ],
                [
                    'id' => 605,
                    'slug' => 'Beauty-and-Makeup',
                    'parent_id' => 524,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/droplet.png',
                    'order' => 2
                ],
                [
                    'id' => 606,
                    'slug' => 'Web-Development',
                    'parent_id' => 528,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/layout.png',
                    'order' => 1
                ],
                [
                    'id' => 607,
                    'slug' => 'Mobile-Development',
                    'parent_id' => 528,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/smartphone.png',
                    'order' => 2
                ],
                [
                    'id' => 608,
                    'slug' => 'Game-Development',
                    'parent_id' => 528,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/codesandbox.png',
                    'order' => 3
                ],
                [
                    'id' => 609,
                    'slug' => 'Manajemen Pengawasan Intern',
                    'parent_id' => 526,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/users.png',
                    'order' => 1
                ],
                [
                    'id' => 610,
                    'slug' => 'Communications',
                    'parent_id' => 526,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/share-2.png',
                    'order' => 2
                ],
                [
                    'id' => 611,
                    'slug' => 'Pengawasan Intern',
                    'parent_id' => null,
                    'icon' => '/store/1/default_images/categories_icons/sub_categories/target.png',
                    'order' => 3
                ],
            ];
            
    
            foreach ($data as $item) {
                Category::updateOrCreate(
                    ['id' => $item['id']],
                    $item
                );
            }
    }
}
