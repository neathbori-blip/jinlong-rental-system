{{-- resources/views/leases/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Lease Management')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-file-signature text-purple-600 mr-3"></i> Lease Management
            </h1>
            <p class="text-slate-500 text-sm">Manage all rental agreements, renewals, and lease documents</p>
        </div>
        
        {{-- Using Button Component --}}
        <x-button variant="primary" size="lg" icon="plus-circle" id="addLeaseBtn">
            Create New Lease
        </x-button>
    </div>

    {{-- Stats Cards using Component --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Active Leases" 
            value="42" 
            icon="file-signature"
            iconColor="purple"
            trend="+8 this month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Expiring Soon" 
            value="6" 
            icon="clock"
            iconColor="orange"
            trend="Next 30 days"
            :trendUp="false"
        />

        <x-stat-card 
            title="Expired Leases" 
            value="3" 
            icon="calendar-times"
            iconColor="red"
            trend="Need renewal"
            :trendUp="false"
        />

        <x-stat-card 
            title="Average Lease Term" 
            value="14.5" 
            icon="chart-line"
            iconColor="green"
            trend="months"
            :trendUp="true"
            subtext="+2.3 months YoY"
        />
    </div>

    {{-- Filter Component --}}
    <x-filter-card 
        title="Filter Leases"
        searchPlaceholder="Tenant, property, or lease ID..."
        searchField="searchInput"
        :showStatus="true"
        :showType="true"
        :showProperty="true"
        :statusOptions="[
            'active' => '✅ Active',
            'expiring' => '⚠️ Expiring Soon',
            'expired' => '❌ Expired',
            'terminated' => '🔚 Terminated'
        ]"
        :typeOptions="[
            'standard' => 'Standard Residential',
            'commercial' => 'Commercial',
            'shortterm' => 'Short-term',
            'sublease' => 'Sublease'
        ]"
        :propertyOptions="[
            'sunset' => 'Sunset Apartments',
            'maple' => 'Maple Grove',
            'harbor' => 'Harbor Loft',
            'oakwood' => 'Oakwood Residence'
        ]"
    />

    <!-- Analytics Row -->
    <div class="grid grid-cols-1 lg:grid-cols-[1.4fr,0.8fr] gap-6 mb-8">
        <!-- Chart Container -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line mr-2"></i> Lease Expiration Timeline</h3>
                <span class="bg-indigo-50 px-3 py-1 rounded-full text-xs font-semibold text-indigo-600">Next 6 Months</span>
            </div>
            <canvas id="expirationChart" height="200"></canvas>
        </div>

        <!-- Summary Container -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-pie mr-2"></i> Lease Summary</h3>
                <i class="fas fa-info-circle text-slate-400 cursor-help" title="Current lease statistics"></i>
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-home mr-2 text-slate-500"></i> Total Units</span>
                    <strong class="text-slate-800">48 properties</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-file-contract mr-2 text-slate-500"></i> Occupied Units</span>
                    <strong class="text-slate-800">42 units</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-percent mr-2 text-slate-500"></i> Occupancy Rate</span>
                    <strong class="text-slate-800">87.5%</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-dollar-sign mr-2 text-slate-500"></i> Monthly Revenue</span>
                    <strong class="text-slate-800">$74,250</strong>
                </div>
                <div class="flex justify-between pt-4 mt-2 border-t-2 border-slate-200">
                    <span><i class="fas fa-calendar-week mr-2 text-slate-500"></i> Avg. Lease Duration</span>
                    <strong class="text-slate-800">14.5 months</strong>
                </div>
                <div class="bg-amber-50 p-4 rounded-xl mt-2">
                    <span><i class="fas fa-bell mr-2 text-amber-600"></i> Renewals Needed</span>
                    <strong class="float-right text-amber-700">9 leases expiring soon</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Leases Table -->
    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100">
        <div class="flex justify-between items-center p-5 border-b border-slate-100 flex-wrap gap-3">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-file-contract mr-2"></i> Active & Upcoming Leases</h3>
            <div class="flex gap-3">
                <x-button variant="secondary" size="sm" icon="download" id="exportBtn">
                    Export CSV
                </x-button>
                <x-button variant="secondary" size="sm" icon="print" id="printBtn">
                    Print
                </x-button>
                <x-button variant="primary" size="sm" icon="sync-alt" id="bulkRenewBtn">
                    Bulk Renew
                </x-button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3.5 text-left"><input type="checkbox" id="selectAll" class="w-4 h-4 cursor-pointer"></th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Lease ID</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Tenant</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Property</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Unit</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Start Date</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">End Date</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Monthly Rent</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Status</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Actions</th>
                    </tr>
                </thead>
                <tbody id="leasesTableBody">
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
    .badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-active { background: #d1fae5; color: #065f46; }
    .badge-expiring { background: #fed7aa; color: #92400e; }
    .badge-expired { background: #fee2e2; color: #991b1b; }
    .badge-terminated { background: #e5e7eb; color: #4b5563; }
    
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .action-buttons i {
        cursor: pointer;
        color: #94a3b8;
        transition: 0.2s;
    }
    .action-buttons i:hover {
        color: #667eea;
    }
    
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
    // Lease Data
    const leases = [
        { id: "LS-1001", tenant: "Emily Clarke", property: "Sunset Apartments", unit: "#4B", startDate: "2024-01-15", endDate: "2025-01-14", rent: 1850, status: "expiring", type: "standard" },
        { id: "LS-1002", tenant: "James Wilson", property: "Maple Grove", unit: "#12", startDate: "2024-03-01", endDate: "2025-03-01", rent: 2200, status: "active", type: "standard" },
        { id: "LS-1003", tenant: "Sophia Martinez", property: "Harbor Loft", unit: "#7", startDate: "2024-06-10", endDate: "2025-06-09", rent: 1750, status: "active", type: "standard" },
        { id: "LS-1004", tenant: "Liam Johnson", property: "Oakwood Residence", unit: "#2", startDate: "2023-12-01", endDate: "2024-11-30", rent: 1950, status: "expired", type: "standard" },
        { id: "LS-1005", tenant: "Olivia Brown", property: "Pine Hill", unit: "#9", startDate: "2024-02-20", endDate: "2025-02-19", rent: 2100, status: "expiring", type: "standard" },
        { id: "LS-1006", tenant: "Noah Davis", property: "Cedar Creek", unit: "#15", startDate: "2024-08-01", endDate: "2025-08-01", rent: 1650, status: "active", type: "standard" },
        { id: "LS-1007", tenant: "Ava Garcia", property: "Downtown Suites", unit: "#3", startDate: "2023-10-15", endDate: "2024-10-14", rent: 2400, status: "expired", type: "commercial" },
        { id: "LS-1008", tenant: "Mason Rodriguez", property: "Lakeside Villas", unit: "#8", startDate: "2024-04-05", endDate: "2025-04-04", rent: 1890, status: "expiring", type: "standard" },
        { id: "LS-1009", tenant: "Isabella Miller", property: "West End", unit: "#22", startDate: "2024-09-01", endDate: "2025-09-01", rent: 1725, status: "active", type: "standard" },
        { id: "LS-1010", tenant: "Ethan Martinez", property: "Hillcrest", unit: "#5", startDate: "2024-01-10", endDate: "2025-01-09", rent: 1980, status: "expired", type: "standard" },
        { id: "LS-1011", tenant: "Charlotte Wilson", property: "Riverfront", unit: "#11", startDate: "2024-05-15", endDate: "2025-05-14", rent: 2300, status: "active", type: "commercial" },
        { id: "LS-1012", tenant: "Benjamin Lee", property: "Golden Gate", unit: "#6", startDate: "2024-07-20", endDate: "2025-07-19", rent: 1675, status: "active", type: "standard" },
        { id: "LS-1013", tenant: "Amelia Taylor", property: "Sunset Apartments", unit: "#12C", startDate: "2024-03-15", endDate: "2024-09-14", rent: 1950, status: "terminated", type: "shortterm" },
        { id: "LS-1014", tenant: "Daniel White", property: "Maple Grove", unit: "#8", startDate: "2024-04-01", endDate: "2025-04-01", rent: 2350, status: "expiring", type: "standard" },
        { id: "LS-1015", tenant: "Emma Harris", property: "Harbor Loft", unit: "#15", startDate: "2024-10-01", endDate: "2025-10-01", rent: 1900, status: "active", type: "standard" }
    ];

    let currentPage = 1;
    let rowsPerPage = 8;
    let currentFilters = {
        search: '',
        status: 'all',
        type: 'all',
        property: 'all'
    };

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    function formatAmount(amount) {
        return `$${amount.toLocaleString()}`;
    }

    function getStatusBadge(status) {
        const badges = {
            'active': '<span class="badge badge-active"><i class="fas fa-check-circle"></i> Active</span>',
            'expiring': '<span class="badge badge-expiring"><i class="fas fa-clock"></i> Expiring Soon</span>',
            'expired': '<span class="badge badge-expired"><i class="fas fa-calendar-times"></i> Expired</span>',
            'terminated': '<span class="badge badge-terminated"><i class="fas fa-ban"></i> Terminated</span>'
        };
        return badges[status] || badges.active;
    }

    function filterLeases() {
        return leases.filter(lease => {
            if (currentFilters.search) {
                const searchTerm = currentFilters.search.toLowerCase();
                const matchesSearch = lease.tenant.toLowerCase().includes(searchTerm) ||
                                    lease.property.toLowerCase().includes(searchTerm) ||
                                    lease.id.toLowerCase().includes(searchTerm) ||
                                    lease.unit.toLowerCase().includes(searchTerm);
                if (!matchesSearch) return false;
            }
            if (currentFilters.status !== 'all' && lease.status !== currentFilters.status) return false;
            if (currentFilters.type !== 'all' && lease.type !== currentFilters.type) return false;
            if (currentFilters.property !== 'all') {
                const propertyMap = {
                    'sunset': 'Sunset Apartments',
                    'maple': 'Maple Grove',
                    'harbor': 'Harbor Loft',
                    'oakwood': 'Oakwood Residence'
                };
                if (lease.property !== propertyMap[currentFilters.property]) return false;
            }
            return true;
        });
    }

    function renderTable() {
        const filtered = filterLeases();
        const totalPages = Math.ceil(filtered.length / rowsPerPage);
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageData = filtered.slice(start, end);
        
        const tbody = document.getElementById('leasesTableBody');
        
    
        document.getElementById('showingInfo').innerHTML = `Showing ${start+1} to ${Math.min(end, filtered.length)} of ${filtered.length} leases`;
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
            type: document.getElementById('typeFilter')?.value || 'all',
            property: document.getElementById('propertyFilter')?.value || 'all'
        };
        currentPage = 1;
        renderTable();
    }
    
    function clearFilters() {
        if (document.getElementById('searchInput')) document.getElementById('searchInput').value = '';
        if (document.getElementById('statusFilter')) document.getElementById('statusFilter').value = 'all';
        if (document.getElementById('typeFilter')) document.getElementById('typeFilter').value = 'all';
        if (document.getElementById('propertyFilter')) document.getElementById('propertyFilter').value = 'all';
        applyFilters();
    }
    
    function viewLease(id) { alert(`Viewing lease ${id} - Full details would be shown here`); }
    function downloadLease(id) { alert(`Downloading lease agreement for ${id}`); }
    function renewLease(id) { alert(`Renewing lease ${id} - Renewal form would open`); }
    function editLease(id) { alert(`Editing lease ${id} - Edit form would open`); }
    
    let expirationChart;
    function initChart() {
        const ctx = document.getElementById('expirationChart').getContext('2d');
        expirationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Leases Expiring',
                    data: [2, 3, 4, 2, 1, 3],
                    backgroundColor: 'rgba(102, 126, 234, 0.7)',
                    borderColor: '#667eea',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { callbacks: { label: (ctx) => `${ctx.raw} leases expiring` } }
                },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    }
    
    // Event Listeners
    document.getElementById('selectAll')?.addEventListener('change', function(e) {
        document.querySelectorAll('.lease-checkbox').forEach(cb => cb.checked = e.target.checked);
    });
    
    document.getElementById('bulkRenewBtn')?.addEventListener('click', function() {
        const selected = document.querySelectorAll('.lease-checkbox:checked');
        if (selected.length === 0) {
            alert('Please select at least one lease to renew');
            return;
        }
        alert(`Renewing ${selected.length} selected leases`);
    });
    
    document.getElementById('searchInput')?.addEventListener('input', applyFilters);
    document.getElementById('statusFilter')?.addEventListener('change', applyFilters);
    document.getElementById('typeFilter')?.addEventListener('change', applyFilters);
    document.getElementById('propertyFilter')?.addEventListener('change', applyFilters);
    document.getElementById('clearFilters')?.addEventListener('click', clearFilters);
    document.getElementById('exportBtn')?.addEventListener('click', () => alert('CSV export feature - would export current lease data'));
    document.getElementById('printBtn')?.addEventListener('click', () => window.print());
    document.getElementById('addLeaseBtn')?.addEventListener('click', () => alert('Create new lease form - ready for integration'));
    
    // Initialize
    initChart();
    renderTable();
</script>
@endsection