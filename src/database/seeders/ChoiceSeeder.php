<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('choices')->truncate();
        $now = CarbonImmutable::now();

        $params = [
            [
                'question_id' => 1,
                'name' => 'たかなわ',
                'is_valid' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 1,
                'name' => 'たかわ',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 1,
                'name' => 'こうわ',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 2,
                'name' => 'かめと',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 2,
                'name' => 'かめど',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 2,
                'name' => 'かめいど',
                'is_valid' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 3,
                'name' => 'むこうひら',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 3,
                'name' => 'むきひら',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 3,
                'name' => 'むかいなだ',
                'is_valid' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('choices')->insert($params);
    }
}
