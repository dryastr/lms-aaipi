<?php

namespace Database\Seeders;

use App\Models\Translation\FilterTranslation;
use Illuminate\Database\Seeder;

class FilterTranslationSeeder extends Seeder
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
                'filter_id' => 1805,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1806,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1807,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1808,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1809,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1810,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1811,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1812,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1813,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1814,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1815,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1816,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1817,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1818,
                'locale' => 'id',
                'title' => 'Tingkat',
            ],
            [
                'filter_id' => 1819,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1820,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1821,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1822,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1823,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1824,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1825,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1826,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1827,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1829,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1830,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1831,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1832,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1833,
                'locale' => 'id',
                'title' => 'Bahasa',
            ],
            [
                'filter_id' => 1834,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1835,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1836,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1837,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1838,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1839,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1840,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1841,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1842,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1843,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1844,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1845,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1846,
                'locale' => 'id',
                'title' => 'Topik',
            ],
            [
                'filter_id' => 1847,
                'locale' => 'id',
                'title' => 'Topik',
            ],
        ];

        foreach ($data as $filter) {
            FilterTranslation::updateOrCreate([
                'filter_id' => $filter['filter_id'],
                'locale' => $filter['locale'],
            ], [
                'title' => $filter['title'],
            ]);
        }
    }
}
