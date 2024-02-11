<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = 10;

        for ($i = 1; $i <= $total; $i++) {
            Subscription::create([
                'property_id' => $i,
                'plan_id' => rand(1, 3),
                'payment_type' => rand(0, 1) ? 'debito_cbu' : 'tarjeta',
                'status' => true,
                'init_date' => '2024-02-01',
                'end_date' => '2025-01-31',
            ]);
        }
    }
}
