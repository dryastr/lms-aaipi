<?php

namespace Database\Seeders;

use App\Models\Translation\InstallmentTranslation;
use Illuminate\Database\Seeder;

class InstallmentTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstallmentTranslation::updateOrCreate([
            'id' => 1,
            'installment_id' => 1,
            'locale' => 'id',
        ], [
            'title' => 'Pelan pembayaran Natal',
            'main_title' => 'Pembayaran Cicilan di Hari Natal',
            'description' => 'Beli kursus Anda secara cicilan.',
            'banner' => '/store/1/default_images/Installments/installment_banner.png',
            'options' => 'Akses instan ke file kursus88889 durasi pembayaran bulan8888Tidak ada perbedaan harga dengan pembayaran tunai8888Dapatkan poin setelah menyelesaikan cicilan',
            'verification_description' => '<p>Untuk menggunakan rencana pembayaran ini, Anda harus melampirkan foto kartu identitas dan laporan rekening bank Anda selama 3 bulan terakhir.</p><p>Kami akan mencoba meninjau permintaan Anda secepat mungkin.</p>',
            'verification_banner' => '/store/1/default_images/Installments/verification_image.png',
        ]);
    }
}
