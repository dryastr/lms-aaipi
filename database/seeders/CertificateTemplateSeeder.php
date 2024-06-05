<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan import untuk DB

class CertificateTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Certificate = [
            [
                'id' => 1,
                'image' => '/store/1/default_images/certificate.jpg',
                'type' => 'quiz',
                'position_x' => 0,
                'position_y' => 0,
                'font_size' => 33,
                'text_color' => '#314963',
                'status' => 'draft',
            ],
            [
                'id' => 2,
                'image' => '/store/1/default_images/certificate.jpg',
                'type' => 'course',
                'position_x' => 0,
                'position_y' => 400,
                'font_size' => 20,
                'text_color' => '#314963',
                'status' => 'publish',
            ],
            [
                'id' => 3,
                'image' => '/store/1/default_images/certificate.jpg',
                'type' => 'quiz',
                'position_x' => 0,
                'position_y' => 0,
                'font_size' => 0,
                'text_color' => '#e1e1e1',
                'status' => 'draft',
            ],
            [
                'id' => 4,
                'image' => '/store/1/default_images/certificate.jpg',
                'type' => 'quiz',
                'position_x' => 0,
                'position_y' => 0,
                'font_size' => 20,
                'text_color' => '#000',
                'status' => 'publish',
            ],
        ];

        // Simpan atau update data ke dalam database
        DB::table('certificates_templates')->insert($Certificate);
    }
}
