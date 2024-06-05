<?php

namespace Database\Seeders;

use App\Models\Translation\RegistrationPackageTranslation;
use Illuminate\Database\Seeder;

class RegistrationPackageTranslationsSeeder extends Seeder
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
                'registration_package_id' => 1,
                'locale' => 'id',
                'title' => 'Dasar',
                'description' => 'Disarankan untuk instruktur pemula.',
            ],
            [
                'id' => 2,
                'registration_package_id' => 2,
                'locale' => 'id',
                'title' => 'Pro',
                'description' => 'Disarankan untuk instruktur profesional.',
            ],
            [
                'id' => 3,
                'registration_package_id' => 3,
                'locale' => 'id',
                'title' => 'Premium',
                'description' => 'Disarankan untuk instruktur ahli.',
            ],
            [
                'id' => 4,
                'registration_package_id' => 4,
                'locale' => 'id',
                'title' => 'Dasar',
                'description' => 'Disarankan untuk organisasi kecil.',
            ],
            [
                'id' => 5,
                'registration_package_id' => 5,
                'locale' => 'id',
                'title' => 'Pro',
                'description' => 'Disarankan untuk organisasi menengah.',
            ],
            [
                'id' => 6,
                'registration_package_id' => 6,
                'locale' => 'id',
                'title' => 'Premium',
                'description' => 'Disarankan untuk organisasi besar.',
            ],
        ];

        foreach ($data as $item) {
            RegistrationPackageTranslation::updateOrCreate(
                ['id' => $item['id'], 'registration_package_id' => $item['registration_package_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
