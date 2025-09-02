<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {

            DB::table('users')->insert([
                'role_id' => 1,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'password' => $faker->password,
                'daily_read_count' => $faker->numberBetween(1,6),
                'created_at' => $faker->dateTimeBetween('-5 year', '-1 year'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
