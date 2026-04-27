<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();          // e.g. MR-1001
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('set null');
            $table->string('unit_number');
            $table->string('issue_type');                        // Plumbing, Electrical, etc.
            $table->string('priority');                          // urgent, high, medium, low
            $table->text('description');
            $table->date('reported_date');
            $table->string('assigned_to')->nullable();           // technician name
            $table->enum('status', ['open', 'in-progress', 'review', 'completed', 'cancelled'])->default('open');
            $table->date('completed_date')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('priority');
            $table->index('reported_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_requests');
    }
};