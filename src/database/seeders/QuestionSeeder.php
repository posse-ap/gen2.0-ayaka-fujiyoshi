<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        $now = CarbonImmutable::now();

        $params = [
            [
                'big_question_id' => 1,
                'image' => 'takanawa.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'big_question_id' => 1,
                'image' => 'kameido.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'big_question_id' => 2,
                'image' => 'mukainada.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('questions')->insert($params);
    }
}
