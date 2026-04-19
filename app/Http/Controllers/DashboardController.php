<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Tenant;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::count();
        $activeTenants = Tenant::where('status', 'active')->count();
        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereMonth('payment_date', now()->month)
            ->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->count();
        
        $recentProperties = Property::with('tenant')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($property) {
                $property->tenant_name = $property->tenant ? $property->tenant->name : null;
                return $property;
            });
        
        return view('dashboard', compact(
            'totalProperties', 
            'activeTenants', 
            'monthlyRevenue', 
            'pendingPayments',
            'recentProperties'
        ));
    }
}