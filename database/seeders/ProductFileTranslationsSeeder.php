<?php

namespace Database\Seeders;

use App\Models\Translation\ProductFileTranslation;
use Illuminate\Database\Seeder;

class ProductFileTranslationsSeeder extends Seeder
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
                'product_file_id' => 2,
                'locale' => 'id',
                'title' => 'eBook Sherlock Holmes',
                'description' => 'Sherlock Holmes adalah seorang detektif fiksi yang diciptakan oleh penulis Inggris Sir Arthur Conan Doyle. Merujuk pada dirinya sendiri sebagai "detektif konsultan" dalam cerita-cerita tersebut, Holmes dikenal karena keahliannya dalam observasi, deduksi, ilmu forensik, dan penalaran logis yang hampir fantastis, yang digunakannya saat menyelidiki kasus-kasus untuk berbagai klien, termasuk Scotland Yard.',
            ],
            [
                'product_file_id' => 3,
                'locale' => 'id',
                'title' => 'File Setup',
                'description' => 'Perangkat lunak bisnis adalah perangkat lunak atau kumpulan program komputer yang digunakan oleh pengguna bisnis untuk melakukan berbagai fungsi bisnis. Aplikasi bisnis ini digunakan untuk meningkatkan produktivitas, mengukur produktivitas, dan melakukan fungsi bisnis lainnya secara akurat.',
            ],
            [
                'product_file_id' => 4,
                'locale' => 'id',
                'title' => 'Dokumentasi',
                'description' => 'Dokumentasi untuk perangkat lunak bisnis.',
            ],
            [
                'product_file_id' => 5,
                'locale' => 'id',
                'title' => 'eBook Where the Crawdads Sing',
                'description' => 'Where the Crawdads Sing sekaligus adalah pujian yang sangat indah kepada alam, kisah sedih tentang tumbuh dewasa, dan kisah mengejutkan tentang kemungkinan pembunuhan. Owens mengingatkan kita bahwa kita selalu dibentuk oleh anak-anak yang pernah kita miliki, dan bahwa kita semua tunduk pada rahasia yang indah dan kekerasan yang alam simpan.',
            ],
        ];

        foreach ($data as $item) {
            ProductFileTranslation::updateOrCreate(
                ['product_file_id' => $item['product_file_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
