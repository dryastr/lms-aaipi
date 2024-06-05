<?php

namespace Database\Seeders;

use App\Models\Translation\PromotionTranslation;
use Illuminate\Database\Seeder;

class PromotionTranslationsSeeder extends Seeder
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
                'id' => 1,
                'promotion_id' => 2,
                'locale' => 'id',
                'title' => 'Gold',
                'description' => 'Salah satu kelas Anda akan ditampilkan di bagian atas daftar kategori dan slider beranda',
            ],
            [
                'id' => 2,
                'promotion_id' => 3,
                'locale' => 'id',
                'title' => 'Bronze',
                'description' => 'Salah satu kelas Anda akan ditampilkan di bagian atas daftar kategori',
            ],
            [
                'id' => 3,
                'promotion_id' => 4,
                'locale' => 'id',
                'title' => 'Silver',
                'description' => 'Salah satu kelas Anda akan ditampilkan di slider beranda',
            ],
        ];

        foreach ($data as $item) {
            PromotionTranslation::updateOrCreate(
                ['id' => $item['id'], 'promotion_id' => $item['promotion_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
