<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class makeFakeFeaturedTopics extends Seeder
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
                'topic_id' => 9,
                'icon' => '/store/1/default_images/forums/icons/food_forum_new.svg',
                'created_at' => 1655791906,
            ],
            [
                'topic_id' => 8,
                'icon' => '/store/1/default_images/forums/icons/forum_makeup_new.svg',
                'created_at' => 1655793090,
            ],
            [
                'topic_id' => 5,
                'icon' => '/store/1/default_images/forums/icons/forum_music_new.svg',
                'created_at' => 1655793433,
            ],
            [
                'topic_id' => 10,
                'icon' => '/store/1/default_images/forums/icons/marketing_new.svg',
                'created_at' => 1656100506,
            ],
        ];
        foreach ($data as $record) {
            DB::table('forum_featured_topics')->updateOrInsert(
                ['topic_id' => $record['topic_id']],
                $record
            );
        }
    }
}
