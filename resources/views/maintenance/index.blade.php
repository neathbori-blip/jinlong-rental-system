{{-- resources/views/maintenance/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Maintenance Management')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-tools text-purple-600 mr-3"></i> Maintenance Management
            </h1>
            <p class="text-slate-500 text-sm">Track, manage, and resolve maintenance requests across all properties</p>
        </div>
        
        
        <x-button variant="primary" size="lg" icon="plus-circle" id="addRequestBtn">
            New Maintenance Request
        </x-button>
    </div>

    {{-- Stats Cards using Component --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Open Requests" 
            value="12" 
            icon="clipboard-list"
            iconColor="purple"
            trend="+3 today"
            :trendUp="true"
        />

        <x-stat-card 
            title="In Progress" 
            value="8" 
            icon="spinner"
            iconColor="orange"
            trend="Being worked on"
            :trendUp="false"
        />

        <x-stat-card 
            title="Completed (This Month)" 
            value="24" 
            icon="check-circle"
            iconColor="green"
            trend="+12 vs last month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Avg. Response Time" 
            value="4.2" 
            icon="clock"
            iconColor="blue"
            trend="hours"
            :trendUp="true"
            subtext="-1.5 hrs improvement"
        />
    </div>

    <!-- Quick Action Alerts -->
    <div class="bg-white rounded-2xl p-5 mb-8 border border-slate-100 border-l-4 border-l-red-500">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-slate-800 font-semibold"><i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Urgent Requests</h3>
            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">3 urgent</span>
        </div>
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between p-3 rounded-xl bg-red-50 border-l-3 border-l-red-500">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-red-500 text-xl"><i class="fas fa-water"></i></div>
                    <div>
                        <strong class="block text-sm text-slate-800">Water Leak - Unit #4B</strong>
                        <span class="text-xs text-slate-500">Sunset Apartments - Reported 2 hours ago</span>
                    </div>
                </div>
                <x-button variant="primary" size="sm" icon="user-check">
                    Assign Now
                </x-button>
            </div>
            <div class="flex items-center justify-between p-3 rounded-xl bg-red-50 border-l-3 border-l-red-500">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-red-500 text-xl"><i class="fas fa-bolt"></i></div>
                    <div>
                        <strong class="block text-sm text-slate-800">Electrical Issue - Unit #12</strong>
                        <span class="text-xs text-slate-500">Maple Grove - Power outage reported</span>
                    </div>
                </div>
                <x-button variant="primary" size="sm" icon="user-check">
                    Assign Now
                </x-button>
            </div>
            <div class="flex items-center justify-between p-3 rounded-xl bg-amber-50 border-l-3 border-l-amber-500">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-amber-500 text-xl"><i class="fas fa-temperature-high"></i></div>
                    <div>
                        <strong class="block text-sm text-slate-800">AC Not Working - Unit #7</strong>
                        <span class="text-xs text-slate-500">Harbor Loft - Reported 5 hours ago</span>
                    </div>
                </div>
                <x-button variant="primary" size="sm" icon="user-check">
                    Assign Now
                </x-button>
            </div>
        </div>
    </div>

    {{-- Filter Component --}}
    <x-filter-card 
        title="Filter Maintenance Requests"
        searchPlaceholder="Request ID, tenant, or property..."
        searchField="searchInput"
        :showStatus="true"
        :showPriority="true"
        :showProperty="true"
        :statusOptions="[
            'open' => ' Open',
            'in-progress' => ' In Progress',
            'review' => ' Under Review',
            'completed' => ' Completed',
            'cancelled' => 'Cancelled'
        ]"
        :priorityOptions="[
            'urgent' => 'Urgent',
            'high' => ' High',
            'medium' => ' Medium',
            'low' => 'Low'
        ]"
        :propertyOptions="[
            'sunset' => 'Sunset Apartments',
            'maple' => 'Maple Grove',
            'harbor' => 'Harbor Loft',
            'oakwood' => 'Oakwood Residence',
            'pine' => 'Pine Hill'
        ]"
    />

    <!-- Analytics Row -->
    <div class="grid grid-cols-1 lg:grid-cols-[1.4fr,0.8fr] gap-6 mb-8">
        <!-- Chart Container -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line mr-2"></i> Maintenance Trends</h3>
                <span class="bg-indigo-50 px-3 py-1 rounded-full text-xs font-semibold text-indigo-600">Last 6 Months</span>
            </div>
            <canvas id="maintenanceChart" height="200"></canvas>
        </div>

        <!-- Summary Container -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-pie mr-2"></i> Maintenance Summary</h3>
                <i class="fas fa-info-circle text-slate-400 cursor-help" title="Current maintenance statistics"></i>
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-folder-open mr-2 text-slate-500"></i> Total Requests</span>
                    <strong class="text-slate-800">47 total</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-hourglass-half mr-2 text-slate-500"></i> Avg. Completion Time</span>
                    <strong class="text-slate-800">3.2 days</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-dollar-sign mr-2 text-slate-500"></i> Avg. Cost per Request</span>
                    <strong class="text-slate-800">$245</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-chart-line mr-2 text-slate-500"></i> Resolution Rate</span>
                    <strong class="text-slate-800">89%</strong>
                </div>
                <div class="flex justify-between pt-4 mt-2 border-t-2 border-slate-200">
                    <span><i class="fas fa-calendar-week mr-2 text-slate-500"></i> This Month's Cost</span>
                    <strong class="text-slate-800">$4,280</strong>
                </div>
                <div class="bg-amber-50 p-4 rounded-xl mt-2">
                    <span><i class="fas fa-clock mr-2 text-amber-600"></i> Overdue Requests</span>
                    <strong class="float-right text-amber-700">4 requests</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Distribution -->
    <div class="bg-white rounded-2xl p-5 mb-8 border border-slate-100">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-bar mr-2"></i> Maintenance Categories</h3>
            <x-button variant="secondary" size="sm" id="viewAllCategories">
                View Details
            </x-button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Plumbing -->
            <div class="p-3 bg-slate-50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mb-2 text-blue-600 text-xl"><i class="fas fa-faucet"></i></div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm font-semibold text-slate-800">Plumbing</span>
                    <span class="text-xs text-slate-500">12 requests</span>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 35%"></div></div>
            </div>
            <!-- Electrical -->
            <div class="p-3 bg-slate-50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center mb-2 text-amber-600 text-xl"><i class="fas fa-bolt"></i></div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm font-semibold text-slate-800">Electrical</span>
                    <span class="text-xs text-slate-500">8 requests</span>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 24%"></div></div>
            </div>
            <!-- HVAC -->
            <div class="p-3 bg-slate-50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center mb-2 text-emerald-600 text-xl"><i class="fas fa-wind"></i></div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm font-semibold text-slate-800">HVAC</span>
                    <span class="text-xs text-slate-500">10 requests</span>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 29%"></div></div>
            </div>
            <!-- Appliances -->
            <div class="p-3 bg-slate-50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center mb-2 text-indigo-600 text-xl"><i class="fas fa-tshirt"></i></div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm font-semibold text-slate-800">Appliances</span>
                    <span class="text-xs text-slate-500">9 requests</span>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 26%"></div></div>
            </div>
            <!-- General -->
            <div class="p-3 bg-slate-50 rounded-xl">
                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center mb-2 text-purple-600 text-xl"><i class="fas fa-home"></i></div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm font-semibold text-slate-800">General</span>
                    <span class="text-xs text-slate-500">8 requests</span>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 24%"></div></div>
            </div>
        </div>
    </div>

    <!-- Maintenance Requests Table -->
    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100">
        <div class="flex justify-between items-center p-5 border-b border-slate-100 flex-wrap gap-3">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-clipboard-list mr-2"></i> Maintenance Requests</h3>
            <div class="flex gap-3">
                <x-button variant="secondary" size="sm" icon="download" id="exportBtn">
                    Export CSV
                </x-button>
                <x-button variant="secondary" size="sm" icon="print" id="printBtn">
                    Print
                </x-button>
                <x-button variant="primary" size="sm" icon="user-plus" id="assignMultipleBtn">
                    Assign Selected
                </x-button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3.5 text-left"><input type="checkbox" id="selectAll" class="w-4 h-4 cursor-pointer"></th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Request ID</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Property/Unit</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Tenant</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Issue Type</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Priority</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Reported Date</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Assigned To</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Status</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Actions</th>
                    </tr>
                </thead>
                <tbody id="maintenanceTableBody">
                    <!-- Dynamic rows will appear here -->
                </tbody>
            </table>
        </div>
        
        <div class="flex justify-between items-center p-5 border-t border-slate-100 flex-wrap gap-3">
            <div class="text-sm text-slate-500" id="showingInfo">Showing 0 of 0 entries</div>
            <div class="flex gap-2" id="pagination"></div>
        </div>
    </div>
</div>

<!-- Custom CSS for badges and additional styles -->
<style>
    /* Priority Badges */
    .priority-urgent, .priority-high, .priority-medium, .priority-low {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .priority-urgent { background: #fee2e2; color: #991b1b; }
    .priority-high { background: #fed7aa; color: #92400e; }
    .priority-medium { background: #fef3c7; color: #854d0e; }
    .priority-low { background: #d1fae5; color: #065f46; }

    /* Status Badges */
    .badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-open { background: #dbeafe; color: #1e40af; }
    .badge-progress { background: #fed7aa; color: #92400e; }
    .badge-review { background: #e0e7ff; color: #3730a3; }
    .badge-completed { background: #d1fae5; color: #065f46; }
    .badge-cancelled { background: #e5e7eb; color: #4b5563; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .action-buttons i {
        cursor: pointer;
        color: #94a3b8;
        transition: 0.2s;
        font-size: 16px;
    }
    .action-buttons i:hover {
        color: #667eea;
    }

    /* Pagination */
    .page-btn {
        padding: 6px 12px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
    }
    .page-btn.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    .page-btn:hover:not(.active) {
        background: #f1f5f9;
    }

    /* Table Row Hover */
    tr:hover td {
        background-color: #faf9fe;
    }
    
    th, td {
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Maintenance Requests Data
    const maintenanceRequests = [
        { id: "MR-1001", property: "Sunset Apartments", unit: "#4B", tenant: "Emily Clarke", type: "Plumbing", priority: "urgent", reportedDate: "2025-04-23", assignedTo: "Mike's Plumbing", status: "in-progress" },
        { id: "MR-1002", property: "Maple Grove", unit: "#12", tenant: "James Wilson", type: "Electrical", priority: "urgent", reportedDate: "2025-04-23", assignedTo: "Unassigned", status: "open" },
        { id: "MR-1003", property: "Harbor Loft", unit: "#7", tenant: "Sophia Martinez", type: "HVAC", priority: "high", reportedDate: "2025-04-22", assignedTo: "CoolAir Systems", status: "in-progress" },
        { id: "MR-1004", property: "Oakwood Residence", unit: "#2", tenant: "Liam Johnson", type: "Plumbing", priority: "medium", reportedDate: "2025-04-21", assignedTo: "John's Plumbing", status: "review" },
        { id: "MR-1005", property: "Pine Hill", unit: "#9", tenant: "Olivia Brown", type: "Appliance", priority: "high", reportedDate: "2025-04-20", assignedTo: "Appliance Pro", status: "in-progress" },
        { id: "MR-1006", property: "Cedar Creek", unit: "#15", tenant: "Noah Davis", type: "General", priority: "low", reportedDate: "2025-04-19", assignedTo: "Handyman Services", status: "completed" },
        { id: "MR-1007", property: "Downtown Suites", unit: "#3", tenant: "Ava Garcia", type: "Electrical", priority: "urgent", reportedDate: "2025-04-18", assignedTo: "Elite Electric", status: "in-progress" },
        { id: "MR-1008", property: "Lakeside Villas", unit: "#8", tenant: "Mason Rodriguez", type: "Plumbing", priority: "high", reportedDate: "2025-04-17", assignedTo: "Unassigned", status: "open" },
        { id: "MR-1009", property: "West End", unit: "#22", tenant: "Isabella Miller", type: "HVAC", priority: "medium", reportedDate: "2025-04-16", assignedTo: "CoolAir Systems", status: "review" },
        { id: "MR-1010", property: "Hillcrest", unit: "#5", tenant: "Ethan Martinez", type: "Appliance", priority: "low", reportedDate: "2025-04-15", assignedTo: "Appliance Pro", status: "completed" },
        { id: "MR-1011", property: "Riverfront", unit: "#11", tenant: "Charlotte Wilson", type: "General", priority: "medium", reportedDate: "2025-04-14", assignedTo: "Handyman Services", status: "open" },
        { id: "MR-1012", property: "Golden Gate", unit: "#6", tenant: "Benjamin Lee", type: "Plumbing", priority: "urgent", reportedDate: "2025-04-13", assignedTo: "Mike's Plumbing", status: "in-progress" }
    ];

    let currentPage = 1;
    let rowsPerPage = 8;
    let currentFilters = {
        search: '',
        status: 'all',
        priority: 'all',
        property: 'all'
    };

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    function getPriorityBadge(priority) {
        const badges = {
            'urgent': '<span class="priority-urgent">Urgent</span>',
            'high': '<span class="priority-high"> High</span>',
            'medium': '<span class="priority-medium">Medium</span>',
            'low': '<span class="priority-low"> Low</span>'
        };
        return badges[priority] || badges.medium;
    }

    function getStatusBadge(status) {
        const badges = {
            'open': '<span class="badge badge-open"> Open</span>',
            'in-progress': '<span class="badge badge-progress"> In Progress</span>',
            'review': '<span class="badge badge-review"> Under Review</span>',
            'completed': '<span class="badge badge-completed"> Completed</span>',
            'cancelled': '<span class="badge badge-cancelled"> Cancelled</span>'
        };
        return badges[status] || badges.open;
    }

    function filterRequests() {
        return maintenanceRequests.filter(request => {
            if (currentFilters.search) {
                const searchTerm = currentFilters.search.toLowerCase();
                const matchesSearch = request.id.toLowerCase().includes(searchTerm) ||
                                    request.tenant.toLowerCase().includes(searchTerm) ||
                                    request.property.toLowerCase().includes(searchTerm);
                if (!matchesSearch) return false;
            }
            if (currentFilters.status !== 'all' && request.status !== currentFilters.status) return false;
            if (currentFilters.priority !== 'all' && request.priority !== currentFilters.priority) return false;
            if (currentFilters.property !== 'all') {
                const propertyMap = {
                    'sunset': 'Sunset Apartments',
                    'maple': 'Maple Grove',
                    'harbor': 'Harbor Loft',
                    'oakwood': 'Oakwood Residence',
                    'pine': 'Pine Hill'
                };
                if (request.property !== propertyMap[currentFilters.property]) return false;
            }
            return true;
        });
    }

    function renderTable() {
        const filtered = filterRequests();
        const totalPages = Math.ceil(filtered.length / rowsPerPage);
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageData = filtered.slice(start, end);
        
        const tbody = document.getElementById('maintenanceTableBody');
        
       
        
        document.getElementById('showingInfo').innerHTML = `Showing ${start+1} to ${Math.min(end, filtered.length)} of ${filtered.length} requests`;
        renderPagination(totalPages);
    }
    
    function renderPagination(totalPages) {
        const paginationDiv = document.getElementById('pagination');
        if (totalPages <= 1) {
            paginationDiv.innerHTML = '';
            return;
        }
        let html = '';
        for (let i = 1; i <= totalPages; i++) {
            html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
        }
        paginationDiv.innerHTML = html;
    }
    
    function goToPage(page) {
        currentPage = page;
        renderTable();
    }
    
    function applyFilters() {
        currentFilters = {
            search: document.getElementById('searchInput')?.value || '',
            status: document.getElementById('statusFilter')?.value || 'all',
            priority: document.getElementById('priorityFilter')?.value || 'all',
            property: document.getElementById('propertyFilter')?.value || 'all'
        };
        currentPage = 1;
        renderTable();
    }
    
    function clearFilters() {
        if (document.getElementById('searchInput')) document.getElementById('searchInput').value = '';
        if (document.getElementById('statusFilter')) document.getElementById('statusFilter').value = 'all';
        if (document.getElementById('priorityFilter')) document.getElementById('priorityFilter').value = 'all';
        if (document.getElementById('propertyFilter')) document.getElementById('propertyFilter').value = 'all';
        applyFilters();
    }
    
    function viewRequest(id) { alert(`Viewing maintenance request ${id}`); }
    function assignRequest(id) { alert(`Assign maintenance request ${id} to a technician`); }
    function completeRequest(id) { alert(`Mark request ${id} as completed`); }
    function editRequest(id) { alert(`Editing maintenance request ${id}`); }
    
    let maintenanceChart;
    function initChart() {
        const ctx = document.getElementById('maintenanceChart').getContext('2d');
        maintenanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Maintenance Requests',
                    data: [8, 12, 15, 18, 22, 47],
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
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 5 } }
                }
            }
        });
    }
    
    // Event Listeners
    document.getElementById('selectAll')?.addEventListener('change', function(e) {
        document.querySelectorAll('.request-checkbox').forEach(cb => cb.checked = e.target.checked);
    });
    
    document.getElementById('assignMultipleBtn')?.addEventListener('click', function() {
        const selected = document.querySelectorAll('.request-checkbox:checked');
        alert(`Assigning ${selected.length} selected maintenance requests`);
    });
    
    document.getElementById('searchInput')?.addEventListener('input', applyFilters);
    document.getElementById('statusFilter')?.addEventListener('change', applyFilters);
    document.getElementById('priorityFilter')?.addEventListener('change', applyFilters);
    document.getElementById('propertyFilter')?.addEventListener('change', applyFilters);
    document.getElementById('clearFilters')?.addEventListener('click', clearFilters);
    document.getElementById('exportBtn')?.addEventListener('click', () => alert('Exporting maintenance data to CSV'));
    document.getElementById('printBtn')?.addEventListener('click', () => window.print());
    document.getElementById('addRequestBtn')?.addEventListener('click', () => alert('Create new maintenance request'));
    document.getElementById('viewAllCategories')?.addEventListener('click', () => alert('Detailed category analytics'));
    
    // Initialize
    initChart();
    renderTable();
</script>
@endsection