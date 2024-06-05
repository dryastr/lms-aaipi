<?php

namespace Database\Seeders;

use App\Models\Translation\FloatingBarTranslation;
use Illuminate\Database\Seeder;

class FloatingBarTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FloatingBarTranslation::updateOrCreate([
            'id' => 3,
            'floating_bar_id' => 2,
            'locale' => 'id',
        ], [
            'title' => 'Perayaan Tahun Baru',
            'description' => 'Dapatkan semua kursus dengan diskon 50 hingga 70% tanpa batasan apa pun',
            'btn_text' => 'Lihat Kursus',
        ]);
    }
}
