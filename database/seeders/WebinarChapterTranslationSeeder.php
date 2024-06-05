<?php

namespace Database\Seeders;

use App\Models\Translation\WebinarChapterTranslation;
use Illuminate\Database\Seeder;

class WebinarChapterTranslationSeeder extends Seeder
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
                'id' => 2,
                'webinar_chapter_id' => 2,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 3,
                'webinar_chapter_id' => 3,
                'locale' => 'id',
                'title' => 'Saran Umum & Tips',
            ],
            [
                'id' => 4,
                'webinar_chapter_id' => 4,
                'locale' => 'id',
                'title' => 'Sebelum Memulai Kursus',
            ],
            [
                'id' => 5,
                'webinar_chapter_id' => 5,
                'locale' => 'id',
                'title' => 'Ayo Mulai!',
            ],
            [
                'id' => 6,
                'webinar_chapter_id' => 6,
                'locale' => 'id',
                'title' => 'Siap untuk Memulai?',
            ],
            [
                'id' => 7,
                'webinar_chapter_id' => 7,
                'locale' => 'id',
                'title' => 'Esensial',
            ],
            [
                'id' => 8,
                'webinar_chapter_id' => 8,
                'locale' => 'id',
                'title' => 'Eksponensial',
            ],
            [
                'id' => 9,
                'webinar_chapter_id' => 9,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 10,
                'webinar_chapter_id' => 10,
                'locale' => 'id',
                'title' => 'Taktik Pengaruh & Persuasi',
            ],
            [
                'id' => 11,
                'webinar_chapter_id' => 11,
                'locale' => 'id',
                'title' => 'Ide dan Kebutuhan Pengguna',
            ],
            [
                'id' => 12,
                'webinar_chapter_id' => 12,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 13,
                'webinar_chapter_id' => 13,
                'locale' => 'id',
                'title' => 'Mengapa Mendengarkan Aktif?',
            ],
            [
                'id' => 14,
                'webinar_chapter_id' => 14,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 15,
                'webinar_chapter_id' => 15,
                'locale' => 'id',
                'title' => 'Menyiapkan Diet Kebugaran Anda',
            ],
            [
                'id' => 16,
                'webinar_chapter_id' => 16,
                'locale' => 'id',
                'title' => 'Mulai Sekarang',
            ],
            [
                'id' => 17,
                'webinar_chapter_id' => 17,
                'locale' => 'id',
                'title' => 'Model, Tampilan, Apa Saja...',
            ],
            [
                'id' => 18,
                'webinar_chapter_id' => 18,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 19,
                'webinar_chapter_id' => 19,
                'locale' => 'id',
                'title' => 'Manajemen Waktu yang Efektif',
            ],
            [
                'id' => 20,
                'webinar_chapter_id' => 20,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 21,
                'webinar_chapter_id' => 21,
                'locale' => 'id',
                'title' => 'Fundamental Microsoft Excel',
            ],
            [
                'id' => 22,
                'webinar_chapter_id' => 22,
                'locale' => 'id',
                'title' => 'Ikhtisar',
            ],
            [
                'id' => 23,
                'webinar_chapter_id' => 23,
                'locale' => 'id',
                'title' => 'Mulai Belajar',
            ],
            [
                'id' => 24,
                'webinar_chapter_id' => 24,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 26,
                'webinar_chapter_id' => 26,
                'locale' => 'id',
                'title' => 'Memasuki Dunia Python',
            ],
            [
                'id' => 28,
                'webinar_chapter_id' => 28,
                'locale' => 'id',
                'title' => 'File SCORM',
            ],
            [
                'id' => 29,
                'webinar_chapter_id' => 29,
                'locale' => 'id',
                'title' => 'Jenis File yang Berbeda',
            ],
            [
                'id' => 30,
                'webinar_chapter_id' => 30,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 31,
                'webinar_chapter_id' => 31,
                'locale' => 'id',
                'title' => 'Bab Pertama',
            ],
            [
                'id' => 32,
                'webinar_chapter_id' => 32,
                'locale' => 'id',
                'title' => 'Bab Kedua',
            ],
            [
                'id' => 33,
                'webinar_chapter_id' => 33,
                'locale' => 'id',
                'title' => 'Bab Terakhir',
            ],
            [
                'id' => 34,
                'webinar_chapter_id' => 34,
                'locale' => 'id',
                'title' => 'Tugas',
            ],
            [
                'id' => 42,
                'webinar_chapter_id' => 41,
                'locale' => 'id',
                'title' => 'Bagian 1: Pengenalan terhadap Host Aman',
            ],
            [
                'id' => 43,
                'webinar_chapter_id' => 42,
                'locale' => 'id',
                'title' => 'Fundamental',
            ],
            [
                'id' => 44,
                'webinar_chapter_id' => 43,
                'locale' => 'id',
                'title' => 'Pengantar',
            ],
            [
                'id' => 45,
                'webinar_chapter_id' => 44,
                'locale' => 'id',
                'title' => 'Pembahasan',
            ],
        ];

        foreach ($data as $item) {
            WebinarChapterTranslation::updateOrCreate(
                ['id' => $item['id'], 'locale' => $item['locale'], 'webinar_chapter_id' => $item['webinar_chapter_id']],
                $item
            );
        }
    }
}
