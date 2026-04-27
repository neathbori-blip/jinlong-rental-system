{{-- resources/views/tenants/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Tenants Management')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-users text-purple-600 mr-3"></i> Tenants Management
            </h1>
            <p class="text-slate-500 text-sm">Manage all tenants, leases, and payment history in one place</p>
        </div>
        
        {{-- Using Button Component --}}
        <x-button variant="primary" size="lg" icon="user-plus" id="addTenantBtn">
            Add New Tenant
        </x-button>
    </div>

    {{-- Stats Cards using Component --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Total Tenants" 
            value="42" 
            icon="users"
            iconColor="purple"
            trend="+5 this month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Active Leases" 
            value="38" 
            icon="home"
            iconColor="green"
            trend="90% occupancy"
            :trendUp="true"
        />

        <x-stat-card 
            title="Pending Payments" 
            value="8" 
            icon="clock"
            iconColor="orange"
            trend="$6,450 total"
            :trendUp="false"
        />

        <x-stat-card 
            title="Avg. Rent" 
            value="$1,850" 
            icon="dollar-sign"
            iconColor="blue"
            trend="+5.2% YoY"
            :trendUp="true"
        />
    </div>

    {{-- Filter Component with Custom Filter for Lease Status --}}
    <x-filter-card 
        title="Filter Tenants"
        searchPlaceholder="Name, email, phone..."
        searchField="searchInput"
        :showStatus="true"
        :showProperty="true"
        :statusOptions="[
            'active' => '✅ Active',
            'pending' => '⏳ Pending',
            'inactive' => '❌ Inactive'
        ]"
        :propertyOptions="[
            'sunset' => 'Sunset Apartments',
            'maple' => 'Maple Grove',
            'harbor' => 'Harbor Loft',
            'oakwood' => 'Oakwood Residence'
        ]"
        :customFilters="[
            [
                'id' => 'leaseFilter',
                'label' => 'Lease Status',
                'icon' => 'fa-calendar',
                'options' => [
                    'active' => 'Active Lease',
                    'expiring' => 'Expiring Soon',
                    'expired' => 'Expired'
                ]
            ]
        ]"
    />

    <!-- Tenants Table -->
    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100">
        <div class="flex justify-between items-center p-5 border-b border-slate-100 flex-wrap gap-3">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-users mr-2"></i> All Tenants</h3>
            <div class="flex gap-3">
                <x-button variant="secondary" size="sm" icon="download" id="exportBtn">
                    Export CSV
                </x-button>
                <x-button variant="secondary" size="sm" icon="print" id="printBtn">
                    Print
                </x-button>
                <x-button variant="primary" size="sm" icon="envelope" id="bulkMessageBtn">
                    Send Message
                </x-button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3.5 text-left"><input type="checkbox" id="selectAll" class="w-4 h-4 cursor-pointer"></th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">ID</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Tenant</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Contact</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Property</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Unit</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Monthly Rent</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Lease End</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Status</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Actions</th>
                    </tr>
                </thead>
                <tbody id="tenantsTableBody">
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

<!-- Tenant Details Modal -->
<div id="tenantModal" class="modal hidden fixed top-0 left-0 w-full h-full bg-black/50 z-[9999] items-center justify-center">
    <div class="modal-content bg-white rounded-2xl max-w-2xl w-[90%] max-h-[80vh] overflow-y-auto">
        <div class="modal-header p-5 border-b border-slate-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800"><i class="fas fa-user mr-2"></i> Tenant Details</h3>
            <button class="modal-close bg-none border-none text-2xl cursor-pointer">&times;</button>
        </div>
        <div class="modal-body p-5" id="tenantModalBody">
            <!-- Dynamic content -->
        </div>
    </div>
</div>

<!-- Custom CSS for badges and additional styles -->
<style>
    /* Status Badges */
    .badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-active { background: #d1fae5; color: #065f46; }
    .badge-pending { background: #fed7aa; color: #92400e; }
    .badge-inactive { background: #fee2e2; color: #991b1b; }

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

<script>
// Tenants Data
const tenants = [
    { id: "TN-1001", name: "Emily Clarke", email: "emily.c@email.com", phone: "(555) 123-4567", property: "Sunset Apartments", unit: "#4B", rent: 1850, leaseEnd: "2025-01-14", status: "active", moveIn: "2024-01-15" },
    { id: "TN-1002", name: "James Wilson", email: "james.w@email.com", phone: "(555) 234-5678", property: "Maple Grove", unit: "#12", rent: 2200, leaseEnd: "2025-03-01", status: "active", moveIn: "2024-03-01" },
    { id: "TN-1003", name: "Sophia Martinez", email: "sophia.m@email.com", phone: "(555) 345-6789", property: "Harbor Loft", unit: "#7", rent: 1750, leaseEnd: "2025-06-09", status: "active", moveIn: "2024-06-10" },
    { id: "TN-1004", name: "Liam Johnson", email: "liam.j@email.com", phone: "(555) 456-7890", property: "Oakwood Residence", unit: "#2", rent: 1950, leaseEnd: "2024-11-30", status: "pending", moveIn: "2023-12-01" },
    { id: "TN-1005", name: "Olivia Brown", email: "olivia.b@email.com", phone: "(555) 567-8901", property: "Pine Hill", unit: "#9", rent: 2100, leaseEnd: "2025-02-19", status: "active", moveIn: "2024-02-20" },
    { id: "TN-1006", name: "Noah Davis", email: "noah.d@email.com", phone: "(555) 678-9012", property: "Cedar Creek", unit: "#15", rent: 1650, leaseEnd: "2025-08-01", status: "active", moveIn: "2024-08-01" },
    { id: "TN-1007", name: "Ava Garcia", email: "ava.g@email.com", phone: "(555) 789-0123", property: "Downtown Suites", unit: "#3", rent: 2400, leaseEnd: "2024-10-14", status: "inactive", moveIn: "2023-10-15" },
    { id: "TN-1008", name: "Mason Rodriguez", email: "mason.r@email.com", phone: "(555) 890-1234", property: "Lakeside Villas", unit: "#8", rent: 1890, leaseEnd: "2025-04-04", status: "active", moveIn: "2024-04-05" },
    { id: "TN-1009", name: "Isabella Miller", email: "isabella.m@email.com", phone: "(555) 901-2345", property: "West End", unit: "#22", rent: 1725, leaseEnd: "2025-09-01", status: "active", moveIn: "2024-09-01" },
    { id: "TN-1010", name: "Ethan Martinez", email: "ethan.m@email.com", phone: "(555) 012-3456", property: "Hillcrest", unit: "#5", rent: 1980, leaseEnd: "2024-12-31", status: "pending", moveIn: "2024-01-10" }
];

let currentPage = 1;
let rowsPerPage = 8;
let currentFilters = { search: '', status: 'all', property: 'all', lease: 'all' };

function formatDate(dateStr) {
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

function formatAmount(amount) {
    return `$${amount.toLocaleString()}`;
}

function getStatusBadge(status) {
    const badges = { 
        'active': '<span class="badge badge-active">✅ Active</span>', 
        'pending': '<span class="badge badge-pending">⏳ Pending</span>', 
        'inactive': '<span class="badge badge-inactive">❌ Inactive</span>' 
    };
    return badges[status] || badges.active;
}

function filterTenants() {
    return tenants.filter(tenant => {
        if (currentFilters.search && !tenant.name.toLowerCase().includes(currentFilters.search.toLowerCase()) && !tenant.email.toLowerCase().includes(currentFilters.search.toLowerCase())) return false;
        if (currentFilters.status !== 'all' && tenant.status !== currentFilters.status) return false;
        if (currentFilters.property !== 'all') {
            const propertyMap = { 'sunset': 'Sunset Apartments', 'maple': 'Maple Grove', 'harbor': 'Harbor Loft', 'oakwood': 'Oakwood Residence' };
            if (tenant.property !== propertyMap[currentFilters.property]) return false;
        }
        if (currentFilters.lease !== 'all') {
            const today = new Date();
            const leaseEnd = new Date(tenant.leaseEnd);
            const daysUntilEnd = Math.ceil((leaseEnd - today) / (1000 * 60 * 60 * 24));
            if (currentFilters.lease === 'expiring' && daysUntilEnd > 30) return false;
            if (currentFilters.lease === 'expired' && daysUntilEnd > 0) return false;
            if (currentFilters.lease === 'active' && daysUntilEnd <= 0) return false;
        }
        return true;
    });
}

function renderTable() {
    const filtered = filterTenants();
    const totalPages = Math.ceil(filtered.length / rowsPerPage);
    const start = (currentPage - 1) * rowsPerPage;
    const pageData = filtered.slice(start, start + rowsPerPage);
    const tbody = document.getElementById('tenantsTableBody');
    
    if (pageData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="10" style="text-align: center; padding: 40px;">No tenants found</td></tr>';
    } else {
        tbody.innerHTML = pageData.map(tenant => `
            <tr>
                <td class="px-4 py-3.5"><input type="checkbox" class="tenant-checkbox" data-id="${tenant.id}" class="w-4 h-4"></td>
                <td class="px-4 py-3.5"><strong>${tenant.id}</strong></td>
                <td class="px-4 py-3.5"><i class="fas fa-user-circle text-purple-600 mr-2"></i>${tenant.name}</td>
                <td class="px-4 py-3.5"><small>${tenant.email}<br>${tenant.phone}</small></td>
                <td class="px-4 py-3.5">${tenant.property}</td>
                <td class="px-4 py-3.5">${tenant.unit}</td>
                <td class="px-4 py-3.5"><strong>${formatAmount(tenant.rent)}</strong></td>
                <td class="px-4 py-3.5">${formatDate(tenant.leaseEnd)}</td>
                <td class="px-4 py-3.5">${getStatusBadge(tenant.status)}</td>
                <td class="px-4 py-3.5 action-buttons">
                    <i class="fas fa-eye" title="View Details" onclick="viewTenant('${tenant.id}')"></i>
                    <i class="fas fa-edit" title="Edit" onclick="editTenant('${tenant.id}')"></i>
                    <i class="fas fa-envelope" title="Message" onclick="messageTenant('${tenant.id}')"></i>
                </td>
            </tr>
        `).join('');
    }
    
    document.getElementById('showingInfo').innerHTML = `Showing ${start+1} to ${Math.min(start+rowsPerPage, filtered.length)} of ${filtered.length} tenants`;
    renderPagination(totalPages);
}

function renderPagination(totalPages) {
    const paginationDiv = document.getElementById('pagination');
    if (totalPages <= 1) { paginationDiv.innerHTML = ''; return; }
    let html = '';
    for (let i = 1; i <= totalPages; i++) {
        html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
    }
    paginationDiv.innerHTML = html;
}

function goToPage(page) { currentPage = page; renderTable(); }
function applyFilters() {
    currentFilters = { 
        search: document.getElementById('searchInput')?.value || '', 
        status: document.getElementById('statusFilter')?.value || 'all', 
        property: document.getElementById('propertyFilter')?.value || 'all', 
        lease: document.getElementById('leaseFilter')?.value || 'all' 
    };
    currentPage = 1;
    renderTable();
}
function clearFilters() {
    if (document.getElementById('searchInput')) document.getElementById('searchInput').value = '';
    if (document.getElementById('statusFilter')) document.getElementById('statusFilter').value = 'all';
    if (document.getElementById('propertyFilter')) document.getElementById('propertyFilter').value = 'all';
    if (document.getElementById('leaseFilter')) document.getElementById('leaseFilter').value = 'all';
    applyFilters();
}
function viewTenant(id) { alert(`Viewing details for tenant ${id}`); }
function editTenant(id) { alert(`Editing tenant ${id}`); }
function messageTenant(id) { alert(`Sending message to tenant ${id}`); }

// Select All functionality
document.getElementById('selectAll')?.addEventListener('change', function(e) {
    document.querySelectorAll('.tenant-checkbox').forEach(cb => cb.checked = e.target.checked);
});

// Event Listeners
document.getElementById('searchInput')?.addEventListener('input', applyFilters);
document.getElementById('statusFilter')?.addEventListener('change', applyFilters);
document.getElementById('propertyFilter')?.addEventListener('change', applyFilters);
document.getElementById('leaseFilter')?.addEventListener('change', applyFilters);
document.getElementById('clearFilters')?.addEventListener('click', clearFilters);
document.getElementById('addTenantBtn')?.addEventListener('click', () => alert('Add new tenant form'));
document.getElementById('exportBtn')?.addEventListener('click', () => alert('Exporting tenants data'));
document.getElementById('bulkMessageBtn')?.addEventListener('click', () => alert('Send message to selected tenants'));

renderTable();
</script>
@endsection