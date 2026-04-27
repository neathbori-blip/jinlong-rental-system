<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Tenant;
use App\Models\Property;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leases = Lease::with(['tenant', 'property'])->latest()->paginate(9);
        $activeLeases = Lease::where('status', 'active')->count();
        $expiringSoon = Lease::where('status', 'active')
                             ->where('end_date', '<=', now()->addDays(30))
                             ->count();
        $totalDeposits = Lease::sum('deposit_amount');
        $totalMonthlyRent = Lease::where('status', 'active')->sum('monthly_rent');

        return view('leases.index', compact('leases', 'activeLeases', 'expiringSoon', 'totalDeposits', 'totalMonthlyRent'));
    }

    public function create()
    {
        $tenants = Tenant::all();
        $properties = Property::all();
        return view('leases.create', compact('tenants', 'properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'property_id' => 'required|exists:properties,id',
            'unit_number' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,terminated',
            'notes' => 'nullable|string',
        ]);

        Lease::create($validated);

        return redirect()->route('leases.index')
                         ->with('success', 'Lease created successfully!');
    }

    public function show(Lease $lease)
    {
        $lease->load(['tenant', 'property']);
        return view('leases.show', compact('lease'));
    }

    public function edit(Lease $lease)
    {
        $tenants = Tenant::all();
        $properties = Property::all();
        return view('leases.edit', compact('lease', 'tenants', 'properties'));
    }

    public function update(Request $request, Lease $lease)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'property_id' => 'required|exists:properties,id',
            'unit_number' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,terminated',
            'notes' => 'nullable|string',
        ]);

        $lease->update($validated);

        return redirect()->route('leases.index')
                         ->with('success', 'Lease updated!');
    }

    public function destroy(Lease $lease)
    {
        $lease->delete();
        return redirect()->route('leases.index')
                         ->with('success', 'Lease deleted.');
    }
}