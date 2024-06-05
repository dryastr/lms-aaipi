<?php

namespace Database\Seeders;

use App\Models\Translation\NavbarButtonTranslation;
use Illuminate\Database\Seeder;

class NavbarButtonTranslationsSeeder extends Seeder
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
                'navbar_button_id' => 1,
                'locale' => 'id',
                'title' => 'Daftar Kontributor',
                'url' => '/become-instructor',
            ],
            [
                'navbar_button_id' => 2,
                'locale' => 'id',
                'title' => 'Admin panel',
                'url' => '/admin',
            ],
            [
                'navbar_button_id' => 3,
                'locale' => 'id',
                'title' => 'Buat kursus',
                'url' => '/panel/webinars/new',
            ],
            [
                'navbar_button_id' => 4,
                'locale' => 'id',
                'title' => 'Buat kursus',
                'url' => '/panel/webinars/new',
            ],
            [
                'navbar_button_id' => 6,
                'locale' => 'id',
                'title' => 'Registrasi',
                'url' => '/register',
            ],
        ];

        foreach ($data as $item) {
            NavbarButtonTranslation::updateOrCreate(
                ['navbar_button_id' => $item['navbar_button_id'], 'locale' => $item['locale']],
                ['title' => $item['title'], 'url' => $item['url']]
            );
        }
    }
}
