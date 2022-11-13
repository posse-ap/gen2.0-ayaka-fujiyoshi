<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BigQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('big_questions')->truncate();

        $now = CarbonImmutable::now();

        $params = [
            [
                'name' => '東京の難読地名クイズ',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '広島の難読地名クイズ',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('big_questions')->insert($params);
    }
}
