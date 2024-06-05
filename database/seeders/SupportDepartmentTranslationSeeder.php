<?php

namespace Database\Seeders;

use App\Models\Translation\SupportDepartmentTranslation;
use Illuminate\Database\Seeder;

class SupportDepartmentTranslationSeeder extends Seeder
{
    /**
     * Menjalankan seed ke basis data.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'support_department_id' => 2,
                'locale' => 'id',
                'title' => 'Keuangan',
            ],
            [
                'id' => 2,
                'support_department_id' => 3,
                'locale' => 'id',
                'title' => 'Konten',
            ],
            [
                'id' => 3,
                'support_department_id' => 4,
                'locale' => 'id',
                'title' => 'Pemasaran',
            ],
        ];

        foreach ($data as $item) {
            SupportDepartmentTranslation::updateOrCreate(
                ['id' => $item['id'], 'support_department_id' => $item['support_department_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
