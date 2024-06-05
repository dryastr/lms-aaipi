<?php

namespace Database\Seeders;

use App\Models\Translation\QuizTranslation;
use Illuminate\Database\Seeder;

class QuizTranslationsSeeder extends Seeder
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
                'quiz_id' => 28,
                'locale' => 'id',
                'title' => 'Kuis Dasar',
            ],
            [
                'id' => 2,
                'quiz_id' => 30,
                'locale' => 'id',
                'title' => 'Kuis Pertama',
            ],
            [
                'id' => 3,
                'quiz_id' => 31,
                'locale' => 'id',
                'title' => 'Kuis Penempatan',
            ],
            [
                'id' => 4,
                'quiz_id' => 32,
                'locale' => 'id',
                'title' => 'Kuis Paruh Waktu',
            ],
            [
                'id' => 5,
                'quiz_id' => 33,
                'locale' => 'id',
                'title' => 'Kuis Paruh Waktu',
            ],
            [
                'id' => 6,
                'quiz_id' => 34,
                'locale' => 'id',
                'title' => 'Kuis Akhir',
            ],
            [
                'id' => 7,
                'quiz_id' => 35,
                'locale' => 'id',
                'title' => 'Kuis Masuk',
            ],
            [
                'id' => 8,
                'quiz_id' => 36,
                'locale' => 'id',
                'title' => 'Waktu Kuis',
            ],
        ];

        foreach ($data as $item) {
            QuizTranslation::updateOrCreate(
                ['id' => $item['id'], 'quiz_id' => $item['quiz_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
