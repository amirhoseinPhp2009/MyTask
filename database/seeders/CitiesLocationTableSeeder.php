<?php

namespace Database\Seeders;

use App\Services\RandomElementCreatorService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 100;
        $character = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($i = 0; $i < $limit; $i++) {
            $city_name = $faker->city;
            $country_iso_code = RandomElementCreatorService::randomStringFrom($character, 3, 0, 24);
            DB::table('locations')->insert([
                'name_fa' => $city_name,
                'name_en' => $city_name,
                'country_id' => $faker->numberBetween($min = 1, $max = 34),
                'province_id' => $faker->numberBetween($min = 34, $max = 166),
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
    }
}
