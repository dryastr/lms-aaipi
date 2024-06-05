<?php

namespace Database\Seeders;

use App\Models\Translation\UpcomingCourseTranslation;
use Illuminate\Database\Seeder;

class UpcomingCourseTranslationSeeder extends Seeder
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
                'id' => 3,
                'upcoming_course_id' => 3,
                'locale' => 'id',
                'title' => 'Flowchart Adalah: Fungsi, Jenis, Simbol, dan Contohnya',
                'seo_description' => 'Kursus ini ditujukan untuk pemula mutlak dalam pemrograman atau dalam bahasa pemrograman Python',
                'description' => '<p>Flowchart atau bagan alur adalah diagram yang menampilkan langkah-langkah dan keputusan untuk melakukan sebuah proses dari suatu program. Setiap langkah digambarkan dalam bentuk diagram dan dihubungkan dengan garis atau arah panah.</p><p>Flowchart berperan penting dalam memutuskan sebuah langkah atau fungsionalitas dari sebuah proyek pembuatan program yang melibatkan banyak orang sekaligus. Selain itu dengan menggunakan bagan alur proses dari sebuah program akan lebih jelas, ringkas, dan mengurangi kemungkinan untuk salah penafsiran. Penggunaan flowchart dalam dunia pemrograman juga merupakan cara yang bagus untuk menghubungkan antara kebutuhan teknis dan non-teknis.</p>',
            ],
            [
                'id' => 4,
                'upcoming_course_id' => 4,
                'locale' => 'id',
                'title' => 'Front-End Developer: Pengertian, Tugas, dan Cara Kerja',
                'seo_description' => 'Pelajari cara mengambil foto-foto menakjubkan dengan menguasai sisi teknis dan kreatif fotografi digital.',
                'description' => '<p>Front-End Developer merupakan bagian dari pengembang website yang bertugas untuk menentukan dan membuat tampilan menarik pada website. Front-End bertanggung jawab pada pengelolaan desain murni sehingga website menjadi lebih interaktif dengan pengguna.</p><p>Selain Front-End Developer, pengembangan website juga terdiri dari back end developer dan UI/UX Designer. Ketiganya bekerja sama untuk membuat dan membangun sebuah website yang dapat diandalkan dan menarik.</p><p>Seorang Front-End pengembangan website harus bisa memastikan dengan baik tampilan website dari segi fungsional maupun estetikanya.</p>',
            ],
            [
                'id' => 5,
                'upcoming_course_id' => 5,
                'locale' => 'id',
                'title' => 'Backend Developer: Pengertian, Tugas, Skill dan Gajinya',
                'seo_description' => 'Luncurkan karir sebagai desainer web dengan mempelajari HTML5, CSS3, desain responsif, Sass, dan banyak lagi!',
                'description' => '<p>Backend Developer atau Back End Developer adalah tim dari web developer yang memiliki tugas khusus untuk pengelolaan server, aplikasi serta database sehingga semua bisa berjalan dengan lancar.</p><p>Backend developer bisa juga disebut server side atau backend engineer.</p><p>Developer memiliki peranan penting dalam suatu website, mereka ini lebih banyak bekerja pada balik layar.</p>',
            ],
        ];

        foreach ($data as $item) {
            UpcomingCourseTranslation::updateOrCreate(
                ['id' => $item['id'], 'upcoming_course_id' => $item['upcoming_course_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
