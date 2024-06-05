<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class makeForumImage extends Seeder
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
                'icon' => '/store/1/default_images/forums/icons/mekeup_new.png',
            ],
            [
                'id' => 5,
                'icon' => '/store/1/default_images/forums/icons/love-song-new.png',
            ],
            [
                'id' => 6,
                'icon' => '/store/1/default_images/forums/icons/advertising_new.png',
            ],
        ];
        foreach ($data as $record) {
            DB::table('forums')->where('id', $record['id'])->update(['icon' => $record['icon']]);
        }
    }
}
