<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $this->call([
////            UsersTableSeeder::class,
////            CountriesLocationTableSeeder::class,
////            ProvincesLocationTableSeeder::class,
////            CitiesLocationTableSeeder::class,
////            ReservesTableSeeder::class,
//              GeneratingCountryIdToUsersTable::class
//        ]);

        $faker = \Faker\Factory::create();

        for ($i=0;$i<10;$i++) {
            DB::table('roles')->insert([
                'name' => $faker->name,
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now')
            ]);
        }
        for ($i=0;$i<100;$i++) {
            DB::table('users')->insert([
                'role_id' => $faker->numberBetween(1, 10),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);
        }
        for ($i=0;$i<100;$i++) {
            DB::table('products')->insert([
                'name' => $faker->name,
                'image' => $faker->url,
                'price' => $faker->numberBetween(100, 1000),
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now')
            ]);
        }
        for ($i=0;$i<100;$i++) {
            DB::table('product_price_category')->insert([
                'user_id' => $faker->numberBetween(1, 100),
                'product_id' => $faker->numberBetween(1, 100),
                'name' => $faker->name,
                'price' => $faker->numberBetween(50, 3000),
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now')
            ]);
        }
        for ($i=0;$i<100;$i++) {
            DB::table('user_product_price_category')->insert([
                'user_id' => $faker->numberBetween(1, 100),
                'product_id' => $faker->numberBetween(1, 100),
                'product_price_category_id' => $faker->numberBetween(1, 100),
                'created_at' => $faker->dateTimeBetween('-2 years', '-1 years'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now')
            ]);
        }


    }
}
