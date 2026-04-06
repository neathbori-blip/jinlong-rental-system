<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('unit_number');
            $table->integer('bedrooms')->default(0);
            $table->decimal('bathrooms', 3, 1)->default(0);
            $table->integer('square_feet')->nullable();
            $table->decimal('monthly_rent', 10, 2);
            $table->decimal('security_deposit', 10, 2)->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            
            $table->unique(['property_id', 'unit_number']);
            $table->index('property_id');
            $table->index('is_available');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};