<?php

namespace Database\Seeders;

use App\Models\Translation\TicketTranslation;
use Illuminate\Database\Seeder;

class TicketTranslationSeeder extends Seeder
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
                'ticket_id' => 28,
                'locale' => 'id',
                'title' => 'Penawaran Emas',
            ],
            [
                'id' => 2,
                'ticket_id' => 29,
                'locale' => 'id',
                'title' => 'Penawaran Perak',
            ],
            [
                'id' => 3,
                'ticket_id' => 30,
                'locale' => 'id',
                'title' => 'Penawaran Pertama untuk Peserta',
            ],
            [
                'id' => 4,
                'ticket_id' => 31,
                'locale' => 'id',
                'title' => 'Rencana Harga Pertama',
            ],
            [
                'id' => 5,
                'ticket_id' => 32,
                'locale' => 'id',
                'title' => 'Diskon',
            ],
        ];

        foreach ($data as $item) {
            TicketTranslation::updateOrCreate(
                ['id' => $item['id'], 'ticket_id' => $item['ticket_id'], 'locale' => $item['locale']],
                $item
            );
        }
    }
}
