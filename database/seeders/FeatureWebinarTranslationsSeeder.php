<?php

namespace Database\Seeders;

use App\Models\Translation\FeatureWebinarTranslation;
use Illuminate\Database\Seeder;

class FeatureWebinarTranslationsSeeder extends Seeder
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
                'feature_webinar_id' => 26,
                'locale' => 'id',
                'description' => 'Microsoft Excel adalah sebuah spreadsheet yang dikembangkan oleh Microsoft untuk Windows, macOS, Android, dan iOS. Fitur-fiturnya mencakup perhitungan, alat grafik, tabel pivot, dan bahasa pemrograman makro yang disebut Visual Basic for Applications (VBA).',
            ],
            [
                'feature_webinar_id' => 28,
                'locale' => 'id',
                'description' => 'Pelajari langkah-demi-langkah tips yang membantu Anda menyelesaikan tugas dengan tim virtual Anda dengan meningkatkan kepercayaan dan akuntabilitas. Jika Anda mengelola tim virtual saat ini, maka Anda kemungkinan akan terus melakukannya untuk sisa karier Anda.',
            ],
        ];

        foreach ($data as $item) {
            FeatureWebinarTranslation::updateOrCreate(
                ['feature_webinar_id' => $item['feature_webinar_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
