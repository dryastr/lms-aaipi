<?php

namespace Database\Seeders;

use App\Models\Translation\QuizzesQuestionTranslation;
use Illuminate\Database\Seeder;

class QuizQuestionTranslationsSeeder extends Seeder
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
                'quizzes_question_id' => 40,
                'locale' => 'id',
                'title' => 'Di mana ibukota Prancis?',
                'correct' => null,
            ],
            [
                'id' => 2,
                'quizzes_question_id' => 41,
                'locale' => 'id',
                'title' => 'Musim apa yang paling dingin dalam setahun?',
                'correct' => null,
            ],
            [
                'id' => 3,
                'quizzes_question_id' => 42,
                'locale' => 'id',
                'title' => 'Berapa bulan setiap tahun?',
                'correct' => null,
            ],
            [
                'id' => 4,
                'quizzes_question_id' => 44,
                'locale' => 'id',
                'title' => 'Berapa sentimeter satu meter?',
                'correct' => null,
            ],
            [
                'id' => 5,
                'quizzes_question_id' => 45,
                'locale' => 'id',
                'title' => 'Berapa meter satu kilometer?',
                'correct' => '',
            ],
            [
                'id' => 6,
                'quizzes_question_id' => 46,
                'locale' => 'id',
                'title' => 'Berapa hal yang harus kita lakukan sebelum rapat?',
                'correct' => null,
            ],
            [
                'id' => 7,
                'quizzes_question_id' => 47,
                'locale' => 'id',
                'title' => 'Apa yang harus kita lakukan selama rapat?',
                'correct' => 'Mulailah rapat tepat waktu sesuai jadwal dan jangan menunggu orang lain datang. Banyak waktu profesional terbuang oleh pemimpin yang menunggu lebih banyak orang datang sebelum memulai rapat. Mungkin memerlukan perubahan budaya, tetapi begitu orang tahu bahwa Anda memulai rapat tepat waktu, mereka akan datang tepat waktu.',
            ],
            [
                'id' => 8,
                'quizzes_question_id' => 48,
                'locale' => 'id',
                'title' => 'Apa yang harus kita lakukan sebelum rapat?',
                'correct' => 'Pastikan orang datang ke rapat dengan persiapan. Ya, ini akan memerlukan usaha di luar sekadar menjadwalkan panggilan, tetapi Anda akan mendapatkan manfaat besar jika mendistribusikan agenda dan materi relevan lainnya kepada peserta sebelumnya. Bekerja cerdas dan manfaatkan teknologi untuk membantu Anda mempersiapkan konten rapat.',
            ],
            [
                'id' => 9,
                'quizzes_question_id' => 49,
                'locale' => 'id',
                'title' => 'Apa yang harus kita lakukan setelah rapat?',
                'correct' => 'Pertahankan konten agar tidak perlu diulangi. Banyak responden survei kami melaporkan bahwa mereka memiliki masalah besar dengan ketahanan konten (artinya mereka kesulitan memastikan bahwa file, video, halaman web, papan tulis, anotasi, dll., Ada setelah rapat berakhir). Kuncinya di sini adalah berhenti memikirkan rapat sebagai acara dengan awal dan akhir yang pasti. Sebaliknya, sadari bahwa rapat seringkali merupakan segmen dari proyek-proyek yang lebih besar dan carilah teknologi yang dapat menjaga dan mengembalikan sesi Anda secara instan tepat di tempat Anda meninggalkannya.',
            ],
            [
                'id' => 10,
                'quizzes_question_id' => 50,
                'locale' => 'id',
                'title' => 'Apa jumlah hal yang harus kita lakukan setelah rapat?',
                'correct' => null,
            ],
            [
                'id' => 11,
                'quizzes_question_id' => 51,
                'locale' => 'id',
                'title' => 'Foto mana yang milik Prancis?',
                'correct' => null,
            ],
            [
                'id' => 12,
                'quizzes_question_id' => 52,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan guru?',
                'correct' => null,
            ],
            [
                'id' => 13,
                'quizzes_question_id' => 53,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan pemadam kebakaran?',
                'correct' => null,
            ],
            [
                'id' => 14,
                'quizzes_question_id' => 54,
                'locale' => 'id',
                'title' => 'Hewan apa yang hidup di air?',
                'correct' => null,
            ],
            [
                'id' => 15,
                'quizzes_question_id' => 55,
                'locale' => 'id',
                'title' => 'Gambar apa yang musim gugur?',
                'correct' => null,
            ],
            [
                'id' => 16,
                'quizzes_question_id' => 56,
                'locale' => 'id',
                'title' => 'Foto mana yang milik Prancis?',
                'correct' => null,
            ],
            [
                'id' => 17,
                'quizzes_question_id' => 57,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan guru?',
                'correct' => null,
            ],
            [
                'id' => 18,
                'quizzes_question_id' => 58,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan pemadam kebakaran?',
                'correct' => null,
            ],
            [
                'id' => 19,
                'quizzes_question_id' => 59,
                'locale' => 'id',
                'title' => 'Hewan apa yang hidup di air?',
                'correct' => null,
            ],
            [
                'id' => 20,
                'quizzes_question_id' => 60,
                'locale' => 'id',
                'title' => 'Gambar apa yang musim gugur?',
                'correct' => null,
            ],
            [
                'id' => 21,
                'quizzes_question_id' => 61,
                'locale' => 'id',
                'title' => 'Di mana ibukota Prancis?',
                'correct' => '',
            ],
            [
                'id' => 22,
                'quizzes_question_id' => 62,
                'locale' => 'id',
                'title' => 'Berapa bulan setiap tahun?',
                'correct' => null,
            ],
            [
                'id' => 23,
                'quizzes_question_id' => 63,
                'locale' => 'id',
                'title' => 'Berapa sentimeter satu meter?',
                'correct' => null,
            ],
            [
                'id' => 24,
                'quizzes_question_id' => 64,
                'locale' => 'id',
                'title' => 'Berapa meter satu kilometer?',
                'correct' => null,
            ],
            [
                'id' => 25,
                'quizzes_question_id' => 65,
                'locale' => 'id',
                'title' => 'Silakan jelaskan tentang versi-versi Ubuntu Linux?',
                'correct' => 'Ubuntu mungkin adalah distribusi Linux yang paling terkenal. Ubuntu didasarkan pada Debian, tetapi memiliki repositori perangkat lunak sendiri. Sebagian besar perangkat lunak dalam repositori ini disinkronkan dari repositori Debian.\r\n\r\nProyek Ubuntu berfokus pada menyediakan pengalaman desktop (dan server) yang solid, dan tidak takut untuk membangun teknologi kustomnya sendiri untuk melakukannya. Ubuntu dulunya menggunakan lingkungan desktop GNOME 2, tetapi sekarang menggunakan lingkungan desktop Unity miliknya sendiri. Ubuntu bahkan membangun server grafis Mir-nya sendiri sementara distribusi lain bekerja pada Wayland.',
            ],
            [
                'id' => 26,
                'quizzes_question_id' => 66,
                'locale' => 'id',
                'title' => 'Foto mana yang milik Prancis?',
                'correct' => null,
            ],
            [
                'id' => 27,
                'quizzes_question_id' => 67,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan guru?',
                'correct' => null,
            ],
            [
                'id' => 28,
                'quizzes_question_id' => 68,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan pemadam kebakaran?',
                'correct' => null,
            ],
            [
                'id' => 29,
                'quizzes_question_id' => 69,
                'locale' => 'id',
                'title' => 'Hewan apa yang hidup di air?',
                'correct' => null,
            ],
            [
                'id' => 30,
                'quizzes_question_id' => 70,
                'locale' => 'id',
                'title' => 'Gambar apa yang musim gugur?',
                'correct' => null,
            ],
            [
                'id' => 31,
                'quizzes_question_id' => 71,
                'locale' => 'id',
                'title' => 'Foto mana yang milik Prancis?',
                'correct' => null,
            ],
            [
                'id' => 32,
                'quizzes_question_id' => 72,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan guru?',
                'correct' => null,
            ],
            [
                'id' => 33,
                'quizzes_question_id' => 73,
                'locale' => 'id',
                'title' => 'Gambar apa yang berkaitan dengan pekerjaan pemadam kebakaran?',
                'correct' => null,
            ],
            [
                'id' => 34,
                'quizzes_question_id' => 74,
                'locale' => 'id',
                'title' => 'Hewan apa yang hidup di air?',
                'correct' => null,
            ],
            [
                'id' => 35,
                'quizzes_question_id' => 75,
                'locale' => 'id',
                'title' => 'Gambar apa yang musim gugur?',
                'correct' => null,
            ],
            [
                'id' => 36,
                'quizzes_question_id' => 76,
                'locale' => 'id',
                'title' => 'Silakan tonton video dan pilih jawaban yang benar',
                'correct' => null,
            ],
        ];

        foreach ($data as $item) {
            QuizzesQuestionTranslation::updateOrCreate(
                ['id' => $item['id'], 'quizzes_question_id' => $item['quizzes_question_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
