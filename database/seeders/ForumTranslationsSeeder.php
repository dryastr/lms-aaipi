<?php

namespace Database\Seeders;

use App\Models\Translation\ForumTranslation;
use Illuminate\Database\Seeder;

class ForumTranslationsSeeder extends Seeder
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
                'forum_id' => 1,
                'locale' => 'id',
                'title' => 'Gayahidup',
                'description' => 'Gaya hidup adalah minat, pendapat, perilaku, dan orientasi perilaku seseorang, kelompok, atau budaya. Istilah ini diperkenalkan oleh psikolog Austria Alfred Adler dalam bukunya tahun 1929, The Case of Miss R., dengan arti "karakter dasar seseorang yang terbentuk pada masa kanak-kanak".',
            ],
            [
                'forum_id' => 2,
                'locale' => 'id',
                'title' => 'Kecantikan & Tata Rias',
                'description' => 'Bagaimana menciptakan perawatan kulit alami yang sempurna untuk Anda',
            ],
            [
                'forum_id' => 3,
                'locale' => 'id',
                'title' => 'Makanan & Minuman',
                'description' => 'Forum praktis untuk meningkatkan keterampilan memasak Anda dari biasa menjadi lezat',
            ],
            [
                'forum_id' => 4,
                'locale' => 'id',
                'title' => 'Perjalanan',
                'description' => 'Bagaimana Anda Dapat Membeli Hidup Bepergian dan Petualangan!',
            ],
            [
                'forum_id' => 5,
                'locale' => 'id',
                'title' => 'Musik',
                'description' => 'Diskusikan musik dengan instruktur terbaik di dunia',
            ],
            [
                'forum_id' => 6,
                'locale' => 'id',
                'title' => 'Pemasaran',
                'description' => 'Pemasaran adalah proses eksplorasi.',
            ],
            [
                'forum_id' => 7,
                'locale' => 'id',
                'title' => 'Pemasaran Digital',
                'description' => 'Kuasai Strategi Pemasaran Digital',
            ],
            [
                'forum_id' => 8,
                'locale' => 'id',
                'title' => 'Hubungan Masyarakat',
                'description' => 'Segala yang perlu Anda ketahui untuk sukses di bidang PR',
            ],
            [
                'forum_id' => 9,
                'locale' => 'id',
                'title' => 'Periklanan',
                'description' => 'Pelajari cara kerja dalam industri digital yang besar',
            ],
            [
                'forum_id' => 10,
                'locale' => 'id',
                'title' => 'Media Sosial',
                'description' => 'KUASAI pemasaran online di Twitter, Pinterest, Instagram',
            ],
        ];

        foreach ($data as $item) {
            ForumTranslation::updateOrCreate(
                ['forum_id' => $item['forum_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
