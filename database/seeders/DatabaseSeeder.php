<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SectionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(HomeSectionSeeder::class);
        $this->call(SettingTranslationsTableSeeder::class);
        $this->call(UserUpdateHashSeeder::class);
    }
}
