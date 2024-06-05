<?php

namespace Database\Seeders;

use App\Models\Translation\ProductCategoryTranslation;
use Illuminate\Database\Seeder;

class ProductCategoryTranslationsSeeder extends Seeder
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
                'product_category_id' => 1,
                'locale' => 'id',
                'title' => 'Alat Desain',
            ],
            [
                'product_category_id' => 2,
                'locale' => 'id',
                'title' => 'Alat Sains',
            ],
            [
                'product_category_id' => 3,
                'locale' => 'id',
                'title' => 'e-book',
            ],
        ];

        foreach ($data as $item) {
            ProductCategoryTranslation::updateOrCreate(
                ['product_category_id' => $item['product_category_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
