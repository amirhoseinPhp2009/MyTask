<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table("room_prices")->insert([
                'room_id' => $faker->numberBetween(11, 20),
                'check_in' => $faker->dateTimeBetween('-10 days', '-5 days')->format('Y-m-d'),
                'check_out' => $faker->dateTimeBetween('-5 days', '-1 days')->format('Y-m-d'),
                'purchase_price' => $faker->numberBetween(1000, 100000),
                'sell_price' => $faker->numberBetween(100000, 1000000),
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
    }
}
