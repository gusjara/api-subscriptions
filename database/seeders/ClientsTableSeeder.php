<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create('es_AR');
        $total = 10;

        for ($i = 1; $i <= $total; $i++) {
            Client::create([
                'name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
            ]);
        }
    }
}
