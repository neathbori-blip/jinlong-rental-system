<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rents')->insert([
            [
                'item_name' => 'Laptop',
                'customer_name' => 'John Doe',
                'rental_days' => 5,
                'total_price' => 250.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Projector',
                'customer_name' => 'Jane Smith',
                'rental_days' => 3,
                'total_price' => 150.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}