<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaintenanceRequest;  // ← ADD THIS LINE

class MaintenanceRequestSeeder extends Seeder
{
    public function run(): void
    {
        MaintenanceRequest::create([
            'unit_id' => 1,
            'tenant_id' => 1,
            'title' => 'Air conditioner not working',
            'description' => 'AC is not cooling, please fix',
            'priority' => 'high',
            'status' => 'in_progress',
            'submitted_at' => '2024-02-15 09:00:00',
            'resolved_at' => null,
            'estimated_cost' => 50,
            'actual_cost' => null,
            'assigned_to' => null
        ]);

        MaintenanceRequest::create([
            'unit_id' => 1,
            'tenant_id' => 1,
            'title' => 'Water leak',
            'description' => 'Water leaking from bathroom sink',
            'priority' => 'medium',
            'status' => 'completed',
            'submitted_at' => '2024-01-10 14:30:00',
            'resolved_at' => '2024-01-12 10:00:00',
            'estimated_cost' => 30,
            'actual_cost' => 25,
            'assigned_to' => null
        ]);

        MaintenanceRequest::create([
            'unit_id' => 4,
            'tenant_id' => 2,
            'title' => 'Light bulb burned out',
            'description' => 'Living room light not working',
            'priority' => 'low',
            'status' => 'submitted',
            'submitted_at' => '2024-03-01 08:00:00',
            'resolved_at' => null,
            'estimated_cost' => 5,
            'actual_cost' => null,
            'assigned_to' => null
        ]);

        MaintenanceRequest::create([
            'unit_id' => 7,
            'tenant_id' => 1,
            'title' => 'Emergency: No electricity',
            'description' => 'Entire unit has no power',
            'priority' => 'emergency',
            'status' => 'completed',
            'submitted_at' => '2023-12-20 19:00:00',
            'resolved_at' => '2023-12-20 21:00:00',
            'estimated_cost' => 100,
            'actual_cost' => 80,
            'assigned_to' => null
        ]);

        MaintenanceRequest::create([
            'unit_id' => 7,
            'tenant_id' => 1,
            'title' => 'Broken window',
            'description' => 'Window glass cracked',
            'priority' => 'high',
            'status' => 'cancelled',
            'submitted_at' => '2024-01-05 11:00:00',
            'resolved_at' => '2024-01-06 09:00:00',
            'estimated_cost' => 60,
            'actual_cost' => null,
            'assigned_to' => null
        ]);
    }
}