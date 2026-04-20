<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lease;  // ← ADD THIS LINE

class LeaseSeeder extends Seeder
{
    public function run(): void
    {
        Lease::create([
            'unit_id' => 1,
            'tenant_id' => 1,
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'monthly_rent' => 250,
            'security_deposit_paid' => 250,
            'status' => 'active',
            'signed_by_tenant' => true,
            'signed_by_landlord' => true
        ]);

        Lease::create([
            'unit_id' => 4,
            'tenant_id' => 2,
            'start_date' => '2024-02-01',
            'end_date' => '2025-01-31',
            'monthly_rent' => 300,
            'security_deposit_paid' => 300,
            'status' => 'active',
            'signed_by_tenant' => true,
            'signed_by_landlord' => true
        ]);

        Lease::create([
            'unit_id' => 7,
            'tenant_id' => 1,
            'start_date' => '2023-03-01',
            'end_date' => '2024-02-28',
            'monthly_rent' => 600,
            'security_deposit_paid' => 600,
            'status' => 'expired',
            'signed_by_tenant' => true,
            'signed_by_landlord' => true
        ]);
    }
}