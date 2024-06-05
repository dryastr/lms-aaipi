<?php

namespace Database\Seeders;

use App\Models\Translation\ProductFilterOptionTranslation;
use Illuminate\Database\Seeder;

class ProductFilterOptionTranslationsSeeder extends Seeder
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
                'product_filter_option_id' => 1,
                'locale' => 'id',
                'title' => 'Kuas',
            ],
            [
                'product_filter_option_id' => 2,
                'locale' => 'id',
                'title' => 'Novel',
            ],
            [
                'product_filter_option_id' => 3,
                'locale' => 'id',
                'title' => 'Pembelajaran Bahasa',
            ],
            [
                'product_filter_option_id' => 4,
                'locale' => 'id',
                'title' => 'Ilmiah',
            ],
        ];

        foreach ($data as $item) {
            ProductFilterOptionTranslation::updateOrCreate(
                ['product_filter_option_id' => $item['product_filter_option_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
