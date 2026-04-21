<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;  // ← ADD THIS LINE

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Payments for lease 1
        Payment::create([
            'lease_id' => 1,
            'amount' => 250,
            'payment_date' => '2024-01-01',
            'due_date' => '2024-01-01',
            'payment_method' => 'bank_transfer',
            'status' => 'completed',
            'transaction_id' => 'TXN-001',
            'notes' => 'January rent'
        ]);

        Payment::create([
            'lease_id' => 1,
            'amount' => 250,
            'payment_date' => '2024-02-01',
            'due_date' => '2024-02-01',
            'payment_method' => 'bank_transfer',
            'status' => 'completed',
            'transaction_id' => 'TXN-002',
            'notes' => 'February rent'
        ]);

        Payment::create([
            'lease_id' => 1,
            'amount' => 250,
            'payment_date' => null,
            'due_date' => '2024-03-01',
            'payment_method' => null,
            'status' => 'pending',
            'transaction_id' => null,
            'notes' => 'March rent - overdue'
        ]);

        // Payments for lease 2
        Payment::create([
            'lease_id' => 2,
            'amount' => 300,
            'payment_date' => '2024-02-01',
            'due_date' => '2024-02-01',
            'payment_method' => 'cash',
            'status' => 'completed',
            'transaction_id' => 'TXN-003',
            'notes' => 'February rent'
        ]);

        Payment::create([
            'lease_id' => 2,
            'amount' => 300,
            'payment_date' => '2024-03-01',
            'due_date' => '2024-03-01',
            'payment_method' => 'cash',
            'status' => 'completed',
            'transaction_id' => 'TXN-004',
            'notes' => 'March rent'
        ]);
    }
}