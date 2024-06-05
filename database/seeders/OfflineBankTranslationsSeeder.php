<?php

namespace Database\Seeders;

use App\Models\Translation\OfflineBankTranslation;
use Illuminate\Database\Seeder;

class OfflineBankTranslationsSeeder extends Seeder
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
                'offline_bank_id' => 6,
                'locale' => 'id',
                'title' => 'Bank Nasional Qatar',
            ],
            [
                'offline_bank_id' => 7,
                'locale' => 'id',
                'title' => 'JPMorgan',
            ],
            [
                'offline_bank_id' => 8,
                'locale' => 'id',
                'title' => 'Bank Negara India',
            ],
        ];

        foreach ($data as $item) {
            OfflineBankTranslation::updateOrCreate(
                ['offline_bank_id' => $item['offline_bank_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
