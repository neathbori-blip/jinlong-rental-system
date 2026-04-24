<?php
// app/Http/Controllers/TenantController.php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    // Display a listing of tenants
    public function index()
    {
        // Make sure these variables are defined even if no data ex
        // Return the view with all variables
        return view('tenants.index');
    }

    // Store a newly created tenant
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'nullable|string|max:20',
            'unit' => 'required|string|max:50',
            'status' => 'required|in:active,inactive',
            'lease_start_date' => 'nullable|date',
            'monthly_rent' => 'nullable|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'address' => 'nullable|string',
            'emergency_contact' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tenant = Tenant::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tenant created successfully!',
            'tenant' => $tenant
        ]);
    }

    // Display the specified tenant
    public function show($id)
    {
        $tenant = Tenant::findOrFail($id);
        return response()->json($tenant);
    }

    // Update the specified tenant
    public function update(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'unit' => 'required|string|max:50',
            'status' => 'required|in:active,inactive',
            'lease_start_date' => 'nullable|date',
            'monthly_rent' => 'nullable|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'address' => 'nullable|string',
            'emergency_contact' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tenant->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tenant updated successfully!',
            'tenant' => $tenant
        ]);
    }

    // Remove the specified tenant
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tenant deleted successfully!'
        ]);
    }
}