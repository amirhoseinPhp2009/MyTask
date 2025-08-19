<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 500;
        $statusCards = ['active', 'inactive'];

        for ($i=0; $i<$limit; $i++)
        {
            DB::table('question_cards')->insert([
                'question' => $faker->text . ' ?',
                'answer' => $faker->text . ' .',
                'status' => $statusCards[$faker->numberBetween(0, 1)],
                'created_at' => $faker->dateTimeBetween('-5 year', '-1 year'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
