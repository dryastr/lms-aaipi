<?php

namespace Database\Seeders;

use App\Models\Translation\BadgeTranslation;
use Illuminate\Database\Seeder;

class BadgeTranslationsSeeder extends Seeder
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
                'badge_id' => 21,
                'locale' => 'id',
                'title' => 'Pengguna Baru',
                'description' => '1 Bulan Keanggotaan',
            ],
            [
                'badge_id' => 22,
                'locale' => 'id',
                'title' => 'Pengguna Setia',
                'description' => '1 Tahun Keanggotaan',
            ],
            [
                'badge_id' => 23,
                'locale' => 'id',
                'title' => 'Pengguna Setia',
                'description' => 'Keanggotaan Lama',
            ],
            [
                'badge_id' => 24,
                'locale' => 'id',
                'title' => 'Vendor Junior',
                'description' => 'Memiliki 1 Kelas',
            ],
            [
                'badge_id' => 25,
                'locale' => 'id',
                'title' => 'Vendor Senior',
                'description' => 'Memiliki 2 Kelas',
            ],
            [
                'badge_id' => 26,
                'locale' => 'id',
                'title' => 'Vendor Ahli',
                'description' => 'Memiliki 3 hingga 6 Kelas',
            ],
            [
                'badge_id' => 27,
                'locale' => 'id',
                'title' => 'Kelas Perunggu',
                'description' => 'Rating Kelas dari 2 hingga 3',
            ],
            [
                'badge_id' => 28,
                'locale' => 'id',
                'title' => 'Kelas Perak',
                'description' => 'Rating Kelas dari 3 hingga 4',
            ],
            [
                'badge_id' => 29,
                'locale' => 'id',
                'title' => 'Kelas Emas',
                'description' => 'Rating Kelas dari 4 hingga 5',
            ],
            [
                'badge_id' => 30,
                'locale' => 'id',
                'title' => 'Penjual Terbaik',
                'description' => 'Penjualan Kelas dari 1 hingga 2',
            ],
            [
                'badge_id' => 31,
                'locale' => 'id',
                'title' => 'Penjual Teratas',
                'description' => 'Penjualan Kelas dari 3 hingga 9',
            ],
            [
                'badge_id' => 32,
                'locale' => 'id',
                'title' => 'Raja Penjual',
                'description' => 'Penjualan Kelas dari 10 hingga 20',
            ],
            [
                'badge_id' => 33,
                'locale' => 'id',
                'title' => 'Dukungan Baik',
                'description' => 'Rating Dukungan dari 2 hingga 3',
            ],
            [
                'badge_id' => 34,
                'locale' => 'id',
                'title' => 'Dukungan Luar Biasa',
                'description' => 'Rating Dukungan dari 3 hingga 4',
            ],
            [
                'badge_id' => 35,
                'locale' => 'id',
                'title' => 'Dukungan Fantastis',
                'description' => 'Rating Dukungan dari 4 hingga 5',
            ],
            [
                'badge_id' => 36,
                'locale' => 'id',
                'title' => 'Penjual Terbaik Toko',
                'description' => 'Penjualan Produk Toko dari 1 hingga 5',
            ],
            [
                'badge_id' => 37,
                'locale' => 'id',
                'title' => 'Raja Penjual Toko',
                'description' => 'Penjualan Produk Toko dari 6 hingga 15',
            ],
            [
                'badge_id' => 38,
                'locale' => 'id',
                'title' => 'Pengguna Teratas Forum',
                'description' => 'Memiliki 2 hingga 5 Topik',
            ],
            [
                'badge_id' => 39,
                'locale' => 'id',
                'title' => 'Pengguna Terbaik Forum',
                'description' => 'Memiliki 6 hingga 10 Topik',
            ],
            [
                'badge_id' => 40,
                'locale' => 'id',
                'title' => 'Penulis Setia',
                'description' => 'Memiliki 5 hingga 10 Artikel',
            ],
            [
                'badge_id' => 41,
                'locale' => 'id',
                'title' => 'Pengguna Setia Forum',
                'description' => 'Memiliki 20 hingga 30 Posting di Forum',
            ],
        ];

        foreach ($data as $item) {
            BadgeTranslation::updateOrCreate(
                ['badge_id' => $item['badge_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
