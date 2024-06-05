<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class makeSubscribesImageSeeder extends Seeder
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
                'icon' => '/store/1/default_images/subscribe_packages/bronze_cup.png',
            ],
            [
                'id' => 4,
                'icon' => '/store/1/default_images/subscribe_packages/gold_cup.png',
            ],
            [
                'id' => 5,
                'icon' => '/store/1/default_images/subscribe_packages/silver_cup.png',
            ],
        ];
        foreach ($data as $record) {
            DB::table('subscribes')->where('id', $record['id'])->update(['icon' => $record['icon']]);
        }
    }
}
