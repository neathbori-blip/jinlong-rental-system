{{-- resources/views/payments/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Payments Management')

@section('content')
<div class="payments-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1><i class="fas fa-credit-card"></i> Payments Management</h1>
            <p>Track, manage, and analyze all rental payments in one place</p>
        </div>
        <button class="btn-add-payment" id="addPaymentBtn">
            <i class="fas fa-plus-circle"></i> Record New Payment
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-dollar-sign"></i> Total Revenue</h4>
                <div class="stat-number">$48,920</div>
                <small><i class="fas fa-arrow-up"></i> +12.5% from last month</small>
            </div>
            <div class="stat-icon purple">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-hourglass-half"></i> Pending Payments</h4>
                <div class="stat-number">$6,450</div>
                <small><i class="fas fa-clock"></i> 8 unpaid invoices</small>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-clock"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-exclamation-triangle"></i> Overdue</h4>
                <div class="stat-number">$2,340</div>
                <small><i class="fas fa-calendar-times"></i> 3 tenants overdue</small>
            </div>
            <div class="stat-icon red">
                <i class="fas fa-bell"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h4><i class="fas fa-check-circle"></i> Collection Rate</h4>
                <div class="stat-number">87.5%</div>
                <small><i class="fas fa-building"></i> 42/48 units paying</small>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-percent"></i>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="filters-card">
        <div class="filters-header">
            <h3><i class="fas fa-filter"></i> Filter Payments</h3>
            <button class="btn-clear" id="clearFilters">
                <i class="fas fa-eraser"></i> Clear All
            </button>
        </div>
        <div class="filters-grid">
            <div class="filter-group">
                <label><i class="fas fa-search"></i> Search</label>
                <input type="text" id="searchInput" placeholder="Tenant, property, or transaction ID..." class="filter-input">
            </div>
            <div class="filter-group">
                <label><i class="fas fa-tag"></i> Status</label>
                <select id="statusFilter" class="filter-select">
                    <option value="all">All Statuses</option>
                    <option value="paid"> Paid</option>
                    <option value="pending"> Pending</option>
                    <option value="overdue"> Overdue</option>
                </select>
            </div>
            <div class="filter-group">
                <label><i class="fas fa-calendar"></i> Month</label>
                <select id="monthFilter" class="filter-select">
                    <option value="all">All Months</option>
                    <option value="2025-01">January 2026</option>
                    <option value="2025-02">February 2026</option>
                    <option value="2025-03">March 2026</option>
                    <option value="2025-04">April 2026</option>
                </select>
            </div>
            <div class="filter-group">
                <label><i class="fas fa-dollar-sign"></i> Min Amount</label>
                <input type="number" id="minAmount" placeholder="$0" class="filter-input">
            </div>
        </div>
    </div>

    <!-- Analytics Row -->
    <div class="analytics-row">
        <div class="chart-container">
            <div class="card-header">
                <h3><i class="fas fa-chart-line"></i> Monthly Revenue Trend</h3>
                <span class="badge-year">2026</span>
            </div>
            <canvas id="revenueChart" width="400" height="200"></canvas>
        </div>

        <div class="summary-container">
            <div class="card-header">
                <h3><i class="fas fa-chart-pie"></i> Payment Summary</h3>
                <i class="fas fa-info-circle" style="color:#94a3b8; cursor:help;" title="Last 30 days overview"></i>
            </div>
            <div class="summary-stats">
                <div class="summary-item">
                    <span><i class="fas fa-check-circle" style="color:#10b981;"></i> Completed</span>
                    <strong>34 payments</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-spinner" style="color:#f59e0b;"></i> Pending</span>
                    <strong>8 payments</strong>
                </div>
                <div class="summary-item">
                    <span><i class="fas fa-exclamation-circle" style="color:#ef4444;"></i> Overdue</span>
                    <strong>3 payments</strong>
                </div>
                <div class="summary-item total">
                    <span><i class="fas fa-chart-simple"></i> Total Transactions</span>
                    <strong>45 payments</strong>
                </div>
                <div class="summary-item due-alert">
                    <span><i class="fas fa-bell"></i> Next Rent Due</span>
                    <strong>May 1, 2026</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-receipt"></i> Recent Transactions</h3>
            <div class="table-actions">
                <button class="btn-export" id="exportBtn">
                    <i class="fas fa-download"></i> Export CSV
                </button>
                <button class="btn-print" id="printBtn">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
        
        <div class="table-wrapper">
            <table id="paymentsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Amount</th>
                        <th>Due Date</th>
                        <th>Paid Date</th>
                        <th>Status</th>
                        <th>Method</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="paymentsTableBody">
                    <!-- Dynamic rows will appear here -->
                </tbody>
            </table>
        </div>
        
        <div class="table-footer">
            <div class="showing-info" id="showingInfo">Showing 0 of 0 entries</div>
            <div class="pagination" id="pagination">
                <!-- Pagination will be added here -->
            </div>
        </div>
    </div>
</div>

<style>
    .payments-container {
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

    .btn-add-payment {
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

    .btn-add-payment:hover {
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

    .btn-export, .btn-print {
        padding: 8px 16px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 10px;
        cursor: pointer;
        font-size: 13px;
        transition: 0.2s;
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

    .badge-paid { background: #d1fae5; color: #065f46; }
    .badge-pending { background: #fed7aa; color: #92400e; }
    .badge-overdue { background: #fee2e2; color: #991b1b; }

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
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Payment Data
  

    let currentPage = 1;
    let rowsPerPage = 8;
    let currentFilters = {
        search: '',
        status: 'all',
        month: 'all',
        minAmount: ''
    };

    function formatDate(dateStr) {
        if (!dateStr) return '-';
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    function formatAmount(amount) {
        return `$${amount.toLocaleString()}`;
    }

    function getStatusBadge(status) {
        const badges = {
            'paid': '<span class="badge badge-paid"><i class="fas fa-check-circle"></i> Paid</span>',
            'pending': '<span class="badge badge-pending"><i class="fas fa-clock"></i> Pending</span>',
            'overdue': '<span class="badge badge-overdue"><i class="fas fa-exclamation-circle"></i> Overdue</span>'
        };
        return badges[status] || badges.pending;
    }

    function filterPayments() {
        return payments.filter(payment => {
            // Search filter
            if (currentFilters.search) {
                const searchTerm = currentFilters.search.toLowerCase();
                const matchesSearch = payment.tenant.toLowerCase().includes(searchTerm) ||
                                    payment.property.toLowerCase().includes(searchTerm) ||
                                    payment.id.toLowerCase().includes(searchTerm);
                if (!matchesSearch) return false;
            }
            
            // Status filter
            if (currentFilters.status !== 'all' && payment.status !== currentFilters.status) return false;
            
            // Month filter
            if (currentFilters.month !== 'all') {
                const paymentMonth = payment.dueDate.substring(0, 7);
                if (paymentMonth !== currentFilters.month) return false;
            }
            
            // Min amount filter
            if (currentFilters.minAmount && payment.amount < parseFloat(currentFilters.minAmount)) return false;
            
            return true;
        });
    }

    function renderTable() {
        const filtered = filterPayments();
        const totalPages = Math.ceil(filtered.length / rowsPerPage);
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageData = filtered.slice(start, end);
        
        const tbody = document.getElementById('paymentsTableBody');
        
        if (pageData.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 40px;">No payments found</td></tr>';
        } else {
            tbody.innerHTML = pageData.map(p => `
                <tr>
                    <td><strong>${p.id}</strong></td>
                    <td><i class="fas fa-user-circle" style="color:#667eea; margin-right:8px;"></i>${p.tenant}</td>
                    <td><i class="fas fa-home"></i> ${p.property}</td>
                    <td><strong>${formatAmount(p.amount)}</strong></td>
                    <td>${formatDate(p.dueDate)}</td>
                    <td>${formatDate(p.paidDate)}</td>
                    <td>${getStatusBadge(p.status)}</td>
                    <td>${p.method}</td>
                    <td class="action-buttons">
                        <i class="fas fa-eye" title="View Details" onclick="alert('View payment ${p.id}')"></i>
                        <i class="fas fa-receipt" title="Receipt" onclick="alert('Download receipt for ${p.id}')"></i>
                        <i class="fas fa-edit" title="Edit" onclick="alert('Edit payment ${p.id}')"></i>
                    </td>
                </tr>
            `).join('');
        }
        
        // Update showing info
        document.getElementById('showingInfo').innerHTML = `Showing ${start+1} to ${Math.min(end, filtered.length)} of ${filtered.length} entries`;
        
        // Render pagination
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
            month: document.getElementById('monthFilter').value,
            minAmount: document.getElementById('minAmount').value
        };
        currentPage = 1;
        renderTable();
    }
    
    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('statusFilter').value = 'all';
        document.getElementById('monthFilter').value = 'all';
        document.getElementById('minAmount').value = '';
        applyFilters();
    }
    
    // Chart initialization
    let revenueChart;
    function initChart() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: [12450, 14100, 13800, 15280, 14900, 16350],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.05)',
                    borderWidth: 3,
                    pointBackgroundColor: '#764ba2',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { callbacks: { label: (ctx) => `$${ctx.raw.toLocaleString()}` } }
                },
                scales: {
                    y: { ticks: { callback: (val) => '$' + val.toLocaleString() } }
                }
            }
        });
    }
    
    // Event Listeners
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    document.getElementById('statusFilter').addEventListener('change', applyFilters);
    document.getElementById('monthFilter').addEventListener('change', applyFilters);
    document.getElementById('minAmount').addEventListener('input', applyFilters);
    document.getElementById('clearFilters').addEventListener('click', clearFilters);
    document.getElementById('exportBtn').addEventListener('click', () => alert('CSV export feature ready for backend integration'));
    document.getElementById('printBtn').addEventListener('click', () => window.print());
    document.getElementById('addPaymentBtn').addEventListener('click', () => alert('Add payment form - ready for integration'));
    
    // Initialize
    initChart();
    renderTable();
</script>
@endsection