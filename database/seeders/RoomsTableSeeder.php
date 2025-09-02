<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 10;
        $roomTypes = ['Single', 'Double', 'Twin', 'Triple', 'Quad', 'Suite', 'Family Room', 'Deluxe', 'Accessible'];

        for ($i = 0; $i < $limit; $i++) {
            DB::table('rooms')->insert([
                'hotel_id' => 4,
                'rate_plan_id' => $faker->numberBetween(1, 5),
                'room_type' => $roomTypes[rand(0, 8)],
                'description' => $faker->text,
                'room_number' => $faker->numberBetween(1, 1000),
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
    }
}
