<?php

namespace Database\Seeders;

use App\Models\Translation\SubscribeTranslation;
use Illuminate\Database\Seeder;

class SubscribeTranslationSeeder extends Seeder
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
                'subscribe_id' => 3,
                'locale' => 'id',
                'title' => 'Bronze',
                'description' => 'Disarankan untuk penggunaan pribadi',
            ],
            [
                'id' => 2,
                'subscribe_id' => 4,
                'locale' => 'id',
                'title' => 'Gold',
                'description' => 'Disarankan untuk bisnis besar',
            ],
            [
                'id' => 3,
                'subscribe_id' => 5,
                'locale' => 'id',
                'title' => 'Silver',
                'description' => 'Disarankan untuk bisnis kecil',
            ],
        ];

        foreach ($data as $item) {
            SubscribeTranslation::updateOrCreate(
                ['id' => $item['id'], 'subscribe_id' => $item['subscribe_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
