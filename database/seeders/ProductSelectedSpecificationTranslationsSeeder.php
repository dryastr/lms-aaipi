<?php

namespace Database\Seeders;

use App\Models\Translation\ProductSelectedSpecificationTranslation;
use Illuminate\Database\Seeder;

class ProductSelectedSpecificationTranslationsSeeder extends Seeder
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
                'product_selected_specification_id' => 4,
                'locale' => 'id',
                'value' => "Model: M82EZ\r\nPembesaran total: 40X-100X-250X-400X-1000X-2500X\r\nEyepieces: widefield WF10X and WF25X\r\nObjectives: achromatic DIN 4X, 10X, 40X(S), 100X(S, Oil)\r\nKepala pengamatan: binokuler 45° miring dengan putaran 360°\r\nJarak interpupillary yang dapat disesuaikan geser: 2-3/16\" ~ 2-15/16\"(55~75mm)\r\nOcular diopter yang dapat disesuaikan pada kedua eyetubes\r\nNosepiece: quadruple yang dapat diputar\r\nStage: mekanis lapisan ganda ukuran: 4-1/2\"x 4-15/16\" (115mm x 125mm)\r\nCondenser dan diaphragm: NA1.25 Abbe condenser dengan iris diaphragm\r\nTransmitted (lower) illuminator: LED light, intensitas dapat disesuaikan\r\nPengaturan fokus: Tombol kasar dan halus koaksial di kedua sisi\r\nKomponen mekanis semua logam\r\nSumber daya: AC/DC adapter, 100V-240V (UL approved)\r\nDimensi: 9-1/16\" x 7-1/8\" x 13\" (23cm x 18cm x 33cm)\r\nBerat bersih: 7lbs 2 oz (3.25 kg)\r\nBerat paket: 4kg",
            ],
            [
                'product_selected_specification_id' => 7,
                'locale' => 'id',
                'value' => "Penerbit ‏ : ‎ Penguin Publishing Group (30 Maret 2021)\r\nBahasa ‏ : ‎ Inggris\r\nPaperback ‏ : ‎ 400 halaman\r\nISBN-10 ‏ : ‎ 0735219109\r\nISBN-13 ‏ : ‎ 978-0735219106\r\nBerat item ‏ : ‎ 11.2 ons\r\nDimensi ‏ : ‎ 5.5 x 0.79 x 8.22 inci",
            ],
        ];

        foreach ($data as $item) {
            ProductSelectedSpecificationTranslation::updateOrCreate(
                ['product_selected_specification_id' => $item['product_selected_specification_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
