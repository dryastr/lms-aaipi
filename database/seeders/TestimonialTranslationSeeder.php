<?php

namespace Database\Seeders;

use App\Models\Translation\TestimonialTranslation;
use Illuminate\Database\Seeder;

class TestimonialTranslationSeeder extends Seeder
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
                'testimonial_id' => 2,
                'locale' => 'id',
                'user_name' => 'Ryan Newman',
                'user_bio' => 'Analisis Data di Microsoft',
                'comment' => 'Kami telah menggunakan Rocket LMS selama 2 tahun terakhir. Terima kasih atas layanan yang luar biasa.',
            ],
            [
                'id' => 2,
                'testimonial_id' => 3,
                'locale' => 'id',
                'user_name' => 'Megan Hayward',
                'user_bio' => 'Administrator Sistem di Amazon',
                'comment' => 'Kami sangat menyukainya. Rocket LMS sempurna dan sangat dapat disesuaikan.',
            ],
            [
                'id' => 3,
                'testimonial_id' => 4,
                'locale' => 'id',
                'user_name' => 'Natasha Hope',
                'user_bio' => 'Teknisi IT di IBM',
                'comment' => 'Saya sangat puas dengan Rocket LMS saya. Ini adalah solusi yang sempurna untuk bisnis kami.',
            ],
            [
                'id' => 4,
                'testimonial_id' => 5,
                'locale' => 'id',
                'user_name' => 'Charles Dale',
                'user_bio' => 'Insinyur Komputer di Oracle',
                'comment' => 'Saya sangat puas dengan produk ini. Saya tidak bisa meminta lebih dari ini.',
            ],
            [
                'id' => 5,
                'testimonial_id' => 6,
                'locale' => 'id',
                'user_name' => 'David Patterson',
                'user_bio' => 'Teknisi Jaringan di Cisco',
                'comment' => 'Rocket LMS mengesankan saya di beberapa tingkatan.',
            ],
        ];

        foreach ($data as $item) {
            TestimonialTranslation::updateOrCreate(
                ['id' => $item['id'], 'testimonial_id' => $item['testimonial_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
