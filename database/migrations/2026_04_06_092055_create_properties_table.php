<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landlord_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country');
            $table->enum('property_type', ['apartment', 'house', 'condo', 'commercial'])->nullable();
            $table->integer('total_units')->default(1);
            $table->timestamps();
            
            $table->index('landlord_id');
            $table->index('city');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};