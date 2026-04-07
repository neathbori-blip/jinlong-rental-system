<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;  // ← ADD THIS LINE

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::create([
            'landlord_id' => 1,
            'name' => 'Sunset Apartment',
            'address_line1' => 'Street 217',
            'address_line2' => 'Sangkat Toek Thla',
            'city' => 'Phnom Penh',
            'state' => 'Phnom Penh',
            'postal_code' => '120101',
            'country' => 'Cambodia',
            'property_type' => 'apartment',
            'total_units' => 5
        ]);

        Property::create([
            'landlord_id' => 1,
            'name' => 'Mekong Condo',
            'address_line1' => 'Street 371',
            'address_line2' => 'Sangkat Chroy Changvar',
            'city' => 'Phnom Penh',
            'state' => 'Phnom Penh',
            'postal_code' => '120202',
            'country' => 'Cambodia',
            'property_type' => 'condo',
            'total_units' => 10
        ]);

        Property::create([
            'landlord_id' => 2,
            'name' => 'Angkor Villa',
            'address_line1' => 'National Road 6',
            'address_line2' => 'Sangkat Svay Dangkum',
            'city' => 'Siem Reap',
            'state' => 'Siem Reap',
            'postal_code' => '170101',
            'country' => 'Cambodia',
            'property_type' => 'house',
            'total_units' => 3
        ]);
    }
}