<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $now = CarbonImmutable::now();

        $params = [
            [
                'name' => 'test+1',
                'email' => 'test+1@posse-ap.com',
                'password' => Hash::make('password'),
                'is_admin'=> true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'test+2',
                'email' => 'test+2@posse-ap.com',
                'password' => Hash::make('password'),
                'is_admin'=> false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('users')->insert($params);
    }
}
