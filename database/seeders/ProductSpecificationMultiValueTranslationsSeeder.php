<?php

namespace Database\Seeders;

use App\Models\Translation\ProductSpecificationMultiValueTranslation;
use Illuminate\Database\Seeder;

class ProductSpecificationMultiValueTranslationsSeeder extends Seeder
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
                'product_specification_multi_value_id' => 1,
                'locale' => 'id',
                'title' => 'Kecil',
            ],
            [
                'product_specification_multi_value_id' => 2,
                'locale' => 'id',
                'title' => 'Sedang',
            ],
            [
                'product_specification_multi_value_id' => 3,
                'locale' => 'id',
                'title' => 'Besar',
            ],
            [
                'product_specification_multi_value_id' => 4,
                'locale' => 'id',
                'title' => 'Dasar',
            ],
            [
                'product_specification_multi_value_id' => 5,
                'locale' => 'id',
                'title' => 'Lanjutan',
            ],
            [
                'product_specification_multi_value_id' => 6,
                'locale' => 'id',
                'title' => '3-5',
            ],
            [
                'product_specification_multi_value_id' => 7,
                'locale' => 'id',
                'title' => '5-8',
            ],
            [
                'product_specification_multi_value_id' => 8,
                'locale' => 'id',
                'title' => '8-13',
            ],
            [
                'product_specification_multi_value_id' => 9,
                'locale' => 'id',
                'title' => '13-18',
            ],
            [
                'product_specification_multi_value_id' => 10,
                'locale' => 'id',
                'title' => '+18',
            ],
            [
                'product_specification_multi_value_id' => 11,
                'locale' => 'id',
                'title' => 'Novel',
            ],
            [
                'product_specification_multi_value_id' => 12,
                'locale' => 'id',
                'title' => 'Pembelajaran Bahasa',
            ],
            [
                'product_specification_multi_value_id' => 13,
                'locale' => 'id',
                'title' => 'Ilmiah',
            ],
            [
                'product_specification_multi_value_id' => 14,
                'locale' => 'id',
                'title' => 'Sastra',
            ],
        ];

        foreach ($data as $item) {
            ProductSpecificationMultiValueTranslation::updateOrCreate(
                ['product_specification_multi_value_id' => $item['product_specification_multi_value_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
