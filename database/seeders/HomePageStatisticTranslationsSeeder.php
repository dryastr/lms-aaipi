<?php

namespace Database\Seeders;

use App\Models\Translation\HomePageStatisticTranslation;
use Illuminate\Database\Seeder;

class HomePageStatisticTranslationsSeeder extends Seeder
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
                'home_page_statistic_id' => 2,
                'locale' => 'id',
                'title' => 'Instruktur Terampil',
                'description' => 'Mulailah belajar dari instruktur berpengalaman.',
            ],
            [
                'home_page_statistic_id' => 3,
                'locale' => 'id',
                'title' => 'Kursus Video',
                'description' => 'Belajar tanpa batasan geografis & waktu.',
            ],
            [
                'home_page_statistic_id' => 4,
                'locale' => 'id',
                'title' => 'Kelas Langsung',
                'description' => 'Tingkatkan keterampilan Anda menggunakan aliran pengetahuan langsung.',
            ],
            [
                'home_page_statistic_id' => 5,
                'locale' => 'id',
                'title' => 'Peserta Bahagia',
                'description' => 'tersedia untuk membantu Anda dengan pengetahuan mereka',
            ],
        ];

        foreach ($data as $item) {
            HomePageStatisticTranslation::updateOrCreate(
                ['home_page_statistic_id' => $item['home_page_statistic_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
