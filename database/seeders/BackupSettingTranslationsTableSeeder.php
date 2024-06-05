<?php

namespace Database\Seeders;

use App\Models\Translation\SettingTranslation;
use Illuminate\Database\Seeder;

class BackupSettingTranslationsTableSeeder extends Seeder
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
                'setting_id' => 1,
                'locale' => 'id',
                'value' => '{"home":{"title":"Beranda","description":"Deskripsi halaman utama","robot":"indeks"},"search":{"title":"Pencarian","description":"Deskripsi halaman pencarian","robot":"indeks"},"categories":{"title":"Kategori","description":"Deskripsi halaman kategori","robot":"indeks"},"login":{"title":"Masuk","description":"Deskripsi halaman masuk","robot":"indeks"},"register":{"title":"Daftar","description":"Deskripsi halaman pendaftaran","robot":"indeks"},"about":{"title":"Tentang","description":"Deskripsi halaman tentang"},"contact":{"title":"Kontak","description":"Deskripsi halaman kontak","robot":"indeks"},"certificate_validation":{"title":"Validasi sertifikat","description":"Deskripsi validasi sertifikat","robot":"indeks"},"classes":{"title":"Kursus","description":"Deskripsi halaman kursus","robot":"indeks"},"blog":{"title":"Blog","description":"Deskripsi halaman blog","robot":"indeks"},"instructors":{"title":"Instruktur","description":"Deskripsi halaman instruktur","robot":"indeks"},"organizations":{"title":"Organisasi","description":"Deskripsi halaman organisasi","robot":"indeks"},"instructor_finder_wizard":{"title":"Wizard pencari instruktur","description":"Deskripsi wizard pencari instruktur","robot":"noindeks"},"instructor_finder":{"title":"Pencari instruktur","description":"Deskripsi pencari instruktur","robot":"indeks"},"reward_courses":{"title":"Kursus hadiah","description":"Deskripsi kursus hadiah","robot":"indeks"},"products_lists":{"title":"Produk","description":"Deskripsi produk toko","robot":"noindeks"},"reward_products":{"title":"Produk hadiah","description":"Deskripsi produk hadiah","robot":"noindeks"},"forum":{"title":"Forum","description":"Deskripsi forum","robot":"noindeks"},"upcoming_courses_lists":{"title":"Daftar kursus yang akan datang","description":"Deskripsi kursus yang akan datang","robot":"noindeks"}}',
            ],

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
                'value' => '{"admin_login":"\\/store\\/1\\/default_images\\/admin_login.jpg","admin_dashboard":"\\/store\\/1\\/default_images\\/admin_dashboard.jpg","login":"\\/store\\/1\\/default_images\\/img_cover.png","register":"\\/store\\/1\\/default_images\\/img_cover.png","remember_pass":"\\/store\\/1\\/default_images\\/password_recovery.jpg","verification":"\\/store\\/1\\/default_images\\/verification.jpg","search":"\\/store\\/1\\/default_images\\/search_cover.png","categories":"\\/store\\/1\\/default_images\\//img_cover.png","become_instructor":"\\/store\\/1\\/default_images\\/become_instructor.jpg","certificate_validation":"\\/store\\/1\\/default_images\\/certificate_validation.jpg","blog":"\\/store\\/1\\/default_images\\/img_cover.png","instructors":"\\/store\\/1\\/default_images\\/instructors_cover.png","organizations":"\\/store\\/1\\/default_images\\/organizations_cover.png","dashboard":"\\/store\\/1\\/dashboard.png","user_cover":"\\/store\\/1\\/default_images\\/default_cover.jpg","instructor_finder_wizard":"\\/store\\/1\\/default_images\\/instructor_finder_wizard.jpg","products_lists":"\\/store\\/1\\/default_images\\//img_cover.png","upcoming_courses_lists":"\\/store\\/1\\/default_images\\//img_cover.png"}',
            ],

            [
                'id' => 9,
                'setting_id' => 15,
                'locale' => 'id',
                'value' => '{"title":"Kembangkan Kompetensimu dimanapun dan kapanpun...","description":"Mengikuti perkembangan teknologi modern, AAIPI mendorong perubahan reformasi pelatihan guna mengembangkan kompetensi Auditor Internal Pemerintah Indonesia dengan sistem informasi yang dapat dilakukan dimanapun dan kapanpun dengan cara yang lebih efektif\\u00a0dan\\u00a0efisien.","hero_background":"\\/store\\/1\\/hero_cover.svg","hero_vector":"\\/store\\/1\\/animated-header.json","has_lottie":"0"}',
            ],

            [
                'id' => 10,
                'setting_id' => 20,
                'locale' => 'id',
                'value' => '["Konten Kursus yang Tidak Pantas","Perilaku yang Tidak Pantas","Pelanggaran Kebijakan","Konten Spam","Lainnya"]',
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
                    'Resources' => ['title' => 'Resources', 'link' => '/resources', 'order' => '2'],
                    '1cH2kF' => ['title' => 'Learning', 'link' => '/classes?sort=newest', 'order' => '3'],
                    'gGf8Lv' => ['title' => 'Kontributor', 'link' => '/instructors', 'order' => '4'],
                    'Uo5b2v' => ['title' => 'Etalase', 'link' => '/products', 'order' => '5'],
                    'Wnq5Qb' => ['title' => 'Forum', 'link' => '/forums', 'order' => '6'],
                    'Blog' => ['title' => 'Blog', 'link' => '/blog', 'order' => '7'],
                    'ContactUs' => ['title' => 'Hubungi Kami', 'link' => '/contact', 'order' => '8'],
                ]),
            ],

            [
                'id' => 16,
                'setting_id' => 27,
                'locale' => 'id',
                'value' => '{"link":"\\/classes","title":"Mulai belajar di mana saja, kapan saja...","description":"Gunakan Ciptapotensi untuk mengakses materi pendidikan berkualitas tinggi tanpa batasan dengan cara yang paling mudah.","background":"\\/store\\/1\\/default_images\\/home_video_section.png"}',
            ],

            [
                'id' => 19,
                'setting_id' => 30,
                'locale' => 'id',
                'value' => '{"status":"0","users_affiliate_status":"0","affiliate_user_commission":"5","store_affiliate_user_commission":"5","affiliate_user_amount":"20","referred_user_amount":"10","referral_description":"Anda dapat membagikan URL afiliasi Anda, Anda akan mendapatkan hadiah di atas ketika seorang pengguna menggunakan platform."}',
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

            [
                'id' => 33,
                'setting_id' => 32,
                'locale' => 'id',
                'value' => json_encode([
                    'image' => '\\/store\\/1\\/default_images\\/home_sections_banners\\/instructor_finder_banner.jpg',
                    'title' => 'Temukan instruktur terbaik',
                    'description' => 'Mencari instruktur? Temukan instruktur terbaik sesuai dengan berbagai parameter seperti jenis kelamin, tingkat keterampilan, harga, jenis pertemuan, rating, dll.\\r\\nTemukan instruktur di peta.',
                    'button1' => ['title' => 'Pencari Guru', 'link' => '\\/instructor-finder\\/wizard'],
                    'button2' => ['title' => 'Guru di Peta', 'link' => '\\/instructor-finder'],
                ]),
            ],

            [
                'id' => 34,
                'setting_id' => 33,
                'locale' => 'id',
                'value' => json_encode([
                    'image' => "\/store\/1\/default_images\/home_sections_banners\/club_points_banner.png",
                    'title' => 'Menangkan Poin Klub',
                    'description' => "Gunakan Ciptapotensi dan menangkan poin klub sesuai dengan berbagai aktivitas.\r\nAnda akan dapat menggunakan poin klub Anda untuk mendapatkan hadiah gratis dan kursus. Mulai gunakan sistem sekarang dan kumpulkan poin!",
                    'button1' => ['title' => 'Hadiah', 'link' => "\/reward-courses"],
                    'button2' => ['title' => 'Klub Poin', 'link' => "\/panel\/rewards"],
                ]),
            ],

            [
                'id' => 41,
                'setting_id' => 40,
                'locale' => 'id',
                'value' => json_encode([
                    'image' => "\/store\/1\/default_images\/home_sections_banners\/become_instructor_banner.jpg",
                    'title' => 'Menjadi instruktur',
                    'description' => 'Apakah Anda tertarik untuk menjadi bagian dari komunitas kami? Anda dapat menjadi bagian dari komunitas kami dengan mendaftar sebagai instruktur atau organisasi.',
                    'button1' => ['title' => 'Menjadi Instruktur', 'link' => "\/become-instructor"],
                    'button2' => ['title' => 'Paket Pendaftaran', 'link' => "become-instructor\/packages\/"],
                ]),
            ],

            [
                'id' => 60,
                'setting_id' => 44,
                'locale' => 'id',
                'value' => json_encode([
                    'cookie_settings_modal_message' => '<p>Ketika Anda mengunjungi salah satu situs web kami, mungkin menyimpan atau mengambil informasi pada browser Anda, sebagian besar dalam bentuk cookie. Informasi ini mungkin tentang Anda, preferensi Anda, atau perangkat Anda dan sebagian besar digunakan untuk membuat situs bekerja sesuai yang Anda harapkan. Informasi tersebut biasanya tidak langsung mengidentifikasi Anda, tetapi dapat memberi Anda pengalaman web yang lebih personal. Karena kami menghargai hak privasi Anda, Anda dapat memilih untuk tidak mengizinkan beberapa jenis cookie. Klik pada judul kategori yang berbeda untuk mengetahui lebih lanjut dan mengelola preferensi Anda. Harap dicatat, bahwa memblokir beberapa jenis cookie dapat memengaruhi pengalaman Anda di situs dan layanan yang kami tawarkan.</p>',
                    'cookie_settings_modal_items' => [
                        'dDRjfkGvQfFzQJpa' => [
                            'title' => 'Perlu Tegas',
                            'description' => 'Cookie ini diperlukan agar situs web kami berfungsi dengan baik dan tidak dapat dinonaktifkan dalam sistem kami. Mereka biasanya hanya diatur sebagai respons terhadap tindakan yang Anda buat yang merupakan permintaan layanan, seperti mengatur preferensi privasi Anda, masuk, atau mengisi formulir, atau di mana mereka penting untuk menyediakan Anda dengan layanan yang Anda minta. Anda tidak dapat memilih keluar dari cookie ini. Anda dapat mengatur browser Anda untuk memblokir atau memberi tahu Anda tentang cookie ini, tetapi jika Anda melakukannya, beberapa bagian dari situs tidak akan berfungsi. Cookie ini tidak menyimpan informasi identifikasi pribadi apa pun.',
                            'required' => '1',
                        ],
                        'mOzJowgvTnWFlRzz' => [
                            'title' => 'Cookie Kinerja',
                            'description' => 'Cookie ini memungkinkan kami menghitung kunjungan dan sumber lalu lintas sehingga kami dapat mengukur dan meningkatkan kinerja situs kami. Mereka membantu kami untuk mengetahui halaman mana yang paling populer dan paling tidak populer dan melihat bagaimana pengunjung bergerak di sekitar situs, yang membantu kami mengoptimalkan pengalaman Anda. Semua informasi yang dikumpulkan cookie ini dikumpulkan dan karena itu anonim. Jika Anda tidak mengizinkan cookie ini, kami tidak akan dapat menggunakan data Anda dengan cara ini.',
                            'required' => '0',
                        ],
                        'XBMtdYaeSrqMicTH' => [
                            'title' => 'Cookie Fungsional',
                            'description' => 'Cookie ini memungkinkan situs web untuk menyediakan fungsionalitas dan personalisasi yang ditingkatkan. Mereka dapat diatur oleh kami atau oleh penyedia pihak ketiga yang layanannya kami tambahkan ke halaman kami. Jika Anda tidak mengizinkan cookie ini maka beberapa atau semua layanan ini mungkin tidak berfungsi dengan baik.',
                            'required' => '0',
                        ],
                        'XlLqzsvNpRqdcNWP' => [
                            'title' => 'Cookie Targeting',
                            'description' => 'Cookie ini dapat diatur melalui situs kami oleh mitra periklanan kami. Mereka dapat digunakan oleh perusahaan-perusahaan itu untuk membangun profil minat Anda dan menunjukkan kepada Anda iklan yang relevan di situs lain. Mereka tidak menyimpan informasi pribadi secara langsung tetapi didasarkan pada identifikasi unik browser dan perangkat internet Anda. Jika Anda tidak mengizinkan cookie ini, Anda akan mengalami iklan yang kurang terarah.',
                            'required' => '0',
                        ],
                    ],
                ]),
            ],

            [
                'id' => 63,
                'setting_id' => 43,
                'locale' => 'id',
                'value' => json_encode([
                    'image' => '\\/store\\/1\\/default_images\\/forums\\/forum_section.jpg',
                    'title' => 'Ada Pertanyaan? Tanyakan di forum dan dapatkan jawabannya',
                    'description' => 'Forum kami membantu Anda untuk membuat pertanyaan-pertanyaan Anda tentang berbagai subjek dan berkomunikasi dengan pengguna forum lainnya. Pengguna kami akan membantu Anda untuk mendapatkan jawaban terbaik!',
                    'button1' => ['title' => 'Buat topik baru', 'link' => '\\/forums\\/create-topic'],
                    'button2' => ['title' => 'Jelajahi forum', 'link' => '\\/forums'],
                ]),
            ],

            [
                'id' => 64,
                'setting_id' => 45,
                'locale' => 'id',
                'value' => json_encode([
                    'mobile_app_hero_image' => "\/store\/1\/default_images\/app_only.png",
                    'mobile_app_description' => '<div>Adalah halaman landing yang menakjubkan, modern, dan bersih untuk memamerkan aplikasi atau apa pun.<\\/div><div><br><\\/div><div>Sebuah aplikasi seluler atau aplikasi adalah program komputer atau aplikasi perangkat lunak yang dirancang untuk berjalan di perangkat seluler seperti ponsel, tablet, atau jam. Aplikasi seluler sering berbeda dengan aplikasi desktop yang dirancang untuk berjalan di komputer desktop, dan aplikasi web yang berjalan di browser web seluler daripada langsung di perangkat seluler.<\\/div>',
                    'mobile_app_buttons' => [
                        'htQgcSjzjLJlGRyY' => ['title' => 'Unduh dari Play Store', 'link' => 'https:\\/\\/play.google.com\\/store\\/games', 'icon' => "\/store\/1\/default_images\/google-play.png", 'color' => 'primary'],
                    ],
                ]),
            ],

            [
                'id' => 65,
                'setting_id' => 48,
                'locale' => 'id',
                'value' => json_encode([
                    'image' => "\/store\/1\/default_images\/ads_modal.png",
                    'title' => 'Kampanye Penjualan',
                    'description' => 'Kami memiliki kampanye penjualan pada kursus dan produk yang dipromosikan kami. Anda dapat membeli 150 produk dengan harga diskon hingga 50%.',
                    'button1' => ['title' => 'Lihat Kursus', 'link' => "\/classes"],
                    'button2' => ['title' => 'Lihat Produk', 'link' => "\/products"],
                ]),
            ],

            [
                'id' => 66,
                'setting_id' => 52,
                'locale' => 'id',
                'value' => json_encode([
                    'show_guarantee_text' => '1',
                    'guarantee_text' => 'Jaminan uang kembali 5 hari',
                    'user_avatar_style' => 'ui_avatar',
                    'default_user_avatar' => '/store/1/default_images/default_profile.jpg',
                    'platform_phone_and_email_position' => 'footer',
                ]),
            ],

            [
                'id' => 75,
                'setting_id' => 58,
                'locale' => 'id',
                'value' => json_encode([
                    'title' => 'Kami sedang dalam pemeliharaan!',
                    'image' => '\\/store\\/1\\/default_images\\/maintenance.png',
                    'description' => 'Kami sedang bekerja pada platform ini; Ini tidak akan memakan waktu lama. Kami akan mencoba kembali secepat mungkin.',
                    'maintenance_button' => ['title' => 'Tombol Contoh', 'link' => '\\/'],
                    'end_date' => 1740094200,
                ]),
            ],

            [
                'id' => 76,
                'setting_id' => 64,
                'locale' => 'id',
                'value' => json_encode([
                    'term_image' => "\/store\/1\/default_images\/registration bonus\/banner.png",
                    'items' => [
                        'DnrPr' => ['icon' => "\/store\/1\/default_images\/registration bonus\/step1.svg", 'title' => 'Daftar', 'description' => 'Buat akun di platform dan dapatkan $50'],
                        'eNMTB' => ['icon' => "\/store\/1\/default_images\/registration bonus\/step2.svg", 'title' => 'Referensikan teman-teman Anda', 'description' => 'Referensikan minimal 5 pengguna ke sistem menggunakan URL afiliasi Anda'],
                        'fdIUc' => ['icon' => "\/store\/1\/default_images\/registration bonus\/step3.svg", 'title' => 'Capai target pembelian', 'description' => 'Setiap pengguna yang dirujuk harus melakukan pembelian senilai $100 di platform'],
                        'oeMZr' => ['icon' => "\/store\/1\/default_images\/registration bonus\/step4.svg", 'title' => 'Buka kunci bonus Anda', 'description' => 'Bonus Anda akan terbuka! Nikmati pengeluaran...'],
                    ],
                ]),
            ],

            [
                'id' => 77,
                'setting_id' => 55,
                'locale' => 'id',
                'value' => json_encode([
                    'terms_description' => '<p>Selamat datang di website kami! Untuk memastikan pengalaman terbaik bagi semua pengguna, harap tinjau dan setujui syarat dan peraturan berikut sebelum menggunakan fitur angsuran kami:</p><p>Rencana Pembayaran Angsuran: Website kami menawarkan rencana pembayaran angsuran untuk beberapa kursus tertentu. Dengan memilih opsi pembayaran angsuran, Anda setuju untuk membayar biaya kursus penuh dalam beberapa angsuran. Setiap pembayaran angsuran akan secara otomatis dikurangkan dari metode pembayaran yang Anda berikan pada tanggal-tanggal yang telah dijadwalkan hingga pembayaran penuh selesai.</p><p>Biaya Rencana Pembayaran: Rencana pembayaran angsuran kami mungkin termasuk biaya pemrosesan kecil untuk setiap pembayaran angsuran. Total biaya pemrosesan akan diungkapkan kepada Anda sebelum Anda memilih opsi pembayaran angsuran.</p><p>Keterlambatan Pembayaran: Jika pembayaran tidak diterima pada tanggal yang dijadwalkan, biaya keterlambatan pembayaran dapat ditambahkan pada pembayaran berikutnya.</p><p>Refund: Setelah pembayaran angsuran dibuat, itu tidak dapat dikembalikan. Namun, jika Anda ingin membatalkan pendaftaran Anda dalam kursus, Anda mungkin memenuhi syarat untuk pengembalian dana sebagian sesuai dengan Kebijakan Pengembalian Dana kami.</p><p>Default: Jika Anda gagal membayar atau gagal menyelesaikan rencana pembayaran penuh, akses Anda ke kursus akan dicabut, dan Anda mungkin dikenakan biaya tambahan dan upaya penagihan.</p><p>Privasi: Informasi pribadi dan pembayaran Anda akan tetap aman dan rahasia. Kami menggunakan langkah-langkah keamanan standar industri untuk melindungi informasi Anda.</p><p>Perubahan pada Syarat dan Peraturan: Kami berhak untuk memodifikasi syarat dan peraturan ini kapan saja. Setiap perubahan akan diposting di website kami dan akan berlaku segera setelah diposting.</p><p>Dengan menggunakan rencana pembayaran angsuran kami, Anda setuju dengan syarat dan peraturan ini. Jika Anda memiliki pertanyaan atau kekhawatiran, silakan hubungi tim dukungan kami.</p>',
                ]),
            ],

            [
                'id' => 80,
                'setting_id' => 67,
                'locale' => 'id',
                'value' => '{"url_member_area":"admin"}',
            ],

        ];

        foreach ($data as $item) {
            SettingTranslation::updateOrCreate(
                ['id' => $item['id'], 'setting_id' => $item['setting_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
