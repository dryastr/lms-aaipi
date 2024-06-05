<?php

namespace Database\Seeders;

use App\Models\Resources;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'id' => 75,
                'user_id' => 1,
                'title' => 'Panduan Audit Keuangan untuk Bisnis Kecil: Langkah-langkah Penting dan Tips Praktis',
                'seotitle' => 'Panduan Audit Keuangan untuk Bisnis Kecil',
                'description' => 'Panduan ini menyajikan langkah-langkah penting untuk melakukan audit keuangan yang efektif bagi bisnis kecil. Dari pemahaman dasar tentang audit hingga implementasi strategi audit yang praktis, panduan ini akan membantu Anda memastikan kepatuhan finansial dan mengidentifikasi potensi perbaikan dalam proses keuangan bisnis Anda.',
                'cover' => '/store/1/cover_image1.jpg',
                'category_id' => 605,
                'type_other_category_id' => 15,
                'crosscom_tematik_other_category_id' => 13,
                'source' => 'public/files/audit_keuangan_bisnis_kecil.pdf',
                'filename' => 'audit_keuangan_bisnis_kecil.pdf',
                'size' => 1024,
                'ext' => 'pdf',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 72,
                'user_id' => 1,
                'title' => 'Panduan Audit Keamanan TI: Langkah-langkah Perlindungan Data dan Evaluasi Risiko',
                'seotitle' => 'Panduan Audit Keamanan TI',
                'description' => 'Panduan ini membahas langkah-langkah kunci dalam melakukan audit keamanan TI untuk melindungi data sensitif dan mengidentifikasi potensi ancaman keamanan. Dari mengevaluasi risiko keamanan hingga mengimplementasikan langkah-langkah mitigasi, panduan ini akan membantu perusahaan menjaga keamanan informasi mereka dan meminimalkan risiko keamanan.',
                'cover' => '/store/1/cover_image2.jpg',
                'category_id' => 610,
                'type_other_category_id' => 15,
                'crosscom_tematik_other_category_id' => 14,
                'source' => 'public/files/audit_keamanan_TI.pdf',
                'filename' => 'audit_keamanan_TI.pdf',
                'size' => 2048,
                'ext' => 'pdf',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $item) {
            Resources::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }
    }
}
