<?php

namespace Database\Seeders;

use App\Models\Translation\CertificateTemplateTranslation;
use Illuminate\Database\Seeder;

class CertificateTemplateTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CertificateTemplateTranslation::updateOrCreate(
            ['id' => 1],
            [
                'certificate_template_id' => 1,
                'locale' => 'id',
                'title' => 'Template Sertifikat Bergantung pada Kuis',
                'body' => 'Sertifikat ini diberikan kepada [student] \r\n mengenai lulus [course] dengan \r\n [grade] dengan sukses\r\n ID Sertifikat : [certificate_id]',
                'rtl' => 0,
            ]
        );

        CertificateTemplateTranslation::updateOrCreate(
            ['id' => 3],
            [
                'certificate_template_id' => 2,
                'locale' => 'id',
                'title' => 'Template Sertifikat Penyelesaian',
                'body' => 'Sertifikat ini diberikan kepada [student] \r\n mengenai menyelesaikan kursus [course] dengan \r\n sukses selama [duration] menit.\r\n ID Sertifikat : [certificate_id]',
                'rtl' => 0,
            ]
        );
    }
}
