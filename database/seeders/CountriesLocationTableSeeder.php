<?php

namespace Database\Seeders;

use App\Services\RandomElementCreatorService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesLocationTableSeeder extends Seeder
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
            $country_name = $faker->country;
            $country_iso_code = RandomElementCreatorService::randomStringFrom($character);

            DB::table('locations')->insert([
                'name_fa' => $country_name,
                'name_en' => $country_name,
                'country_iso_code' => $country_iso_code,
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);

        }
    }


}
