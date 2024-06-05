<?php

namespace Database\Seeders;

use App\Models\Translation\OfflineBankSpecificationTranslation;
use Illuminate\Database\Seeder;

class OfflineBankSpecificationTranslationSeeder extends Seeder
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
                'offline_bank_specification_id' => 17,
                'locale' => 'id',
                'name' => 'Kartu Identitas',
            ],
            [
                'offline_bank_specification_id' => 18,
                'locale' => 'id',
                'name' => 'ID Akun',
            ],
            [
                'offline_bank_specification_id' => 19,
                'locale' => 'id',
                'name' => 'IBAN',
            ],
            [
                'offline_bank_specification_id' => 20,
                'locale' => 'id',
                'name' => 'Pemegang Akun',
            ],
            [
                'offline_bank_specification_id' => 21,
                'locale' => 'id',
                'name' => 'IBAN',
            ],
            [
                'offline_bank_specification_id' => 22,
                'locale' => 'id',
                'name' => 'Nomor Kartu',
            ],
            [
                'offline_bank_specification_id' => 23,
                'locale' => 'id',
                'name' => 'Nomor Kartu',
            ],
            [
                'offline_bank_specification_id' => 24,
                'locale' => 'id',
                'name' => 'ID Akun',
            ],
            [
                'offline_bank_specification_id' => 25,
                'locale' => 'id',
                'name' => 'IBAN',
            ],
        ];

        foreach ($data as $item) {
            OfflineBankSpecificationTranslation::updateOrCreate(
                ['offline_bank_specification_id' => $item['offline_bank_specification_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
