<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class UsersPetaSeeder extends Seeder
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
                'id' => 1019,
                'province_code' => '32',
                'city_code' => '3271',
            ],
            [
                'id' => 1068,
                'province_code' => '32',
                'city_code' => '3271',
            ],
            [
                'id' => 1064,
                'province_code' => '32',
                'city_code' => '3271',
            ],
        ];

        foreach ($data as $item) {
            User::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }
    }
}
