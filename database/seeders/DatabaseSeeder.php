<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Order matters for foreign keys!
        $this->call([
            UserSeeder::class,
            TenantSeeder::class,
            PropertySeeder::class,
            UnitSeeder::class,
            LeaseSeeder::class,
            PaymentSeeder::class,
            MaintenanceRequestSeeder::class,
        ]);
    }
}