{{-- resources/views/leases/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Lease Management')

@section('content')
<div class="leases-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1><i class="fas fa-file-signature"></i> Lease Management</h1>
            <p>Manage all rental agreements, renewals, and lease documents</p>
        </div>
        <button class="btn-add-lease" id="addLeaseBtn">
            <i class="fas fa-plus-circle"></i> Create New Lease
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <x-stat-card 
            title="Active Leases" 
            value="42" 
            icon="fa-file-signature" 
            iconColor="purple"
            trend="+8 this month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Expiring Soon" 
            value="6" 
            icon="fa-clock" 
            iconColor="orange"
            trend="Next 30 days"
            :trendUp="false"
        />

        <x-stat-card 
            title="Expired Leases" 
            value="3" 
            icon="fa-calendar-times" 
            iconColor="red"
            trend="Need renewal"
            :trendUp="false"
        />

        <x-stat-card 
            title="Average Lease Term" 
            value="14.5" 
            icon="fa-chart-line" 
            iconColor="green"
            trend="months"
            :trendUp="true"
            subtext="+2.3 months YoY"
        />
    </div>

    <!-- Filters Section -->
    <div class="filters-card">
        <div class="filters-header">
            <h3><i class="fas fa-filter"></i> Filter Leases</h3>
            <button class="btn-clear" id="clearFilters">
                <i class="fas fa-eraser"></i> Clear All
            </button>
        </div>
        <div class="filters-grid">
            <div class="filter-group">
                <label><i class="fas fa-search"></i> Search</label>
                <input type="text" id="searchInput" placeholder="Tenant, property, or lease ID..." class="filter-input">
            </div>
            <div class="filter-group">
                <label><i class="fas fa-tag"></i> Status</label>
                <select id="statusFilter" class="filter-select">
                    <option value="all">All Statuses</option>
                    <option value="active"> Active</option>
                    <option value="expiring"> Expiring Soon</option>
                    <option value="expired"> Expired</option>
                    <option value="terminated"> Terminated</option>
                </select>
            </div>
            <div class="filter-group">
                <label><i class="fas fa-calendar"></i> Lease Type</label>
                <select id="typeFilter" class="filter-select">
                    <option value="all">All Types</option>
                    <option value="standard">Standard Residential</option>
                    <option value="commercial">Commercial</option>
                    <option value="shortterm">Short-term</option>
                    <option value="sublease">Sublease</option>
                </select>
            </div>
            <div class="filter-group">
                <label><i class="fas fa-building"></i> Property</label>
                <select id="propertyFilter" class="filter-select">
                    <option value="all">All Properties</option>
                    <option value="sunset">Sunset Apartments</option>
                    <option value="maple">Maple Grove</option>
                    <option value="harbor">Harbor Loft</option>
                    <option value="oakwood">Oakwood Residence</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Analytics Row -->
    <div class="analytics-row">
        <div class="chart-container">
            <div class="card-header">
                <h3><i class="fas fa-chart-line"></i> Lease Expiration Timeline</h3>
                <span class="badge-year">Next 6 Months</span>
            </div>
            <canvas id="expirationChart" width="400" height="200"></canvas>
        </div>

        <div class="summary-container">
            <div class="card-header">
                <h3><i class="fas fa-chart-pie"></i> Lease Summary</h3>
                <i class="fas fa-info-circle" style="color:#94a3b8; cursor:help;" title="Current lease statistics"></i>
            </div>
            <div class="summary-stats">
                <div class="summary-item">
                    <span><i class="fas fa-home"></i> Total Units</span>
                    <strong>48 properties</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-file-contract"></i> Occupied Units</span>
                    <strong>42 units</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-percent"></i> Occupancy Rate</span>
                    <strong>87.5%</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-dollar-sign"></i> Monthly Revenue</span>
                    <strong>$74,250</strong>
                </div>
                <div class="summary-item total">
                    <span><i class="fas fa-calendar-week"></i> Avg. Lease Duration</span>
                    <strong>14.5 months</strong>
                </div>
                <div class="summary-item due-alert">
                    <span><i class="fas fa-bell"></i> Renewals Needed</span>
                    <strong>9 leases expiring soon</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Leases Table -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-file-contract"></i> Active & Upcoming Leases</h3>
            <div class="table-actions">
                <button class="btn-export" id="exportBtn">
                    <i class="fas fa-download"></i> Export CSV
                </button>
                <button class="btn-print" id="printBtn">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn-renew" id="bulkRenewBtn">
                    <i class="fas fa-sync-alt"></i> Bulk Renew
                </button>
            </div>
        </div>
        
        <div class="table-wrapper">
            <table id="leasesTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Lease ID</th>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Unit</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Monthly Rent</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="leasesTableBody">
                    <!-- Dynamic rows will appear here -->
                </tbody>
            </table>
        </div>
        
        <div class="table-footer">
            <div class="showing-info" id="showingInfo">Showing 0 of 0 entries</div>
            <div class="pagination" id="pagination"></div>
        </div>
    </div>
</div>

<style>
    .leases-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-header h1 {
        font-size: 28px;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .page-header h1 i {
        color: #667eea;
        margin-right: 12px;
    }

    .page-header p {
        color: #64748b;
        font-size: 14px;
    }

    .btn-add-lease {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .btn-add-lease:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    /* Stats Cards - Reusing same styles */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 22px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 22px;
        border-radius: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #eef2f6;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -12px rgba(0,0,0,0.1);
    }

    .stat-info h4 {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 10px;
    }

    .stat-info h4 i {
        margin-right: 6px;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .stat-info small {
        font-size: 12px;
        color: #10b981;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: white;
    }

    .stat-icon.purple { background: linear-gradient(135deg, #667eea, #764ba2); }
    .stat-icon.orange { background: linear-gradient(135deg, #f59e0b, #ea580c); }
    .stat-icon.red { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .stat-icon.green { background: linear-gradient(135deg, #10b981, #059669); }

    /* Filters Card */
    .filters-card {
        background: white;
        border-radius: 20px;
        padding: 20px 24px;
        margin-bottom: 30px;
        border: 1px solid #eef2f6;
    }

    .filters-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .filters-header h3 {
        font-size: 16px;
        color: #1e293b;
    }

    .btn-clear {
        background: #f1f5f9;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        color: #475569;
        transition: 0.2s;
    }

    .btn-clear:hover {
        background: #e2e8f0;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .filter-group label {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
    }

    .filter-input, .filter-select {
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        transition: 0.2s;
    }

    .filter-input:focus, .filter-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Analytics Row */
    .analytics-row {
        display: grid;
        grid-template-columns: 1.4fr 0.8fr;
        gap: 24px;
        margin-bottom: 30px;
    }

    .chart-container, .summary-container {
        background: white;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #eef2f6;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .card-header h3 {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
    }

    .badge-year {
        background: #eef2ff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: #4f46e5;
    }

    canvas {
        max-height: 230px;
        width: 100%;
    }

    .summary-stats {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .summary-item.total {
        border-top: 2px solid #e2e8f0;
        border-bottom: none;
        padding-top: 16px;
        margin-top: 4px;
        font-weight: 700;
    }

    .summary-item.due-alert {
        background: #fef3c7;
        padding: 12px 16px;
        border-radius: 12px;
        border: none;
        margin-top: 8px;
    }

    /* Table Styles */
    .table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #eef2f6;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #eef2f6;
        flex-wrap: wrap;
        gap: 12px;
    }

    .table-header h3 {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
    }

    .table-actions {
        display: flex;
        gap: 12px;
    }

    .btn-export, .btn-print, .btn-renew {
        padding: 8px 16px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 10px;
        cursor: pointer;
        font-size: 13px;
        transition: 0.2s;
    }

    .btn-renew {
        background: #667eea;
        color: white;
        border: none;
    }

    .btn-renew:hover {
        background: #5a67d8;
    }

    .btn-export:hover, .btn-print:hover {
        background: #f8fafc;
        border-color: #667eea;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }

    th {
        background: #fafcff;
        font-weight: 600;
        color: #475569;
        font-size: 13px;
    }

    tr:hover td {
        background: #faf9fe;
    }

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

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-top: 1px solid #eef2f6;
        flex-wrap: wrap;
        gap: 12px;
    }

    .showing-info {
        font-size: 13px;
        color: #64748b;
    }

    .pagination {
        display: flex;
        gap: 8px;
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

    @media (max-width: 968px) {
        .analytics-row {
            grid-template-columns: 1fr;
        }
    }

    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
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

    function getDaysRemaining(endDate) {
        const today = new Date();
        const end = new Date(endDate);
        const diffTime = end - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays;
    }

    function filterLeases() {
        return leases.filter(lease => {
            // Search filter
            if (currentFilters.search) {
                const searchTerm = currentFilters.search.toLowerCase();
                const matchesSearch = lease.tenant.toLowerCase().includes(searchTerm) ||
                                    lease.property.toLowerCase().includes(searchTerm) ||
                                    lease.id.toLowerCase().includes(searchTerm) ||
                                    lease.unit.toLowerCase().includes(searchTerm);
                if (!matchesSearch) return false;
            }
            
            // Status filter
            if (currentFilters.status !== 'all' && lease.status !== currentFilters.status) return false;
            
            // Type filter
            if (currentFilters.type !== 'all' && lease.type !== currentFilters.type) return false;
            
            // Property filter
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
        
        if (pageData.length === 0) {
            tbody.innerHTML = '<tr><td colspan="10" style="text-align: center; padding: 40px;">No leases found</td></tr>';
        } else {
            tbody.innerHTML = pageData.map(lease => `
                <tr>
                    <td><input type="checkbox" class="lease-checkbox" data-id="${lease.id}"></td>
                    <td><strong>${lease.id}</strong></td>
                    <td><i class="fas fa-user-circle" style="color:#667eea; margin-right:8px;"></i>${lease.tenant}</td>
                    <td><i class="fas fa-building"></i> ${lease.property}</td>
                    <td>${lease.unit}</td>
                    <td>${formatDate(lease.startDate)}</td>
                    <td>${formatDate(lease.endDate)}</td>
                    <td><strong>${formatAmount(lease.rent)}</strong></td>
                    <td>${getStatusBadge(lease.status)}</td>
                    <td class="action-buttons">
                        <i class="fas fa-eye" title="View Details" onclick="viewLease('${lease.id}')"></i>
                        <i class="fas fa-file-pdf" title="Download PDF" onclick="downloadLease('${lease.id}')"></i>
                        <i class="fas fa-sync-alt" title="Renew" onclick="renewLease('${lease.id}')"></i>
                        <i class="fas fa-edit" title="Edit" onclick="editLease('${lease.id}')"></i>
                    </td>
                </tr>
            `).join('');
        }
        
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
            search: document.getElementById('searchInput').value,
            status: document.getElementById('statusFilter').value,
            type: document.getElementById('typeFilter').value,
            property: document.getElementById('propertyFilter').value
        };
        currentPage = 1;
        renderTable();
    }
    
    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('statusFilter').value = 'all';
        document.getElementById('typeFilter').value = 'all';
        document.getElementById('propertyFilter').value = 'all';
        applyFilters();
    }
    
    // Action functions
    function viewLease(id) {
        alert(`Viewing lease ${id} - Full details would be shown here`);
    }
    
    function downloadLease(id) {
        alert(`Downloading lease agreement for ${id}`);
    }
    
    function renewLease(id) {
        alert(`Renewing lease ${id} - Renewal form would open`);
    }
    
    function editLease(id) {
        alert(`Editing lease ${id} - Edit form would open`);
    }
    
    // Chart initialization
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
                scales: {
                    y: { 
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    }
    
    // Select All functionality
    document.getElementById('selectAll')?.addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.lease-checkbox');
        checkboxes.forEach(cb => cb.checked = e.target.checked);
    });
    
    // Bulk Renew
    document.getElementById('bulkRenewBtn')?.addEventListener('click', function() {
        const selected = document.querySelectorAll('.lease-checkbox:checked');
        if (selected.length === 0) {
            alert('Please select at least one lease to renew');
            return;
        }
        alert(`Renewing ${selected.length} selected leases`);
    });
    
    // Event Listeners
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