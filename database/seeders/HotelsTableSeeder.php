<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 1;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('hotels')->insert([
                'city_id' => $faker->numberBetween(167, 266),
                'name' => $faker->name,
                'check_in' => $faker->numberBetween(7, 10),
                'check_out' => $faker->numberBetween(18, 23),
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
    }
}
