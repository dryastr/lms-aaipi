<?php

namespace Database\Seeders;

use App\Models\Translation\InstallmentStepTranslation;
use Illuminate\Database\Seeder;

class InstallmentStepTranslationsSeeder extends Seeder
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
                'installment_step_id' => 1,
                'locale' => 'id',
                'title' => 'Angsuran Pertama',
            ],
            [
                'installment_step_id' => 2,
                'locale' => 'id',
                'title' => 'Angsuran Kedua',
            ],
            [
                'installment_step_id' => 3,
                'locale' => 'id',
                'title' => 'Angsuran Ketiga',
            ],
        ];

        foreach ($data as $item) {
            InstallmentStepTranslation::updateOrCreate(
                ['installment_step_id' => $item['installment_step_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
