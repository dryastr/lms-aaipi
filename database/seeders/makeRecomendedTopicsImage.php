<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class makeRecomendedTopicsImage extends Seeder
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
                'icon' => '/store/1/default_images/forums/icons/dish_new.png',
            ],
            [
                'id' => 2,
                'icon' => '/store/1/default_images/forums/icons/drawing-compas-new.png',
            ],
            [
                'id' => 3,
                'icon' => '/store/1/default_images/forums/icons/target_new.png',
            ],
            [
                'id' => 4,
                'icon' => '/store/1/default_images/forums/icons/translate_new.png',
            ],
        ];
        foreach ($data as $record) {
            DB::table('forum_recommended_topics')->where('id', $record['id'])->update(['icon' => $record['icon']]);
        }
    }
}
