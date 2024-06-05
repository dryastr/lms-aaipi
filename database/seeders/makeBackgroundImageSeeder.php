<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class makeBackgroundImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'setting_id' => 14,
            'locale' => 'en',
            'value' => '{"admin_login":"/store/1/default_images/admin_login_new.jpg","admin_dashboard":"/store/1/default_images/admin_dashboard_new.jpg","login":"/store/1/default_images/img_cover.png","register":"/store/1/default_images/front_register.jpg","remember_pass":"/store/1/default_images/password_recovery.jpg","verification":"/store/1/default_images/verification.jpg","search":"/store/1/default_images/search_cover.png","categories":"/store/1/default_images/category_cover.png","become_instructor":"/store/1/default_images/become_instructor.jpg","certificate_validation":"/store/1/default_images/certificate_validation_new.jpg","blog":"/store/1/default_images/img_cover.png","instructors":"/store/1/default_images/img_cover.png","organizations":"/store/1/default_images/organizations_cover.png","dashboard":"/store/1/dashboard_new.png","user_cover":"/store/1/default_images/default_cover.jpg","instructor_finder_wizard":"/store/1/default_images/instructor_finder_wizard.jpg","products_lists":"/store/1/default_images/category_cover.png","upcoming_courses_lists":"/store/1/default_images/p"}',
        ];

        DB::table('setting_translations')->updateOrInsert(
            ['setting_id' => 14, 'locale' => 'en'],
            $data
        );

    }
}
