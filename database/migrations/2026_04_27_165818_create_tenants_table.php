<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->string('unit_number');
            $table->decimal('monthly_rent', 10, 2);
            $table->date('lease_end');
            $table->string('status', 20)->default('active');
            $table->date('move_in_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};