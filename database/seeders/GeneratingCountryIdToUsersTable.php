<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneratingCountryIdToUsersTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $users = User::all();

        foreach ($users as $user) {
            $randomCountryId = $faker->numberBetween(709, 808);
            $user->update(['country_id' => $randomCountryId]);
        }

    }
}
