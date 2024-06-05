<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Permission::updateOrCreate(['id' => 20801], ['role_id' => 2, 'section_id' => 3075, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 20802], ['role_id' => 2, 'section_id' => 3076, 'allow' => 1]);
        \App\Models\Permission::updateOrCreate(['id' => 20803], ['role_id' => 2, 'section_id' => 3077, 'allow' => 1]);
    }
}
