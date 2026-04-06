<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lease_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->date('due_date');
            $table->enum('payment_method', ['credit_card', 'bank_transfer', 'cash', 'check'])->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('lease_id');
            $table->index('status');
            $table->index('payment_date');
            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};