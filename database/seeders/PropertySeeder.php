<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::create([
            'name' => 'Sunset Apartment',
            'location' => 'Downtown',
            'price' => 1500,
            'status' => 'active',
            'description' => 'Beautiful 2 bedroom apartment',
            'bedrooms' => 2,
            'bathrooms' => 1
        ]);
        
        Property::create([
            'name' => 'Ocean View Villa',
            'location' => 'Beachside',
            'price' => 2500,
            'status' => 'active',
            'description' => 'Luxury villa with ocean view',
            'bedrooms' => 3,
            'bathrooms' => 2
        ]);
        
        Property::create([
            'name' => 'City Center Studio',
            'location' => 'City Center',
            'price' => 900,
            'status' => 'pending',
            'description' => 'Cozy studio in the heart of the city',
            'bedrooms' => 1,
            'bathrooms' => 1
        ]);
    }
}