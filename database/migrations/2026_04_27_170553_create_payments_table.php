// database/migrations/xxxx_create_payments_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->string('payment_method', 50); // cash, bank transfer, credit card
            $table->string('receipt_number')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['paid', 'pending', 'failed'])->default('paid');
            $table->timestamps();

            $table->index('tenant_id');
            $table->index('payment_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};