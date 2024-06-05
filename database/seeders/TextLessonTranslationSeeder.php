<?php

namespace Database\Seeders;

use App\Models\Translation\TextLessonTranslation;
use Illuminate\Database\Seeder;

class TextLessonTranslationSeeder extends Seeder
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
                'text_lesson_id' => 13,
                'locale' => 'id',
                'title' => 'Halo, Dunia!',
                'summary' => 'Mulailah belajar Python dengan tutorial Intro to Python gratis dari DataCamp. Pelajari Ilmu Data dengan menyelesaikan tantangan pemrograman interaktif dan menonton video oleh instruktur ahli. Mulai Sekarang!',
                'content' => '<div>Python adalah bahasa yang sangat sederhana, dan memiliki sintaks yang sangat mudah. Ini mendorong para programmer untuk memprogram tanpa kode boilerplate (sudah disiapkan). Direktif paling sederhana dalam Python adalah direktif "print" - itu hanya mencetak baris (dan juga termasuk baris baru, tidak seperti di C).</div><div><br></div><div>Ada dua versi Python utama, Python 2 dan Python 3. Python 2 dan 3 cukup berbeda. Tutorial ini menggunakan Python 3, karena lebih semantik dan mendukung fitur-fitur terbaru.</div><div><br></div><div>Sebagai contoh, satu perbedaan antara Python 2 dan 3 adalah pernyataan print. Dalam Python 2, pernyataan "print" bukanlah fungsi, dan oleh karena itu dipanggil tanpa tanda kurung. Namun, dalam Python 3, itu adalah fungsi, dan harus dipanggil dengan tanda kurung.</div>',
            ],
            [
                'id' => 2,
                'text_lesson_id' => 14,
                'locale' => 'id',
                'title' => 'Belajar',
                'summary' => 'Sebelum memulai, Anda mungkin ingin mencari tahu IDE dan editor teks mana yang dirancang untuk membuat pengeditan Python menjadi mudah, jelajahi daftar buku pengantar, atau lihat contoh kode yang mungkin membantu Anda.',
                'content' => '<div>Ada daftar tutorial yang cocok untuk programmer berpengalaman di halaman BeginnersGuide/Tutorials. Ada juga daftar sumber daya dalam bahasa lain yang mungkin berguna jika bahasa Inggris bukan bahasa pertama Anda.</div><div><br></div><div>Dokumentasi online adalah sumber informasi definitif Anda. Ada tutorial yang cukup singkat yang memberikan informasi dasar tentang bahasa dan memulai Anda. Anda dapat mengikuti ini dengan melihat referensi perpustakaan untuk deskripsi lengkap dari banyak perpustakaan Python dan referensi bahasa untuk penjelasan lengkap (meskipun agak kering) tentang sintaks Python. Jika Anda mencari resep dan pola Python yang umum, Anda dapat menelusuri Cookbook Python ActiveState</div>',
            ],
            [
                'id' => 3,
                'text_lesson_id' => 15,
                'locale' => 'id',
                'title' => 'Mencari Sesuatu yang Spesifik?',
                'summary' => 'Jika Anda ingin tahu apakah aplikasi tertentu, atau perpustakaan dengan fungsionalitas tertentu, tersedia dalam Python, ada beberapa sumber informasi yang mungkin.',
                'content' => '<p>Jika Anda ingin tahu apakah aplikasi tertentu, atau perpustakaan dengan fungsionalitas tertentu, tersedia dalam Python, ada beberapa sumber informasi yang mungkin. Situs web Python menyediakan Python Package Index (juga dikenal sebagai Cheese Shop, sebuah referensi ke skrip Monty Python dengan nama tersebut). Ada juga halaman pencarian untuk sejumlah sumber informasi terkait Python. Jika itu gagal, cukup cari di Google untuk frasa yang mencakup kata \'python\' dan kemungkinan besar Anda akan mendapatkan hasil yang Anda butuhkan. Jika semua gagal, bertanya di grup diskusi python dan ada kemungkinan besar seseorang akan membimbing Anda ke arah yang benar.</p><p>Python adalah bahasa pemrograman tingkat tinggi berbasis interpreter. Filosofi desain Python menekankan pada keterbacaan kode dengan penggunaan indentasi yang signifikan. Konstruksi bahasanya serta pendekatannya yang berorientasi objek bertujuan untuk membantu para programmer menulis kode yang jelas dan logis untuk proyek-proyek kecil maupun besar.[30]</p><p><br></p><p>Python adalah bahasa yang dikelola secara dinamis dan dikumpulkan oleh sampah. Ini mendukung beberapa paradigma pemrograman, termasuk pemrograman terstruktur (terutama, prosedural), berorientasi objek, dan fungsional. Python sering digambarkan sebagai bahasa \"baterai termasuk\" karena perpustakaan standarnya yang komprehensif.[31]</p><p><br></p><p>Guido van Rossum mulai bekerja pada Python pada akhir tahun 1980-an, sebagai penerus dari bahasa pemrograman ABC, dan pertama kali merilisnya pada tahun 1991 sebagai Python 0.9.0.[32] Python 2.0 dirilis pada tahun 2000 dan memperkenalkan fitur-fitur baru, seperti list comprehensions dan sistem pengumpulan sampah menggunakan penghitungan referensi. Python 3.0 dirilis pada tahun 2008 dan merupakan revisi besar dari bahasa yang tidak sepenuhnya kompatibel mundur dan sebagian besar kode Python 2 tidak berjalan tanpa modifikasi pada Python 3. Python 2 dihentikan dengan versi 2.7.18 pada tahun 2020.[33]</p><p><br></p><p>Python secara konsisten masuk dalam salah satu bahasa pemrograman paling populer.</p>',
            ],
        ];

        foreach ($data as $item) {
            TextLessonTranslation::updateOrCreate(
                ['id' => $item['id'], 'text_lesson_id' => $item['text_lesson_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
