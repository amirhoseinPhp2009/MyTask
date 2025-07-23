<?php

namespace Database\Seeders;

use App\Services\RandomElementCreatorService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 2000;
        $character = "ABCDEFGHIJKLMNOPQRSTUVW0123456789@#$%&*";

        for ($i = 0; $i < $limit; $i++) {
            $time = $faker->dateTimeBetween('-1 years', 'now');

            DB::table('reserves')->insert([
                'user_id' => $faker->numberBetween(3, 900),
                'origin_city_id' => $faker->numberBetween(909, 950),
                'destination_city_id' => $faker->numberBetween(951, 1008),
                'purchase_price' => round($faker->numberBetween(500000, 2000000)),
                'sell_price' => round($faker->numberBetween(2000000, 20000000)),
                'tracking_code' => RandomElementCreatorService::randomStringFrom($character, 19, 0, 24),
                'check_in' => $faker->dateTime()->format('2025-07-09 H:i:s'),
                'check_out' => $faker->dateTime()->format('2025-07-15 H:i:s'),
                'total_adult_count' => $faker->numberBetween(1, 3),
                'total_children_count' => $faker->numberBetween(1, 2),
                'status' => 'cancelled_by_user',
                'cancelled_at' => $faker->dateTime()->format('2025-07-08 H:i:s'),
                'paid_at' => $faker->dateTime()->format('2025-07-05 18:50:s'),
                'booked_at' => $faker->dateTime()->format('2025-07-5 19:20:s'),
                'created_at' => $faker->dateTime()->format('2025-07-5 18:30:s'),
                'updated_at' => $faker->dateTime()->format('2025-07-5 18:40:s'),
            ]);
        }
    }
}
