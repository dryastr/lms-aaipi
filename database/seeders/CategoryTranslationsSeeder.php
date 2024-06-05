<?php

namespace Database\Seeders;

use App\Models\Translation\CategoryTranslation;
use Illuminate\Database\Seeder;

class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translations = [
            [
                'category_id' => 520,
                'locale' => 'id',
                'title' => 'Desain',
            ],
            [
                'category_id' => 522,
                'locale' => 'id',
                'title' => 'Akademik',
            ],
            [
                'category_id' => 523,
                'locale' => 'id',
                'title' => 'Kesehatan & Kebugaran',
            ],
            [
                'category_id' => 524,
                'locale' => 'id',
                'title' => 'Gaya Hidup',
            ],
            [
                'category_id' => 525,
                'locale' => 'id',
                'title' => 'Pemasaran',
            ],
            [
                'category_id' => 526,
                'locale' => 'id',
                'title' => 'Bisnis',
            ],
            [
                'category_id' => 528,
                'locale' => 'id',
                'title' => 'Pengembangan',
            ],
            [
                'category_id' => 601,
                'locale' => 'id',
                'title' => 'Matematika',
            ],
            [
                'category_id' => 602,
                'locale' => 'id',
                'title' => 'Ilmu Pengetahuan',
            ],
            [
                'category_id' => 603,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'category_id' => 604,
                'locale' => 'id',
                'title' => 'Gaya Hidup',
            ],
            [
                'category_id' => 605,
                'locale' => 'id',
                'title' => 'Kecantikan & Tata Rias',
            ],
            [
                'category_id' => 606,
                'locale' => 'id',
                'title' => 'Pengembangan Web',
            ],
            [
                'category_id' => 607,
                'locale' => 'id',
                'title' => 'Pengembangan Mobile',
            ],
            [
                'category_id' => 608,
                'locale' => 'id',
                'title' => 'Pengembangan Game',
            ],
            [
                'category_id' => 609,
                'locale' => 'id',
                'title' => 'Manajemen',
            ],
            [
                'category_id' => 610,
                'locale' => 'id',
                'title' => 'Komunikasi',
            ],
            [
                'category_id' => 611,
                'locale' => 'id',
                'title' => 'Strategi Bisnis',
            ],
        ];

        foreach ($translations as $translation) {
            CategoryTranslation::updateOrCreate(
                ['category_id' => $translation['category_id'], 'locale' => $translation['locale']],
                ['title' => $translation['title']]
            );
        }
    }
}
