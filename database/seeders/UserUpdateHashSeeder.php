<?php

namespace Database\Seeders;

use App\Helpers\AaipiHasher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan import untuk DB

class UserUpdateHashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hashedPassword = app(AaipiHasher::class)->make('password');

        // Simpan atau update data ke dalam database
        DB::table('users')->update(['password' => $hashedPassword]);
    }
}
