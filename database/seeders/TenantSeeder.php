<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;  // ← ADD THIS LINE

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::create([
            'user_id' => 3,
            'date_of_birth' => '1990-05-15',
            'emergency_contact_name' => 'Mom',
            'emergency_contact_phone' => '098888888',
            'government_id' => 'ID-001'
        ]);

        Tenant::create([
            'user_id' => 4,
            'date_of_birth' => '1995-08-20',
            'emergency_contact_name' => 'Dad',
            'emergency_contact_phone' => '097777777',
            'government_id' => 'ID-002'
        ]);
    }
}