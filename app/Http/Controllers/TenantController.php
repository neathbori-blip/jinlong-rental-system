<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    /**
     * Display all tenants (GET request)
     */
    public function index()
    {
        // Get all tenants from database
        $tenants = Tenant::orderBy('created_at', 'desc')->get();
        
        // Calculate statistics (using only existing columns)
        $totalTenants = Tenant::count();
        $activeTenants = Tenant::where('status', 'active')->count();
        
        // If monthly_rent doesn't exist, use 0 or alternative
       
        
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Store new tenant (POST request)
     */
    public function store(Request $request)
    {
        // Validate only existing columns
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'nullable|string|max:20',
            'unit' => 'required|string|max:50',
            'status' => 'required|in:active,inactive',
            'lease_start_date' => 'nullable|date',
            // Remove monthly_rent validation if column doesn't exist
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Only use columns that exist in your table
        $tenantData = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'unit' => $request->unit,
            'status' => $request->status,
            'lease_start_date' => $request->lease_start_date,
        ];
        
        // Add only if column exists
        if (Schema::hasColumn('tenants', 'monthly_rent')) {
            $tenantData['monthly_rent'] = $request->monthly_rent ?? 0;
        }
        
        if (Schema::hasColumn('tenants', 'security_deposit')) {
            $tenantData['security_deposit'] = $request->security_deposit ?? 0;
        }

        $tenant = Tenant::create($tenantData);

        return response()->json([
            'success' => true,
            'message' => 'Tenant created successfully!',
            'tenant' => $tenant
        ], 201);
    }

    /**
     * Get single tenant
     */
    public function show($id)
    {
        $tenant = Tenant::findOrFail($id);
        return response()->json($tenant);
    }

    /**
     * Update tenant
     */
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $tenantData = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'unit' => $request->unit,
            'status' => $request->status,
            'lease_start_date' => $request->lease_start_date,
        ];
        
        if (Schema::hasColumn('tenants', 'monthly_rent')) {
            $tenantData['monthly_rent'] = $request->monthly_rent ?? 0;
        }

        $tenant->update($tenantData);

        return response()->json([
            'success' => true,
            'message' => 'Tenant updated successfully!',
            'tenant' => $tenant
        ]);
    }

    /**
     * Delete tenant
     */
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