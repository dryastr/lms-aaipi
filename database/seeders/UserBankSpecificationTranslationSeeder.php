<?php

namespace Database\Seeders;

use App\Models\Translation\UserBankSpecificationTranslation;
use Illuminate\Database\Seeder;

class UserBankSpecificationTranslationSeeder extends Seeder
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
                'id' => 15,
                'user_bank_specification_id' => 10,
                'locale' => 'id',
                'name' => 'Pemegang Akun',
            ],
            [
                'id' => 16,
                'user_bank_specification_id' => 11,
                'locale' => 'id',
                'name' => 'Email',
            ],
            [
                'id' => 17,
                'user_bank_specification_id' => 12,
                'locale' => 'id',
                'name' => 'Pemegang Akun',
            ],
            [
                'id' => 18,
                'user_bank_specification_id' => 13,
                'locale' => 'id',
                'name' => 'ID Akun',
            ],
        ];

        foreach ($data as $item) {
            UserBankSpecificationTranslation::updateOrCreate(
                ['id' => $item['id'], 'user_bank_specification_id' => $item['user_bank_specification_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
