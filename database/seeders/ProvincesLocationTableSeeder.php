<?php

namespace Database\Seeders;

use App\Services\RandomElementCreatorService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 100;
        $character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 0; $i < $limit; $i++) {
            $city_name = $faker->city;

            DB::table('locations')->insert([
                'name_fa' => $city_name,
                'name_en' => $city_name,
                'country_id' => $faker->numberBetween($min = 709, $max = 808),
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
    }
}
