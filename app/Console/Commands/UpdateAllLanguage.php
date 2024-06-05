<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateAllLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-all-language';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tables = [
            'advertising_banners_translations',
            'badge_translations',
            'blog_translations',
            'bundle_translations',
            'cashback_rule_translations',
            'category_translations',
            'certificate_template_translations',
            'faq_translations',
            'feature_webinar_translations',
            'file_translations',
            'filter_option_translations',
            'filter_translations',
            'floating_bar_translations',
            'forum_translations',
            'home_page_statistic_translations',
            'installment_step_translations',
            'installment_translations',
            'navbar_button_translations',
            'offline_bank_specification_translations',
            'offline_bank_translations',
            'page_translations',
            'product_category_translations',
            'product_faq_translations',
            'product_file_translations',
            'product_filter_option_translations',
            'product_filter_translations',
            'product_selected_specification_translations',
            'product_specification_multi_value_translations',
            'product_specification_translations',
            'product_translations',
            'promotion_translations',
            'quiz_question_translations',
            'quiz_translations',
            'quizzes_questions_answer_translations',
            'registration_packages_translations',
            'session_translations',
            'setting_translations',
            'subscribe_translations',
            'support_department_translations',
            'testimonial_translations',
            'text_lesson_translations',
            'ticket_translations',
            'upcoming_course_translations',
            'user_bank_specification_translations',
            'user_bank_translations',
            'webinar_assignment_translations',
            'webinar_chapter_translations',
            'webinar_extra_description_translations',
            'webinar_translations',
        ];

        foreach ($tables as $table) {
            \DB::table($table)
                ->where('locale', 'en')
                ->update([
                    'locale' => 'id',
                ]);

            \DB::table($table)
                ->where('locale', '!=', 'en')
                ->where('locale', '!=', 'id')
                ->delete();
        }
    }
}
