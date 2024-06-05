<?php

namespace Database\Seeders;

use App\Models\Translation\SettingTranslation;
use Illuminate\Database\Seeder;

class SettingTranslationsTableSeeder extends Seeder
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
                'id' => 6,
                'setting_id' => 8,
                'locale' => 'id',
                'value' => '{\"title\":\"Kembangkan Kompetensimu dimanapun dan kapanpun...\",\"description\":\"Mengikuti perkembangan teknologi modern, AAIPI mendorong perubahan reformasi pelatihan guna mengembangkan kompetensi Auditor Internal Pemerintah Indonesia dengan sistem informasi yang dapat dilakukan dimanapun dan kapanpun dengan cara yang lebih efektif\\u00a0dan\\u00a0efisien.\",\"hero_background":"\\/store\\/1\\/hero_cover.svg",\"is_video_background\":\"0\"}',
            ],

            [
                'id' => 8,
                'setting_id' => 14,
                'locale' => 'id',
                'value' => '{"admin_login":"\\/store\\/1\\/default_images\\/admin_login.jpg","admin_dashboard":"\\/store\\/1\\/default_images\\/admin_dashboard.jpg","login":"\\/store\\/1\\/default_images\\/img_cover.png","register":"\\/store\\/1\\/default_images\\/img_register.jpg","remember_pass":"\\/store\\/1\\/default_images\\/password_recovery.jpg","verification":"\\/store\\/1\\/default_images\\/verification.jpg","search":"\\/store\\/1\\/default_images\\/search_cover.png","categories":"\\/store\\/1\\/default_images\\//img_cover.png","become_instructor":"\\/store\\/1\\/default_images\\/become_instructor.jpg","certificate_validation":"\\/store\\/1\\/default_images\\/certificate_validation.jpg","blog":"\\/store\\/1\\/default_images\\/img_cover.png","instructors":"\\/store\\/1\\/default_images\\/img_cover.png","organizations":"\\/store\\/1\\/default_images\\/organizations_cover.png","dashboard":"\\/store\\/1\\/dashboard.png","user_cover":"\\/store\\/1\\/default_images\\/default_cover.jpg","instructor_finder_wizard":"\\/store\\/1\\/default_images\\/instructor_finder_wizard.jpg","products_lists":"\\/store\\/1\\/default_images\\//img_cover.png","upcoming_courses_lists":"\\/store\\/1\\/default_images\\//img_cover.png"}',
            ],

            [
                'id' => 9,
                'setting_id' => 15,
                'locale' => 'id',
                'value' => '{"title":"Kembangkan Kompetensimu dimanapun dan kapanpun...","description":"Mengikuti perkembangan teknologi modern, AAIPI mendorong perubahan reformasi pelatihan guna mengembangkan kompetensi Auditor Internal Pemerintah Indonesia dengan sistem informasi yang dapat dilakukan dimanapun dan kapanpun dengan cara yang lebih efektif\\u00a0dan\\u00a0efisien.","hero_background":"\\/store\\/1\\/hero_cover.svg","hero_vector":"\\/store\\/1\\/animated-header.json","has_lottie":"0"}',
            ],

            [
                'id' => 13,
                'setting_id' => 24,
                'locale' => 'id',
                'value' => json_encode([
                    'background' => '/store/1/default_images/img_cover.png',
                    'latitude' => '43.45905',
                    'longitude' => '11.87300',
                    'map_zoom' => '16',
                    'phones' => '021-8591 0031 ext. 1134',
                    'emails' => 'info@aaipi.or.id',
                    'address' => 'Jl. Pramuka No. 33',
                    'operations' => '08:00 - 17:00',
                ]),
            ],

            [
                'id' => 15,
                'setting_id' => 26,
                'locale' => 'id',
                'value' => json_encode([
                    '02nh9a' => ['title' => 'Beranda', 'link' => '/', 'order' => '1'],
                    '1cH2kF' => ['title' => 'Learning', 'link' => '/classes?sort=newest', 'order' => '2'],
                    'Resources' => ['title' => 'Resources', 'link' => '/resources?sort=newest', 'order' => '3'],
                    'gGf8Lv' => ['title' => 'Kontributor', 'link' => '/instructors', 'order' => '4'],
                    'Uo5b2v' => ['title' => 'Etalase', 'link' => '/products', 'order' => '5'],
                    'Wnq5Qb' => ['title' => 'Forum', 'link' => '/forums', 'order' => '6'],
                    'Blog' => ['title' => 'Blog', 'link' => '/blog', 'order' => '7'],
                    'ContactUs' => ['title' => 'Hubungi Kami', 'link' => '/contact', 'order' => '8'],
                ]),
            ],

            [
                'id' => 20,
                'setting_id' => 4,
                'locale' => 'id',
                'value' => json_encode([
                    'first_column' => ['title' => 'Tentang Kami', 'value' => '<p><font color="#ffffff">E-Learning Management System (E-LMS) yang dirancang oleh Asosiasi Auditor Intern Pemerintah Indonesia (AAIPI) merupakan sebuah platform inovatif yang menyediakan akses yang mudah dan terstruktur bagi para auditor intern untuk meningkatkan pengetahuan dan keterampilan mereka dalam bidang audit internal.</font></p>'],
                    'second_column' => ['title' => 'Tautan Tambahan', 'value' => '<p><a href="/login"><font color="#ffffff">Masuk</font></a></p><p><font color="#ffffff"><a href="/register"><font color="#ffffff">Daftar</font></a><br></font></p><p><a href="/blog"><font color="#ffffff">Blog</font></a></p><p><a href="/resources"><font color="#ffffff">Resources</font></a></p><p><a href="/contact"><font color="#ffffff">Hubungi kami</font></a></p><p><font color="#ffffff"><a href="/certificate_validation"><font color="#ffffff">Validasi sertifikat</font></a><br></font></p>'],
                    'third_column' => ['title' => 'Informasi Lainnya', 'value' => '<p><font color="#ffffff"><a href="/become-instructor"><font color="#ffffff">Menjadi instruktur</font></a><br></font></p><p><a href="/pages/terms"><font color="#ffffff">Persyaratan &amp; peraturan</font></a></p><p><a href="/pages/about"><font color="#ffffff">Tentang kami</font></a><br></p>'],
                    'forth_column' => ['title' => 'Beli Ciptapotensi', 'value' => '<p><a title="Notnt" href="https://qeraton.com"><img style="width: 200px;" src="/store/1/default_images/envato.png"></a></p>'],
                ]),
            ],

            // [
            //     'id' => 80,
            //     'setting_id' => 67,
            //     'locale' => 'id',
            //     'value' => '{"url_member_area":"admin"}'
            // ]

        ];

        foreach ($data as $item) {
            SettingTranslation::updateOrCreate(
                ['id' => $item['id'], 'setting_id' => $item['setting_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
