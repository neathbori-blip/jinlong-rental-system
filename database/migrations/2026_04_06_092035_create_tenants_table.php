<?php
// database/migrations/2024_01_01_000000_create_tenants_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('unit');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->date('lease_start_date')->nullable();
            $table->decimal('monthly_rent', 10, 2)->default(0);
            $table->decimal('security_deposit', 10, 2)->default(0);
            $table->text('address')->nullable();
            $table->text('emergency_contact')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};