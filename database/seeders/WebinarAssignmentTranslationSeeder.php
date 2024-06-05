<?php

namespace Database\Seeders;

use App\Models\Translation\WebinarAssignmentTranslation;
use Illuminate\Database\Seeder;

class WebinarAssignmentTranslationSeeder extends Seeder
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
                'locale' => 'id',
                'webinar_assignment_id' => 1,
                'title' => 'Tugas Peserta',
                'description' => 'Tugas rumah, atau tugas yang diberikan, adalah serangkaian tugas yang diberikan kepada siswa oleh guru mereka untuk diselesaikan di luar kelas. Efek dari tugas rumah diperdebatkan. Secara umum, tugas rumah tidak meningkatkan kinerja akademik di kalangan anak-anak muda. Tugas rumah mungkin meningkatkan keterampilan akademik di kalangan siswa yang lebih tua, terutama siswa yang kurang berprestasi. Namun, tugas rumah juga menciptakan stres bagi siswa dan orang tua serta mengurangi waktu yang dapat dihabiskan siswa untuk kegiatan lain. Silakan kirimkan tugas Anda dalam batas waktu yang ditentukan.',
            ],
            [
                'id' => 2,
                'locale' => 'id',
                'webinar_assignment_id' => 2,
                'title' => 'Tugas Pertengahan Semester',
                'description' => 'Tugas rumah untuk menguji pemahaman Anda tentang CSS dan meyakinkan diri sendiri bahwa Anda bisa melakukannya! Silakan kirimkan tugas Anda sesegera mungkin. Salam.',
            ],
        ];

        foreach ($data as $item) {
            WebinarAssignmentTranslation::updateOrCreate(
                ['id' => $item['id'], 'locale' => $item['locale'], 'webinar_assignment_id' => $item['webinar_assignment_id']],
                $item
            );
        }
    }
}
