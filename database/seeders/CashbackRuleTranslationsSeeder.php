<?php

namespace Database\Seeders;

use App\Models\Translation\CashbackRuleTranslation;
use Illuminate\Database\Seeder;

class CashbackRuleTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translations = [
            [
                'cashback_rule_id' => 5,
                'locale' => 'id',
                'title' => 'Christmas Cashback',
            ],
        ];

        foreach ($translations as $translation) {
            CashbackRuleTranslation::updateOrCreate(
                ['cashback_rule_id' => $translation['cashback_rule_id'], 'locale' => $translation['locale']],
                ['title' => $translation['title']]
            );
        }
    }
}
