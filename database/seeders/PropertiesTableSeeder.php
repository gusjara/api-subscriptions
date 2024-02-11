<?php

namespace Database\Seeders;

use App\Models\Property;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('es_AR');
        $total = 10;

        for ($i = 1; $i <= $total; $i++) {
            Property::create([
                'name' => $faker->company(),
                'type' => rand(0, 1) ? 'Barrio' : 'Edificio',
                'address' => $faker->streetAddress(),
                'postal_code' => $faker->postcode(),
                'city' => $faker->city(),
                'contact_email' => $faker->email(),
                // 'client_id' => $i,
            ]);
        }
    }
}
