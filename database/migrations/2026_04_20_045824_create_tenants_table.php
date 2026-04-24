<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('tenants', 'monthly_rent')) {
                $table->decimal('monthly_rent', 10, 2)->default(0)->after('lease_start_date');
            }
            
            if (!Schema::hasColumn('tenants', 'security_deposit')) {
                $table->decimal('security_deposit', 10, 2)->default(0)->after('monthly_rent');
            }
            
            if (!Schema::hasColumn('tenants', 'address')) {
                $table->text('address')->nullable()->after('security_deposit');
            }
            
            if (!Schema::hasColumn('tenants', 'emergency_contact')) {
                $table->text('emergency_contact')->nullable()->after('address');
            }
            
            if (!Schema::hasColumn('tenants', 'notes')) {
                $table->text('notes')->nullable()->after('emergency_contact');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'monthly_rent',
                'security_deposit', 
                'address',
                'emergency_contact',
                'notes'
            ]);
        });
    }
};