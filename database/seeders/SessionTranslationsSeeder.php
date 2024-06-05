<?php

namespace Database\Seeders;

use App\Models\Translation\SessionTranslation;
use Illuminate\Database\Seeder;

class SessionTranslationsSeeder extends Seeder
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
                'session_id' => 52,
                'locale' => 'id',
                'title' => 'Hari 1',
                'description' => 'Dalam pelajaran ini, Anda akan belajar: Apa itu Linux dan Sejarah singkat Linux.',
            ],
            [
                'id' => 2,
                'session_id' => 53,
                'locale' => 'id',
                'title' => 'Hari 2',
                'description' => 'Dalam pelajaran ini, Anda akan mempelajari tentang struktur direktori Linux. Anda akan belajar di mana berbagai komponen dari sistem operasi tersebut berada. Anda juga akan mempelajari bagaimana aplikasi dapat menggunakan konvensi yang sama untuk struktur direktori mereka.',
            ],
            [
                'id' => 3,
                'session_id' => 54,
                'locale' => 'id',
                'title' => 'Hari 3',
                'description' => 'Dalam pelajaran ini, Anda akan mempelajari berbagai perintah yang dapat digunakan untuk melihat file serta cara menggunakan editor teks nano.',
            ],
            [
                'id' => 4,
                'session_id' => 55,
                'locale' => 'id',
                'title' => 'Hari 4',
                'description' => 'Pelajaran ini akan mencakup cara menghapus, menyalin, memindahkan, dan mengubah nama file di Linux.',
            ],
            [
                'id' => 5,
                'session_id' => 56,
                'locale' => 'id',
                'title' => 'Hari 5',
                'description' => 'Dalam pelajaran ini, Anda akan mempelajari cara menampilkan informasi tentang program dan proses yang sedang berjalan. Anda juga akan mempelajari cara mengontrol perilaku proses, termasuk menjalankan proses di latar belakang dan mengakhiri proses.',
            ],
            [
                'id' => 6,
                'session_id' => 59,
                'locale' => 'id',
                'title' => 'Pengenalan',
                'description' => 'Microsoft Excel adalah spreadsheet yang dikembangkan oleh Microsoft untuk Windows, macOS, Android, dan iOS. Fitur-fiturnya termasuk perhitungan, alat grafik, tabel pivot, dan bahasa pemrograman makro bernama Visual Basic for Applications (VBA).',
            ],
            [
                'id' => 7,
                'session_id' => 60,
                'locale' => 'id',
                'title' => 'Fungsi Dasar Excel',
                'description' => 'Microsoft Excel memiliki fitur dasar dari semua spreadsheet, menggunakan kisi sel yang diatur dalam baris berangka dan kolom yang dinamai huruf untuk mengatur manipulasi data seperti operasi aritmatika.',
            ],
            [
                'id' => 8,
                'session_id' => 61,
                'locale' => 'id',
                'title' => 'Grafik Dasar',
                'description' => 'Excel mendukung grafik, diagram, atau histogram yang dihasilkan dari grup sel tertentu. Ini juga mendukung Pivot Charts yang memungkinkan grafik terhubung langsung ke tabel Pivot. Ini memungkinkan grafik diperbarui dengan Tabel Pivot.',
            ],
            [
                'id' => 9,
                'session_id' => 62,
                'locale' => 'id',
                'title' => 'Kunci untuk Manajemen Waktu yang Efektif',
                'description' => 'Jika Anda pernah mengikuti kursus manajemen waktu, Anda mungkin pernah menghadapi frustrasi mencoba mengelola waktu Anda dengan lebih baik dan tidak berhasil. Ini karena manajemen waktu adalah Mitos. Apa yang akan diajarkan kursus ini kepada Anda adalah konsep \"Manajemen Tugas.\" Dengan kata lain, itu akan mengajarkan Anda bagaimana menyelesaikan lebih banyak tugas bernilai tinggi, sehingga Anda mendapatkan pengembalian 10 kali lipat lebih besar untuk semua pekerjaan yang Anda lakukan setiap jam.',
            ],
            [
                'id' => 10,
                'session_id' => 63,
                'locale' => 'id',
                'title' => 'Manajemen Waktu 20/80',
                'description' => 'Jika Anda pernah mengikuti kursus manajemen waktu, Anda mungkin pernah menghadapi frustrasi mencoba mengelola waktu Anda dengan lebih baik dan tidak berhasil. Ini karena manajemen waktu adalah Mitos. Apa yang akan diajarkan kursus ini kepada Anda adalah konsep \"Manajemen Tugas.\" Dengan kata lain, itu akan mengajarkan Anda bagaimana menyelesaikan lebih banyak tugas bernilai tinggi, sehingga Anda mendapatkan pengembalian 10 kali lipat lebih besar untuk semua pekerjaan yang Anda lakukan setiap jam.',
            ],
            [
                'id' => 11,
                'session_id' => 64,
                'locale' => 'id',
                'title' => 'Menyelesaikan Hal-hal Bernilai Tinggi',
                'description' => 'Apa yang akan diajarkan kursus ini kepada Anda adalah konsep "Manajemen Tugas." Dengan kata lain, itu akan mengajarkan Anda bagaimana menyelesaikan lebih banyak tugas bernilai tinggi, sehingga Anda mendapatkan pengembalian 10 kali lipat lebih besar untuk semua pekerjaan yang Anda lakukan setiap jam.',
            ],
            [
                'id' => 12,
                'session_id' => 65,
                'locale' => 'id',
                'title' => 'Memulai',
                'description' => 'Gambaran singkat tentang apa yang akan Anda pelajari dalam kursus ini.',
            ],
            [
                'id' => 13,
                'session_id' => 66,
                'locale' => 'id',
                'title' => 'Modul, Aplikasi, dan Pengontrol',
                'description' => 'AngularJS memungkinkan Anda mengontrol DOM melalui modul, aplikasi, dan pengontrol -- semua tanpa mengotori ruang nama global. Kuliah ini berisi kode sumber yang dapat diunduh. Unduh file di bawah ini dan unzip (atau ekstrak) file tersebut.',
            ],
            [
                'id' => 14,
                'session_id' => 67,
                'locale' => 'id',
                'title' => 'Pengikatan Data dan Direktif',
                'description' => 'Kode AngularJS visual pertama kita. Sekarang kita memahami cakupan, mari gunakan untuk mengeluarkan konten ke halaman. Kuliah ini berisi kode sumber yang dapat diunduh. Unduh file di bawah ini dan unzip (atau ekstrak) file tersebut.',
            ],
            [
                'id' => 15,
                'session_id' => 68,
                'locale' => 'id',
                'title' => 'Diet Kebugaran yang Sempurna',
                'description' => 'Masterclass \"Kesehatan & Kebugaran\" saya dirancang untuk siapa pun yang ingin meningkatkan kebugaran mereka, tidak peduli apakah Anda pemula, atlet, atau hanya ingin menjalani kehidupan yang lebih sehat.',
            ],
            [
                'id' => 16,
                'session_id' => 69,
                'locale' => 'id',
                'title' => 'Menyiapkan Diet Kebugaran Anda',
                'description' => 'Masterclass "Kesehatan & Kebugaran" saya dirancang untuk siapa pun yang ingin meningkatkan kebugaran mereka, tidak peduli apakah Anda pemula, atlet, atau hanya ingin menjalani kehidupan yang lebih sehat.',
            ],
            [
                'id' => 17,
                'session_id' => 70,
                'locale' => 'id',
                'title' => 'Pemikiran Kebugaran yang Tepat',
                'description' => 'Masterclass "Kesehatan & Kebugaran" saya dirancang untuk siapa pun yang ingin meningkatkan kebugaran mereka, tidak peduli apakah Anda pemula, atlet, atau hanya ingin menjalani kehidupan yang lebih sehat.',
            ],
            [
                'id' => 18,
                'session_id' => 71,
                'locale' => 'id',
                'title' => 'Mengapa Mendengarkan Aktif?',
                'description' => 'Kebanyakan dari kita ingin menjadi lebih baik dalam berbicara. Tetapi alat kekuatan nyata untuk mempengaruhi orang lain, memimpin, berkolaborasi, memiliki dampak, dan menjadi pribadi yang lebih baik secara keseluruhan adalah Mendengarkan Aktif. Sementara mendengarkan biasa bisa terlihat seperti menjadi kosong dan diam, Mendengarkan Aktif adalah terlibat, kreatif, dan responsif.',
            ],
            [
                'id' => 19,
                'session_id' => 72,
                'locale' => 'id',
                'title' => 'Kebiasaan Mendengarkan Otomatis',
                'description' => 'Dalam kursus ini, Anda akan mendapatkan kesadaran internal dan keterampilan eksternal yang merupakan dasar dari Mendengarkan Aktif. Anda akan dapat memiliki percakapan yang jauh lebih memuaskan, menarik, sukses.',
            ],
            [
                'id' => 20,
                'session_id' => 73,
                'locale' => 'id',
                'title' => 'Kebiasaan yang Membantu',
                'description' => 'Kebanyakan dari kita ingin menjadi lebih baik dalam berbicara. Tetapi alat kekuatan nyata untuk mempengaruhi orang lain, memimpin, berkolaborasi, memiliki dampak, dan menjadi pribadi yang lebih baik secara keseluruhan adalah Mendengarkan Aktif.',
            ],
            [
                'id' => 21,
                'session_id' => 74,
                'locale' => 'id',
                'title' => 'Sesi Pertama',
                'description' => 'Penciptaan Kursus Online bisa sederhana setelah Anda menguasai seni berbicara di depan kamera. Bayangkan diri Anda memberikan seluruh kursus yang penuh dengan kuliah-kuliah hebat',
            ],
            [
                'id' => 22,
                'session_id' => 75,
                'locale' => 'id',
                'title' => 'Bergabung dengan Sesi Ini',
                'description' => 'Keterampilan yang akan Anda pelajari dalam kelas ini pada dasarnya bukanlah teoritis atau akademis. Ini adalah keterampilan yang memerlukan kebiasaan fisik.',
            ],
            [
                'id' => 23,
                'session_id' => 76,
                'locale' => 'id',
                'title' => 'Sesi Pengenalan',
                'description' => 'Keterampilan yang akan Anda pelajari dalam kelas ini pada dasarnya bukanlah teoritis atau akademis. Ini adalah keterampilan yang memerlukan kebiasaan fisik.',
            ],
        ];

        foreach ($data as $item) {
            SessionTranslation::updateOrCreate(
                ['id' => $item['id'], 'session_id' => $item['session_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
