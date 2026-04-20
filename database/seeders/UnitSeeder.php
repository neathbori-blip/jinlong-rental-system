<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;  // ← ADD THIS LINE

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        // Units for Sunset Apartment (property_id = 1)
        Unit::create([
            'property_id' => 1,
            'unit_number' => '101',
            'bedrooms' => 1,
            'bathrooms' => 1,
            'square_feet' => 450,
            'monthly_rent' => 250,
            'security_deposit' => 250,
            'is_available' => false
        ]);

        Unit::create([
            'property_id' => 1,
            'unit_number' => '102',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'square_feet' => 650,
            'monthly_rent' => 350,
            'security_deposit' => 350,
            'is_available' => true
        ]);

        Unit::create([
            'property_id' => 1,
            'unit_number' => '103',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'square_feet' => 800,
            'monthly_rent' => 450,
            'security_deposit' => 450,
            'is_available' => true
        ]);

        // Units for Mekong Condo (property_id = 2)
        Unit::create([
            'property_id' => 2,
            'unit_number' => '5A',
            'bedrooms' => 1,
            'bathrooms' => 1,
            'square_feet' => 500,
            'monthly_rent' => 300,
            'security_deposit' => 300,
            'is_available' => false
        ]);

        Unit::create([
            'property_id' => 2,
            'unit_number' => '5B',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'square_feet' => 750,
            'monthly_rent' => 500,
            'security_deposit' => 500,
            'is_available' => true
        ]);

        Unit::create([
            'property_id' => 2,
            'unit_number' => '6A',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'square_feet' => 1000,
            'monthly_rent' => 700,
            'security_deposit' => 700,
            'is_available' => true
        ]);

        // Units for Angkor Villa (property_id = 3)
        Unit::create([
            'property_id' => 3,
            'unit_number' => 'V1',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'square_feet' => 1200,
            'monthly_rent' => 600,
            'security_deposit' => 600,
            'is_available' => false
        ]);

        Unit::create([
            'property_id' => 3,
            'unit_number' => 'V2',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'square_feet' => 1500,
            'monthly_rent' => 800,
            'security_deposit' => 800,
            'is_available' => true
        ]);
    }
}