<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                "name" => "Básico",
                "price"  => "10000"
            ],
            [
                "name" => "Pro",
                "price"  => "25000"
            ],
            [
                "name" => "Empresa",
                "price"  => "70000"
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
