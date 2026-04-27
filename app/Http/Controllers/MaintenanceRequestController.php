<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $requests = MaintenanceRequest::with(['property', 'tenant'])->latest()->paginate(8);

        // Statistics for cards
        $openRequests = MaintenanceRequest::where('status', 'open')->count();
        $inProgress = MaintenanceRequest::where('status', 'in-progress')->count();
        $completedThisMonth = MaintenanceRequest::where('status', 'completed')
            ->whereMonth('completed_date', now()->month)
            ->count();
        $avgResponseTime = 4.2; // You can calculate real average if you store response time

        // Urgent requests (priority = urgent and status not completed/cancelled)
        $urgentRequests = MaintenanceRequest::where('priority', 'urgent')
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->with(['property', 'tenant'])
            ->latest()
            ->take(3)
            ->get();

        // Stats for summary card
        $totalRequests = MaintenanceRequest::count();
        $avgCompletionDays = MaintenanceRequest::whereNotNull('completed_date')
            ->select(DB::raw('AVG(DATEDIFF(completed_date, reported_date)) as avg_days'))
            ->value('avg_days') ?? 3.2;
        $avgCost = MaintenanceRequest::avg('cost') ?? 245;
        $resolutionRate = $totalRequests > 0
            ? round((MaintenanceRequest::where('status', 'completed')->count() / $totalRequests) * 100)
            : 0;
        $thisMonthCost = MaintenanceRequest::whereMonth('reported_date', now()->month)->sum('cost') ?? 0;
        $overdueRequests = MaintenanceRequest::where('status', '!=', 'completed')
            ->where('reported_date', '<', now()->subDays(7))
            ->count();

        // Data for category distribution (taken directly from DB)
        $categories = MaintenanceRequest::select('issue_type', DB::raw('count(*) as total'))
            ->groupBy('issue_type')
            ->get();

        // Chart data: last 6 months
        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $chartLabels[] = $month->format('M');
            $count = MaintenanceRequest::whereYear('reported_date', $month->year)
                ->whereMonth('reported_date', $month->month)
                ->count();
            $chartData[] = $count;
        }

        // For filter dropdowns
        $properties = Property::all();
        $tenants = Tenant::all();

        return view('maintenance.index', compact(
            'requests', 'openRequests', 'inProgress', 'completedThisMonth', 'avgResponseTime',
            'urgentRequests', 'totalRequests', 'avgCompletionDays', 'avgCost', 'resolutionRate',
            'thisMonthCost', 'overdueRequests', 'categories', 'chartLabels', 'chartData',
            'properties', 'tenants'
        ));
    }

    public function create()
    {
        $properties = Property::all();
        $tenants = Tenant::all();
        return view('maintenance.create', compact('properties', 'tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id'   => 'required|exists:properties,id',
            'tenant_id'     => 'nullable|exists:tenants,id',
            'unit_number'   => 'required|string|max:50',
            'issue_type'    => 'required|string|max:100',
            'priority'      => 'required|in:urgent,high,medium,low',
            'description'   => 'required|string',
            'reported_date' => 'required|date',
            'assigned_to'   => 'nullable|string|max:255',
            'status'        => 'required|in:open,in-progress,review,completed,cancelled',
            'completed_date'=> 'nullable|date',
            'cost'          => 'nullable|numeric|min:0',
        ]);

        $validated['request_number'] = null; // auto-generated
        MaintenanceRequest::create($validated);

        return redirect()->route('maintenance.index')
                         ->with('success', 'Maintenance request created.');
    }

    public function show(MaintenanceRequest $maintenance)
    {
        $maintenance->load(['property', 'tenant']);
        return view('maintenance.show', compact('maintenance'));
    }

    public function edit(MaintenanceRequest $maintenance)
    {
        $properties = Property::all();
        $tenants = Tenant::all();
        return view('maintenance.edit', compact('maintenance', 'properties', 'tenants'));
    }

    public function update(Request $request, MaintenanceRequest $maintenance)
    {
        $validated = $request->validate([
            'property_id'   => 'required|exists:properties,id',
            'tenant_id'     => 'nullable|exists:tenants,id',
            'unit_number'   => 'required|string|max:50',
            'issue_type'    => 'required|string|max:100',
            'priority'      => 'required|in:urgent,high,medium,low',
            'description'   => 'required|string',
            'reported_date' => 'required|date',
            'assigned_to'   => 'nullable|string|max:255',
            'status'        => 'required|in:open,in-progress,review,completed,cancelled',
            'completed_date'=> 'nullable|date',
            'cost'          => 'nullable|numeric|min:0',
        ]);

        // If status is completed and completed_date is not set, set it to today
        if ($validated['status'] == 'completed' && empty($validated['completed_date'])) {
            $validated['completed_date'] = now()->toDateString();
        }

        $maintenance->update($validated);
        return redirect()->route('maintenance.index')
                         ->with('success', 'Maintenance request updated.');
    }

    public function destroy(MaintenanceRequest $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenance.index')
                         ->with('success', 'Maintenance request deleted.');
    }
}