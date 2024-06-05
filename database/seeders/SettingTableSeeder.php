<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
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
                'id' => 67,
                'page' => 'other',
                'name' => 'url_member_area',
            ],
        ];

        foreach ($data as $item) {
            Setting::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }
    }
}
