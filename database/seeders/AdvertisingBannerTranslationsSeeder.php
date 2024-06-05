<?php

namespace Database\Seeders;

use App\Models\Translation\AdvertisingBannerTranslation;
use Illuminate\Database\Seeder;

class AdvertisingBannerTranslationsSeeder extends Seeder
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
                'advertising_banner_id' => 2,
                'locale' => 'id',
                'title' => 'Beranda - Bergabung sebagai instruktur',
                'image' => '/store/1/default_images/banners/become_instructor_banner.png',
            ],
            [
                'advertising_banner_id' => 3,
                'locale' => 'id',
                'title' => 'Validasi Sertifikat - Beranda',
                'image' => '/store/1/default_images/banners/validate_certificates_banner.png',
            ],
            [
                'advertising_banner_id' => 4,
                'locale' => 'id',
                'title' => 'Reservasi Pertemuan - Beranda',
                'image' => '/store/1/default_images/banners/reserve_a_meeting.png',
            ],
            [
                'advertising_banner_id' => 6,
                'locale' => 'id',
                'title' => 'Reservasi Pertemuan - Halaman Kursus',
                'image' => '/store/1/default_images/banners/reserve_a_meeting.png',
            ],
            [
                'advertising_banner_id' => 7,
                'locale' => 'id',
                'title' => 'Validasi Sertifikat - Halaman Kursus',
                'image' => '/store/1/default_images/banners/validate_certificates_banner.png',
            ],
            [
                'advertising_banner_id' => 8,
                'locale' => 'id',
                'title' => 'Toko - Halaman Produk',
                'image' => '/store/1/default_images/banners/store_en.png',
            ],
            [
                'advertising_banner_id' => 9,
                'locale' => 'id',
                'title' => 'Paket Kursus - Sidebar',
                'image' => '/store/1/default_images/banners/bundle_en.png',
            ],
        ];

        foreach ($data as $item) {
            AdvertisingBannerTranslation::updateOrCreate(
                ['advertising_banner_id' => $item['advertising_banner_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
