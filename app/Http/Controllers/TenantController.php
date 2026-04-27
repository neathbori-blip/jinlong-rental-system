<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Property;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('property')->latest()->paginate(10);
        $totalTenants = Tenant::count();
        $activeLeases = Tenant::where('status', 'active')->count();
        $pendingPayments = Tenant::where('lease_end', '<', now()->addDays(30))->count();
        $avgRent = Tenant::avg('monthly_rent') ?? 0;

        return view('tenants.index', compact('tenants', 'totalTenants', 'activeLeases', 'pendingPayments', 'avgRent'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('tenants.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants',
            'phone' => 'required|string',
            'property_id' => 'required|exists:properties,id',
            'unit_number' => 'required|string',
            'monthly_rent' => 'required|numeric|min:0',
            'lease_end' => 'required|date',
            'status' => 'required|in:active,pending,inactive',
            'move_in_date' => 'required|date',
        ]);

        Tenant::create($validated);

        return redirect()->route('tenants.index')
                         ->with('success', 'Tenant added successfully!');
    }

    public function show(Tenant $tenant)
    {
        $tenant->load('property');
        return view('tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        $properties = Property::all();
        return view('tenants.edit', compact('tenant', 'properties'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
            'phone' => 'required|string',
            'property_id' => 'required|exists:properties,id',
            'unit_number' => 'required|string',
            'monthly_rent' => 'required|numeric|min:0',
            'lease_end' => 'required|date',
            'status' => 'required|in:active,pending,inactive',
            'move_in_date' => 'required|date',
        ]);

        $tenant->update($validated);

        return redirect()->route('tenants.index')
                         ->with('success', 'Tenant updated successfully!');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenants.index')
                         ->with('success', 'Tenant deleted successfully!');
    }
}