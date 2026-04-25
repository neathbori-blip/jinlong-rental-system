{{-- resources/views/maintenance/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Maintenance Management')

@section('content')
<div class="maintenance-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1><i class="fas fa-tools"></i> Maintenance Management</h1>
            <p>Track, manage, and resolve maintenance requests across all properties</p>
        </div>
        <button class="btn-add-request" id="addRequestBtn">
            <i class="fas fa-plus-circle"></i> New Maintenance Request
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-clipboard-list"></i> Open Requests</h4>
                <div class="stat-number">12</div>
                <small><i class="fas fa-arrow-up"></i> +3 today</small>
            </div>
            <div class="stat-icon purple">
                <i class="fas fa-clipboard-list"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-spinner"></i> In Progress</h4>
                <div class="stat-number">8</div>
                <small><i class="fas fa-clock"></i> Being worked on</small>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-spinner"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-check-circle"></i> Completed (This Month)</h4>
                <div class="stat-number">24</div>
                <small><i class="fas fa-arrow-up"></i> +12 vs last month</small>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-clock"></i> Avg. Response Time</h4>
                <div class="stat-number">4.2</div>
                <small><i class="fas fa-hourglass-half"></i> hours</small>
            </div>
            <div class="stat-icon blue">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <!-- Quick Action Alerts -->
    <div class="alerts-card" id="urgentAlerts">
        <div class="alerts-header">
            <h3><i class="fas fa-exclamation-triangle"></i> Urgent Requests</h3>
            <span class="urgent-count">3 urgent</span>
        </div>
        <div class="alerts-list">
            <div class="alert-item urgent">
                <div class="alert-icon"><i class="fas fa-water"></i></div>
                <div class="alert-content">
                    <strong>Water Leak - Unit #4B</strong>
                    <span>Sunset Apartments - Reported 2 hours ago</span>
                </div>
                <button class="btn-assign">Assign Now</button>
            </div>
            <div class="alert-item urgent">
                <div class="alert-icon"><i class="fas fa-bolt"></i></div>
                <div class="alert-content">
                    <strong>Electrical Issue - Unit #12</strong>
                    <span>Maple Grove - Power outage reported</span>
                </div>
                <button class="btn-assign">Assign Now</button>
            </div>
            <div class="alert-item warning">
                <div class="alert-icon"><i class="fas fa-temperature-high"></i></div>
                <div class="alert-content">
                    <strong>AC Not Working - Unit #7</strong>
                    <span>Harbor Loft - Reported 5 hours ago</span>
                </div>
                <button class="btn-assign">Assign Now</button>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="filters-card">
        <div class="filters-header">
            <h3><i class="fas fa-filter"></i> Filter Maintenance Requests</h3>
            <button class="btn-clear" id="clearFilters">
                <i class="fas fa-eraser"></i> Clear All
            </button>
        </div>
        <div class="filters-grid">
            <div class="filter-group">
                <label><i class="fas fa-search"></i> Search</label>
                <input type="text" id="searchInput" placeholder="Request ID, tenant, or property..." class="filter-input">
            </div>
            <div class="filter-group">
                <label><i class="fas fa-tag"></i> Status</label>
                <select id="statusFilter" class="filter-select">
                    <option value="all">All Statuses</option>
                    <option value="open">🆕 Open</option>
                    <option value="in-progress">⚙️ In Progress</option>
                    <option value="review">🔍 Under Review</option>
                    <option value="completed">✅ Completed</option>
                    <option value="cancelled">❌ Cancelled</option>
                </select>
            </div>
            <div class="filter-group">
                <label><i class="fas fa-exclamation-triangle"></i> Priority</label>
                <select id="priorityFilter" class="filter-select">
                    <option value="all">All Priorities</option>
                    <option value="urgent">🔴 Urgent</option>
                    <option value="high">🟠 High</option>
                    <option value="medium">🟡 Medium</option>
                    <option value="low">🟢 Low</option>
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
                    <option value="pine">Pine Hill</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Analytics Row -->
    <div class="analytics-row">
        <div class="chart-container">
            <div class="card-header">
                <h3><i class="fas fa-chart-line"></i> Maintenance Trends</h3>
                <span class="badge-year">Last 6 Months</span>
            </div>
            <canvas id="maintenanceChart" width="400" height="200"></canvas>
        </div>

        <div class="summary-container">
            <div class="card-header">
                <h3><i class="fas fa-chart-pie"></i> Maintenance Summary</h3>
                <i class="fas fa-info-circle" style="color:#94a3b8; cursor:help;" title="Current maintenance statistics"></i>
            </div>
            <div class="summary-stats">
                <div class="summary-item">
                    <span><i class="fas fa-folder-open"></i> Total Requests</span>
                    <strong>47 total</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-hourglass-half"></i> Avg. Completion Time</span>
                    <strong>3.2 days</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-dollar-sign"></i> Avg. Cost per Request</span>
                    <strong>$245</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-chart-line"></i> Resolution Rate</span>
                    <strong>89%</strong>
                </div>
                <div class="summary-item total">
                    <span><i class="fas fa-calendar-week"></i> This Month's Cost</span>
                    <strong>$4,280</strong>
                </div>
                <div class="summary-item due-alert">
                    <span><i class="fas fa-clock"></i> Overdue Requests</span>
                    <strong>4 requests</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Distribution -->
    <div class="categories-card">
        <div class="card-header">
            <h3><i class="fas fa-chart-bar"></i> Maintenance Categories</h3>
            <button class="btn-view-all" id="viewAllCategories">View Details</button>
        </div>
        <div class="categories-grid">
            <div class="category-item">
                <div class="category-icon plumbing"><i class="fas fa-faucet"></i></div>
                <div class="category-info">
                    <span class="category-name">Plumbing</span>
                    <span class="category-count">12 requests</span>
                </div>
                <div class="category-bar"><div class="bar-fill" style="width: 35%"></div></div>
            </div>
            <div class="category-item">
                <div class="category-icon electrical"><i class="fas fa-bolt"></i></div>
                <div class="category-info">
                    <span class="category-name">Electrical</span>
                    <span class="category-count">8 requests</span>
                </div>
                <div class="category-bar"><div class="bar-fill" style="width: 24%"></div></div>
            </div>
            <div class="category-item">
                <div class="category-icon hvac"><i class="fas fa-wind"></i></div>
                <div class="category-info">
                    <span class="category-name">HVAC</span>
                    <span class="category-count">10 requests</span>
                </div>
                <div class="category-bar"><div class="bar-fill" style="width: 29%"></div></div>
            </div>
            <div class="category-item">
                <div class="category-icon appliance"><i class="fas fa-tshirt"></i></div>
                <div class="category-info">
                    <span class="category-name">Appliances</span>
                    <span class="category-count">9 requests</span>
                </div>
                <div class="category-bar"><div class="bar-fill" style="width: 26%"></div></div>
            </div>
            <div class="category-item">
                <div class="category-icon general"><i class="fas fa-home"></i></div>
                <div class="category-info">
                    <span class="category-name">General</span>
                    <span class="category-count">8 requests</span>
                </div>
                <div class="category-bar"><div class="bar-fill" style="width: 24%"></div></div>
            </div>
        </div>
    </div>

    <!-- Maintenance Requests Table -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-clipboard-list"></i> Maintenance Requests</h3>
            <div class="table-actions">
                <button class="btn-export" id="exportBtn">
                    <i class="fas fa-download"></i> Export CSV
                </button>
                <button class="btn-print" id="printBtn">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn-assign-multiple" id="assignMultipleBtn">
                    <i class="fas fa-user-plus"></i> Assign Selected
                </button>
            </div>
        </div>
        
        <div class="table-wrapper">
            <table id="maintenanceTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Request ID</th>
                        <th>Property/Unit</th>
                        <th>Tenant</th>
                        <th>Issue Type</th>
                        <th>Priority</th>
                        <th>Reported Date</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="maintenanceTableBody">
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
    .maintenance-container {
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

    .btn-add-request {
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

    .btn-add-request:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    /* Stats Cards */
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
    .stat-icon.blue { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }

    /* Alerts Card */
    .alerts-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid #eef2f6;
        border-left: 4px solid #ef4444;
    }

    .alerts-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .alerts-header h3 {
        font-size: 16px;
        color: #1e293b;
    }

    .urgent-count {
        background: #ef4444;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .alerts-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .alert-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        border-radius: 12px;
        background: #f8fafc;
        transition: 0.2s;
    }

    .alert-item.urgent {
        background: #fef2f2;
        border-left: 3px solid #ef4444;
    }

    .alert-item.warning {
        background: #fffbeb;
        border-left: 3px solid #f59e0b;
    }

    .alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        font-size: 20px;
    }

    .alert-item.urgent .alert-icon { color: #ef4444; }
    .alert-item.warning .alert-icon { color: #f59e0b; }

    .alert-content {
        flex: 1;
        margin-left: 12px;
    }

    .alert-content strong {
        display: block;
        font-size: 14px;
        color: #1e293b;
    }

    .alert-content span {
        font-size: 12px;
        color: #64748b;
    }

    .btn-assign {
        padding: 6px 12px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        transition: 0.2s;
    }

    .btn-assign:hover {
        background: #5a67d8;
    }

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

    /* Categories Card */
    .categories-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid #eef2f6;
    }

    .btn-view-all {
        padding: 6px 12px;
        background: none;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        transition: 0.2s;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .category-item {
        padding: 12px;
        background: #f8fafc;
        border-radius: 12px;
    }

    .category-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        font-size: 20px;
    }

    .category-icon.plumbing { background: #dbeafe; color: #2563eb; }
    .category-icon.electrical { background: #fef3c7; color: #d97706; }
    .category-icon.hvac { background: #d1fae5; color: #059669; }
    .category-icon.appliance { background: #e0e7ff; color: #4f46e5; }
    .category-icon.general { background: #f3e8ff; color: #9333ea; }

    .category-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .category-name {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
    }

    .category-count {
        font-size: 12px;
        color: #64748b;
    }

    .category-bar {
        height: 6px;
        background: #e2e8f0;
        border-radius: 3px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 3px;
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

    .table-actions {
        display: flex;
        gap: 12px;
    }

    .btn-export, .btn-print, .btn-assign-multiple {
        padding: 8px 16px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 10px;
        cursor: pointer;
        font-size: 13px;
        transition: 0.2s;
    }

    .btn-assign-multiple {
        background: #667eea;
        color: white;
        border: none;
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

    input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    @media (max-width: 968px) {
        .analytics-row {
            grid-template-columns: 1fr;
        }
        .categories-grid {
            grid-template-columns: 1fr;
        }
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
            'urgent': '<span class="priority-urgent">🔴 Urgent</span>',
            'high': '<span class="priority-high">🟠 High</span>',
            'medium': '<span class="priority-medium">🟡 Medium</span>',
            'low': '<span class="priority-low">🟢 Low</span>'
        };
        return badges[priority] || badges.medium;
    }

    function getStatusBadge(status) {
        const badges = {
            'open': '<span class="badge badge-open">🆕 Open</span>',
            'in-progress': '<span class="badge badge-progress">⚙️ In Progress</span>',
            'review': '<span class="badge badge-review">🔍 Under Review</span>',
            'completed': '<span class="badge badge-completed">✅ Completed</span>',
            'cancelled': '<span class="badge badge-cancelled">❌ Cancelled</span>'
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
            search: document.getElementById('searchInput').value,
            status: document.getElementById('statusFilter').value,
            priority: document.getElementById('priorityFilter').value,
            property: document.getElementById('propertyFilter').value
        };
        currentPage = 1;
        renderTable();
    }
    
    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('statusFilter').value = 'all';
        document.getElementById('priorityFilter').value = 'all';
        document.getElementById('propertyFilter').value = 'all';
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
    
    initChart();
    renderTable();
</script>
@endsection