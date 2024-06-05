<?php

namespace Database\Seeders;

use App\Models\Translation\ProductSpecificationTranslation;
use Illuminate\Database\Seeder;

class ProductSpecificationTranslationsSeeder extends Seeder
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
                'product_specification_id' => 1,
                'locale' => 'id',
                'title' => 'Ukuran',
            ],
            [
                'product_specification_id' => 2,
                'locale' => 'id',
                'title' => 'Tingkat Keterampilan',
            ],
            [
                'product_specification_id' => 3,
                'locale' => 'id',
                'title' => 'Rentang Usia',
            ],
            [
                'product_specification_id' => 4,
                'locale' => 'id',
                'title' => 'Fitur Utama',
            ],
            [
                'product_specification_id' => 5,
                'locale' => 'id',
                'title' => 'Tipe E-book',
            ],
        ];

        foreach ($data as $item) {
            ProductSpecificationTranslation::updateOrCreate(
                ['product_specification_id' => $item['product_specification_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
