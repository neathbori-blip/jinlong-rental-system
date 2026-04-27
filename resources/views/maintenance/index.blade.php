@extends('layouts.app')

@section('title', 'Maintenance Management')

@section('content')
<div class="max-w-[1400px] mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-tools text-purple-600 mr-3"></i> Maintenance Management
            </h1>
            <p class="text-slate-500 text-sm">Track, manage, and resolve maintenance requests across all properties</p>
        </div>
        <a href="{{ route('maintenance.create') }}" class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 shadow-md hover:shadow-lg transition">
            <i class="fas fa-plus-circle"></i> New Maintenance Request
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">Open Requests</p><div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center"><i class="fas fa-clipboard-list text-purple-600"></i></div></div>
            <p class="text-2xl font-bold">{{ $openRequests }}</p>
            <span class="text-xs text-green-600"><i class="fas fa-arrow-up"></i> +{{ $openRequests > 0 ? $openRequests : 0 }} today</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">In Progress</p><div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center"><i class="fas fa-spinner text-orange-600"></i></div></div>
            <p class="text-2xl font-bold">{{ $inProgress }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">Completed (This Month)</p><div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center"><i class="fas fa-check-circle text-green-600"></i></div></div>
            <p class="text-2xl font-bold">{{ $completedThisMonth }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">Avg. Response Time</p><div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center"><i class="fas fa-clock text-blue-600"></i></div></div>
            <p class="text-2xl font-bold">{{ $avgResponseTime }}</p>
            <span class="text-xs text-blue-600">hours</span>
        </div>
    </div>

    <!-- Urgent Requests Block -->
    @if($urgentRequests->count())
    <div class="bg-white rounded-2xl p-5 mb-8 border border-slate-100 border-l-4 border-l-red-500">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-slate-800 font-semibold"><i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Urgent Requests</h3>
            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">{{ $urgentRequests->count() }} urgent</span>
        </div>
        <div class="flex flex-col gap-3">
            @foreach($urgentRequests as $req)
            <div class="flex items-center justify-between p-3 rounded-xl bg-red-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-red-500 text-xl">
                        <i class="fas fa-{{ $req->issue_type == 'Plumbing' ? 'water' : ($req->issue_type == 'Electrical' ? 'bolt' : 'tools') }}"></i>
                    </div>
                    <div>
                        <strong class="block text-sm text-slate-800">{{ $req->issue_type }} - Unit {{ $req->unit_number }}</strong>
                        <span class="text-xs text-slate-500">{{ $req->property->name }} - Reported {{ $req->reported_date->diffForHumans() }}</span>
                    </div>
                </div>
                <a href="{{ route('maintenance.edit', $req) }}" class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">Assign Now</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Filter Card (simplified – works with your existing JS filters) -->
    <div class="bg-white rounded-2xl p-4 mb-6 border border-slate-100">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <input type="text" id="searchInput" placeholder="Search request ID, tenant..." class="border rounded-xl px-3 py-2">
            <select id="statusFilter" class="border rounded-xl px-3 py-2">
                <option value="all">All Status</option>
                <option value="open">Open</option>
                <option value="in-progress">In Progress</option>
                <option value="review">Under Review</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <select id="priorityFilter" class="border rounded-xl px-3 py-2">
                <option value="all">All Priority</option>
                <option value="urgent">Urgent</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
            <select id="propertyFilter" class="border rounded-xl px-3 py-2">
                <option value="all">All Properties</option>
                @foreach($properties as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
            <button id="clearFilters" class="bg-gray-200 rounded-xl px-3 py-2 hover:bg-gray-300">Clear Filters</button>
        </div>
    </div>

    <!-- Chart & Summary Row -->
    <div class="grid grid-cols-1 lg:grid-cols-[1.4fr,0.8fr] gap-6 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line mr-2"></i> Maintenance Trends</h3>
                <span class="bg-indigo-50 px-3 py-1 rounded-full text-xs font-semibold text-indigo-600">Last 6 Months</span>
            </div>
            <canvas id="maintenanceChart" height="200"></canvas>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <h3 class="text-slate-800 font-bold mb-4"><i class="fas fa-chart-pie mr-2"></i> Maintenance Summary</h3>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2"><span>Total Requests</span><strong>{{ $totalRequests }}</strong></div>
                <div class="flex justify-between border-b pb-2"><span>Avg. Completion Time</span><strong>{{ number_format($avgCompletionDays, 1) }} days</strong></div>
                <div class="flex justify-between border-b pb-2"><span>Avg. Cost per Request</span><strong>${{ number_format($avgCost, 2) }}</strong></div>
                <div class="flex justify-between border-b pb-2"><span>Resolution Rate</span><strong>{{ $resolutionRate }}%</strong></div>
                <div class="flex justify-between pt-2"><span>This Month's Cost</span><strong>${{ number_format($thisMonthCost, 2) }}</strong></div>
                <div class="bg-amber-50 p-3 rounded-xl mt-2"><span>Overdue Requests</span><strong class="float-right text-amber-700">{{ $overdueRequests }}</strong></div>
            </div>
        </div>
    </div>

    <!-- Category Distribution -->
    <div class="bg-white rounded-2xl p-5 mb-8 border border-slate-100">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-bar mr-2"></i> Maintenance Categories</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach($categories as $cat)
            <div class="p-3 bg-slate-50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-2 text-purple-600 text-xl">
                    <i class="fas fa-{{ $cat->issue_type == 'Plumbing' ? 'faucet' : ($cat->issue_type == 'Electrical' ? 'bolt' : ($cat->issue_type == 'HVAC' ? 'wind' : 'tools')) }}"></i>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm font-semibold">{{ $cat->issue_type }}</span>
                    <span class="text-xs text-slate-500">{{ $cat->total }} requests</span>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: {{ ($cat->total / $totalRequests) * 100 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Maintenance Requests Table (Dynamic) -->
    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center flex-wrap gap-3">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-clipboard-list mr-2"></i> Maintenance Requests</h3>
            <div class="flex gap-2">
                <button id="exportBtn" class="bg-gray-100 px-3 py-1 rounded hover:bg-gray-200 text-sm"><i class="fas fa-download"></i> Export CSV</button>
                <button id="printBtn" class="bg-gray-100 px-3 py-1 rounded hover:bg-gray-200 text-sm"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3"><input type="checkbox" id="selectAll"></th>
                        <th>Request ID</th><th>Property/Unit</th><th>Tenant</th><th>Issue Type</th><th>Priority</th><th>Reported Date</th><th>Assigned To</th><th>Status</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody id="requestsTableBody">
                    @foreach($requests as $req)
                    <tr class="border-t">
                        <td class="px-4 py-3"><input type="checkbox" class="request-checkbox" value="{{ $req->id }}"></td>
                        <td class="px-4 py-3">{{ $req->request_number }}</td>
                        <td class="px-4 py-3">{{ $req->property->name }} - {{ $req->unit_number }}</td>
                        <td class="px-4 py-3">{{ $req->tenant->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $req->issue_type }}</td>
                        <td class="px-4 py-3">{!! $req->priority_badge !!}</td>
                        <td class="px-4 py-3">{{ $req->reported_date->format('M d, Y') }}</td>
                        <td class="px-4 py-3">{{ $req->assigned_to ?? 'Unassigned' }}</td>
                        <td class="px-4 py-3">{!! $req->status_badge !!}</td>
                        <td class="px-4 py-3 action-buttons">
                            <a href="{{ route('maintenance.show', $req) }}" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('maintenance.edit', $req) }}" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('maintenance.destroy', $req) }}" method="POST" onsubmit="return confirm('Delete?')" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" title="Delete" style="background:none; border:none;"><i class="fas fa-trash-alt text-red-500"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-5 border-t border-slate-100">
            {{ $requests->links() }}
        </div>
    </div>
</div>

<style>
    .priority-urgent, .priority-high, .priority-medium, .priority-low {
        padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block;
    }
    .priority-urgent { background: #fee2e2; color: #991b1b; }
    .priority-high { background: #fed7aa; color: #92400e; }
    .priority-medium { background: #fef3c7; color: #854d0e; }
    .priority-low { background: #d1fae5; color: #065f46; }
    
    .badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
    .badge-open { background: #dbeafe; color: #1e40af; }
    .badge-progress { background: #fed7aa; color: #92400e; }
    .badge-review { background: #e0e7ff; color: #3730a3; }
    .badge-completed { background: #d1fae5; color: #065f46; }
    .badge-cancelled { background: #e5e7eb; color: #4b5563; }

    .action-buttons { display: flex; gap: 12px; }
    .action-buttons i { cursor: pointer; color: #94a3b8; transition: 0.2s; }
    .action-buttons i:hover { color: #667eea; }
    td, th { padding: 12px 16px; vertical-align: middle; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Filters (client-side for the table rows)
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const priorityFilter = document.getElementById('priorityFilter');
    const propertyFilter = document.getElementById('propertyFilter');
    const clearBtn = document.getElementById('clearFilters');
    const tableRows = document.querySelectorAll('#requestsTableBody tr');
    const selectAll = document.getElementById('selectAll');

    function filterTable() {
        const search = searchInput.value.toLowerCase();
        const status = statusFilter.value;
        const priority = priorityFilter.value;
        const property = propertyFilter.value;

        tableRows.forEach(row => {
            const id = row.cells[1]?.innerText.toLowerCase() || '';
            const tenant = row.cells[3]?.innerText.toLowerCase() || '';
            const propUnit = row.cells[2]?.innerText.toLowerCase() || '';
            const rowStatus = row.cells[8]?.innerText.trim().toLowerCase() || '';
            const rowPriority = row.cells[5]?.innerText.trim().toLowerCase() || '';
            const rowProperty = row.cells[2]?.innerText.split('-')[0].trim().toLowerCase() || '';

            let show = true;
            if (search && !id.includes(search) && !tenant.includes(search) && !propUnit.includes(search)) show = false;
            if (status !== 'all' && rowStatus !== status) show = false;
            if (priority !== 'all' && rowPriority !== priority) show = false;
            if (property !== 'all' && rowProperty !== property) show = false;
            row.style.display = show ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
    priorityFilter.addEventListener('change', filterTable);
    propertyFilter.addEventListener('change', filterTable);
    clearBtn.addEventListener('click', () => {
        searchInput.value = '';
        statusFilter.value = 'all';
        priorityFilter.value = 'all';
        propertyFilter.value = 'all';
        filterTable();
    });
    selectAll?.addEventListener('change', function(e) {
        document.querySelectorAll('.request-checkbox').forEach(cb => cb.checked = e.target.checked);
    });
    document.getElementById('exportBtn')?.addEventListener('click', () => alert('Export CSV would be implemented'));
    document.getElementById('printBtn')?.addEventListener('click', () => window.print());

    // Chart from controller data
    const ctx = document.getElementById('maintenanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Maintenance Requests',
                data: @json($chartData),
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.05)',
                borderWidth: 3,
                pointBackgroundColor: '#764ba2',
                pointBorderColor: '#fff',
                pointRadius: 5,
                tension: 0.3,
                fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'top' } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 5 } } } }
    });
</script>
@endsection