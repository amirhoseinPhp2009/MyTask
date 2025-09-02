<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersProgressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 50;
        $reviewStatus = ['learn', 'forget'];

        for ($i=0; $i<$limit; $i++)
        {

            DB::table('users_progress')->insert([
                'user_id' => $faker->numberBetween(3, 52),
                'question_card_id' => $faker->numberBetween(1, 500),
                'last_review_date' => $faker->dateTimeBetween('-74 days')->format('Y-m-d'),
                'last_review_status' => 'learn',
                'next_review_date' => $faker->dateTimeBetween('-10 days')->format('Y-m-d'),
                'review_count' => 6,
                'interval' => 64
            ]);
        }
    }
}
