<?php

namespace Database\Seeders;

use App\Models\Translation\PageTranslation;
use Illuminate\Database\Seeder;

class PageTranslationsSeeder extends Seeder
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
                'page_id' => 5,
                'locale' => 'id',
                'title' => 'Syarat dan Ketentuan Layanan',
                'seo_description' => 'Misi kami adalah untuk meningkatkan kehidupan melalui pembelajaran. Kami memungkinkan siapa pun di mana pun untuk membuat dan berbagi konten pendidikan (instruktur) dan mengakses konten pendidikan tersebut untuk belajar.',
                'content' => '<p><b>Catatan: Ini hanyalah data demo.</b></p><p>Misi kami adalah untuk meningkatkan kehidupan melalui pembelajaran. Kami memungkinkan siapa pun di mana pun untuk membuat dan berbagi konten pendidikan (instruktur) dan mengakses konten pendidikan tersebut untuk belajar (siswa). Kami menganggap model pasar kami sebagai cara terbaik untuk menawarkan konten pendidikan yang berharga kepada pengguna kami. Kami memerlukan aturan untuk menjaga platform dan layanan kami aman bagi Anda, kami, dan komunitas siswa dan instruktur kami. Ketentuan ini berlaku untuk semua aktivitas Anda di situs web Qeraton, aplikasi seluler Qeraton kami, aplikasi TV kami, API kami, dan layanan terkait lainnya (“<b>Layanan</b>”).</p><p>Jika Anda mempublikasikan konten di platform kami, Anda juga harus menyetujui Ketentuan Instruktur. Kami juga memberikan detail mengenai pengolahan data pribadi siswa dan instruktur kami di Kebijakan Privasi kami. Jika Anda menggunakan platform kami untuk Bisnis sebagai bagian dari langganan Qeraton untuk Bisnis organisasi Anda, Anda harus berkonsultasi dengan Pernyataan Privasi Qeraton untuk Bisnis kami.</p><p>Anda memerlukan akun untuk sebagian besar aktivitas di platform kami, termasuk untuk <b>membeli</b> dan mengakses konten atau untuk <b>mengirimkan konten untuk dipublikasikan</b>. Saat membuat dan memelihara akun Anda, Anda harus memberikan dan terus memberikan informasi yang akurat dan lengkap, termasuk alamat email yang valid. Anda bertanggung jawab sepenuhnya atas akun Anda dan segala sesuatu yang terjadi di akun Anda, termasuk untuk segala kerusakan atau kerugian (kepada kami atau siapa pun) yang disebabkan oleh seseorang yang menggunakan akun Anda tanpa izin Anda. Ini berarti Anda harus berhati-hati dengan kata sandi Anda. Anda tidak boleh mentransfer akun Anda ke orang lain atau menggunakan akun orang lain. Jika Anda menghubungi kami untuk meminta akses ke akun, kami tidak akan memberikan akses tersebut kecuali jika Anda dapat memberikan kami informasi yang kami butuhkan untuk membuktikan bahwa Anda adalah pemilik akun tersebut. Jika pengguna meninggal dunia, akun pengguna tersebut akan ditutup.</p>',
            ],
            [
                'page_id' => 6,
                'locale' => 'id',
                'title' => 'Sistem Poin Hadiah',
                'seo_description' => 'Sistem Poin Hadiah AAIPI adalah Sistem Poin Hadiah Loyalitas Lengkap dan plugin Poin dan Hadiah yang paling komprehensif.',
                'content' => '<p><img src=\"/store/1/default_images/Reward Points System.jpg\" style=\"width: 800px;\"><br></p><p><b>Sistem Poin Hadiah AAIPI adalah Sistem Poin Hadiah Loyalitas Lengkap dan plugin Poin dan Hadiah yang paling komprehensif. Hadiahkan Pelanggan Anda dengan Poin Hadiah untuk Pembelian Produk, Menulis Ulasan, Mendaftar, Referral, dll. Poin Hadiah yang diperoleh dapat ditukarkan untuk pembelian di masa depan.&nbsp;</b></p>',
            ],
        ];

        foreach ($data as $item) {
            PageTranslation::updateOrCreate(
                ['page_id' => $item['page_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
