<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_tenants_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone', 20)->nullable();
            $table->string('unit', 50);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->date('lease_start_date')->nullable();
            $table->decimal('monthly_rent', 10, 2)->default(0);
            $table->decimal('security_deposit', 10, 2)->default(0);
            $table->text('address')->nullable();
            $table->text('emergency_contact')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};