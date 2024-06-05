<?php

namespace Database\Seeders;

use App\Models\Translation\ProductFilterTranslation;
use Illuminate\Database\Seeder;

class ProductFilterTranslationsSeeder extends Seeder
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
                'product_filter_id' => 1,
                'locale' => 'id',
                'title' => 'Alat Lukis',
            ],
            [
                'product_filter_id' => 2,
                'locale' => 'id',
                'title' => 'Tipe',
            ],
        ];

        foreach ($data as $item) {
            ProductFilterTranslation::updateOrCreate(
                ['product_filter_id' => $item['product_filter_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
