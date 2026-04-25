{{-- resources/views/reports/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('content')
<div class="reports-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1><i class="fas fa-chart-line"></i> Reports & Analytics</h1>
            <p>Comprehensive insights and financial reports for your property portfolio</p>
        </div>
        <div class="header-actions">
            <button class="btn-export-all" id="exportAllBtn">
                <i class="fas fa-download"></i> Export All
            </button>
            <button class="btn-schedule" id="scheduleReportBtn">
                <i class="fas fa-calendar-alt"></i> Schedule Report
            </button>
        </div>
    </div>

    <!-- Date Range Selector -->
    <div class="date-range-card">
        <div class="date-range-header">
            <h3><i class="fas fa-calendar-range"></i> Select Date Range</h3>
            <div class="quick-ranges">
                <button class="quick-range" data-range="7">Last 7 Days</button>
                <button class="quick-range" data-range="30">Last 30 Days</button>
                <button class="quick-range" data-range="90">Last 90 Days</button>
                <button class="quick-range" data-range="365">This Year</button>
            </div>
        </div>
        <div class="date-inputs">
            <div class="date-input-group">
                <label><i class="fas fa-calendar-alt"></i> Start Date</label>
                <input type="date" id="startDate" class="date-picker">
            </div>
            <div class="date-input-group">
                <label><i class="fas fa-calendar-alt"></i> End Date</label>
                <input type="date" id="endDate" class="date-picker">
            </div>
            <button class="btn-apply" id="applyDateRange">
                <i class="fas fa-sync-alt"></i> Apply
            </button>
        </div>
    </div>

    <!-- Key Metrics Row -->
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-icon purple">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="metric-info">
                <span class="metric-label">Total Revenue</span>
                <span class="metric-value">$124,850</span>
                <span class="metric-trend up"><i class="fas fa-arrow-up"></i> +8.2%</span>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon orange">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="metric-info">
                <span class="metric-label">Occupancy Rate</span>
                <span class="metric-value">87.5%</span>
                <span class="metric-trend up"><i class="fas fa-arrow-up"></i> +3.1%</span>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon green">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="metric-info">
                <span class="metric-label">Collection Rate</span>
                <span class="metric-value">94.2%</span>
                <span class="metric-trend up"><i class="fas fa-arrow-up"></i> +5.4%</span>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon red">
                <i class="fas fa-tools"></i>
            </div>
            <div class="metric-info">
                <span class="metric-label">Maintenance Cost</span>
                <span class="metric-value">$8,450</span>
                <span class="metric-trend down"><i class="fas fa-arrow-down"></i> -12.3%</span>
            </div>
        </div>
    </div>

    <!-- Report Tabs -->
    <div class="reports-tabs">
        <button class="tab-btn active" data-tab="financial">
            <i class="fas fa-chart-pie"></i> Financial Reports
        </button>
        <button class="tab-btn" data-tab="occupancy">
            <i class="fas fa-building"></i> Occupancy Reports
        </button>
        <button class="tab-btn" data-tab="maintenance">
            <i class="fas fa-tools"></i> Maintenance Reports
        </button>
        <button class="tab-btn" data-tab="tenants">
            <i class="fas fa-users"></i> Tenant Reports
        </button>
        <button class="tab-btn" data-tab="custom">
            <i class="fas fa-chart-simple"></i> Custom Reports
        </button>
    </div>

    <!-- Financial Reports Content -->
    <div id="financial-tab" class="tab-content active">
        <div class="reports-grid">
            <div class="report-card">
                <div class="report-header">
                    <h3><i class="fas fa-chart-line"></i> Revenue Trend</h3>
                    <button class="btn-download" onclick="downloadReport('revenue')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <canvas id="revenueTrendChart" height="250"></canvas>
            </div>

            <div class="report-card">
                <div class="report-header">
                    <h3><i class="fas fa-chart-pie"></i> Revenue by Property</h3>
                    <button class="btn-download" onclick="downloadReport('propertyRevenue')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <canvas id="propertyRevenueChart" height="250"></canvas>
            </div>

            <div class="report-card full-width">
                <div class="report-header">
                    <h3><i class="fas fa-table"></i> Monthly Breakdown</h3>
                    <button class="btn-download" onclick="downloadReport('monthly')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <div class="table-wrapper">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Revenue</th>
                                <th>Expenses</th>
                                <th>Net Profit</th>
                                <th>Growth</th>
                            </tr>
                        </thead>
                        <tbody id="monthlyBreakdown">
                            <!-- Dynamic content -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Occupancy Reports Content -->
    <div id="occupancy-tab" class="tab-content">
        <div class="reports-grid">
            <div class="report-card">
                <div class="report-header">
                    <h3><i class="fas fa-chart-line"></i> Occupancy Trend</h3>
                    <button class="btn-download" onclick="downloadReport('occupancyTrend')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <canvas id="occupancyChart" height="250"></canvas>
            </div>

            <div class="report-card">
                <div class="report-header">
                    <h3><i class="fas fa-chart-bar"></i> Property Performance</h3>
                    <button class="btn-download" onclick="downloadReport('propertyPerformance')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <canvas id="propertyPerformanceChart" height="250"></canvas>
            </div>

            <div class="report-card full-width">
                <div class="report-header">
                    <h3><i class="fas fa-building"></i> Property Occupancy Details</h3>
                </div>
                <div class="table-wrapper">
                    <table class="report-table">
                        <thead>
                            <tr><th>Property</th><th>Total Units</th><th>Occupied</th><th>Vacant</th><th>Occupancy Rate</th><th>Status</th></tr>
                        </thead>
                        <tbody id="propertyOccupancy">
                            <!-- Dynamic content -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance Reports Content -->
    <div id="maintenance-tab" class="tab-content">
        <div class="reports-grid">
            <div class="report-card">
                <div class="report-header">
                    <h3><i class="fas fa-chart-line"></i> Maintenance Trends</h3>
                    <button class="btn-download" onclick="downloadReport('maintenanceTrend')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <canvas id="maintenanceTrendChart" height="250"></canvas>
            </div>

            <div class="report-card">
                <div class="report-header">
                    <h3><i class="fas fa-chart-pie"></i> Issues by Category</h3>
                    <button class="btn-download" onclick="downloadReport('issuesCategory')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <canvas id="issuesCategoryChart" height="250"></canvas>
            </div>

            <div class="report-card full-width">
                <div class="report-header">
                    <h3><i class="fas fa-clock"></i> Response Time Analysis</h3>
                </div>
                <div class="table-wrapper">
                    <table class="report-table">
                        <thead><tr><th>Priority</th><th>Avg Response Time</th><th>Avg Resolution Time</th><th>Total Requests</th></tr></thead>
                        <tbody id="responseTimeAnalysis"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tenant Reports Content -->
    <div id="tenants-tab" class="tab-content">
        <div class="reports-grid">
            <div class="report-card full-width">
                <div class="report-header">
                    <h3><i class="fas fa-users"></i> Tenant Payment History</h3>
                    <button class="btn-download" onclick="downloadReport('tenantPayments')">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
                <div class="table-wrapper">
                    <table class="report-table">
                        <thead><tr><th>Tenant</th><th>Property</th><th>Monthly Rent</th><th>Payment Status</th><th>Last Payment</th><th>Outstanding</th></tr></thead>
                        <tbody id="tenantPayments"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Reports Content -->
    <div id="custom-tab" class="tab-content">
        <div class="custom-report-builder">
            <h3><i class="fas fa-chart-simple"></i> Custom Report Builder</h3>
            <div class="builder-grid">
                <div class="builder-section">
                    <label>Select Report Type</label>
                    <select id="reportType">
                        <option>Financial Summary</option>
                        <option>Occupancy Analysis</option>
                        <option>Maintenance Overview</option>
                        <option>Tenant Ledger</option>
                        <option>Property Comparison</option>
                    </select>
                </div>
                <div class="builder-section">
                    <label>Select Properties</label>
                    <select id="reportProperties" multiple>
                        <option>All Properties</option>
                        <option>Sunset Apartments</option>
                        <option>Maple Grove</option>
                        <option>Harbor Loft</option>
                    </select>
                </div>
                <div class="builder-section">
                    <label>Include Charts</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" checked> Revenue Chart</label>
                        <label><input type="checkbox" checked> Occupancy Chart</label>
                        <label><input type="checkbox"> Maintenance Chart</label>
                    </div>
                </div>
                <div class="builder-section">
                    <label>Format</label>
                    <select id="reportFormat">
                        <option>PDF</option>
                        <option>Excel</option>
                        <option>CSV</option>
                    </select>
                </div>
            </div>
            <button class="btn-generate" id="generateCustomReport">
                <i class="fas fa-chart-line"></i> Generate Report
            </button>
        </div>
    </div>
</div>

<style>
.reports-container { max-width: 1400px; margin: 0 auto; }
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
.page-header h1 { font-size: 28px; color: #1e293b; }
.page-header h1 i { color: #667eea; margin-right: 12px; }
.header-actions { display: flex; gap: 12px; }
.btn-export-all, .btn-schedule { padding: 10px 20px; border-radius: 10px; cursor: pointer; font-weight: 600; transition: 0.2s; }
.btn-export-all { background: #667eea; color: white; border: none; }
.btn-schedule { background: white; border: 1px solid #e2e8f0; }
.date-range-card { background: white; border-radius: 20px; padding: 20px; margin-bottom: 30px; }
.date-range-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px; }
.quick-ranges { display: flex; gap: 10px; }
.quick-range { padding: 6px 12px; background: #f1f5f9; border: none; border-radius: 8px; cursor: pointer; }
.date-inputs { display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap; }
.date-input-group { display: flex; flex-direction: column; gap: 5px; }
.date-picker { padding: 10px; border: 1px solid #e2e8f0; border-radius: 10px; }
.btn-apply { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 10px; cursor: pointer; }
.metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
.metric-card { background: white; padding: 20px; border-radius: 20px; display: flex; align-items: center; gap: 15px; }
.metric-icon { width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: white; }
.metric-icon.purple { background: linear-gradient(135deg, #667eea, #764ba2); }
.metric-icon.orange { background: linear-gradient(135deg, #f59e0b, #ea580c); }
.metric-icon.green { background: linear-gradient(135deg, #10b981, #059669); }
.metric-icon.red { background: linear-gradient(135deg, #ef4444, #dc2626); }
.metric-info { flex: 1; }
.metric-label { display: block; font-size: 13px; color: #64748b; margin-bottom: 5px; }
.metric-value { display: block; font-size: 28px; font-weight: 800; color: #1e293b; }
.metric-trend { font-size: 12px; margin-top: 5px; display: inline-block; }
.metric-trend.up { color: #10b981; }
.metric-trend.down { color: #ef4444; }
.reports-tabs { display: flex; gap: 10px; margin-bottom: 30px; border-bottom: 2px solid #e2e8f0; flex-wrap: wrap; }
.tab-btn { padding: 12px 24px; background: none; border: none; cursor: pointer; font-weight: 600; color: #64748b; transition: 0.2s; }
.tab-btn.active { color: #667eea; border-bottom: 2px solid #667eea; margin-bottom: -2px; }
.tab-content { display: none; }
.tab-content.active { display: block; }
.reports-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 25px; }
.report-card { background: white; border-radius: 20px; padding: 20px; border: 1px solid #eef2f6; }
.report-card.full-width { grid-column: 1 / -1; }
.report-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.report-header h3 { font-size: 18px; color: #1e293b; }
.btn-download { padding: 6px 12px; background: #f1f5f9; border: none; border-radius: 8px; cursor: pointer; }
.table-wrapper { overflow-x: auto; }
.report-table { width: 100%; border-collapse: collapse; }
.report-table th, .report-table td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
.report-table th { background: #f8fafc; font-weight: 600; }
.custom-report-builder { background: white; border-radius: 20px; padding: 30px; }
.builder-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 20px 0; }
.builder-section { display: flex; flex-direction: column; gap: 10px; }
.builder-section select, .builder-section input { padding: 10px; border: 1px solid #e2e8f0; border-radius: 10px; }
.checkbox-group { display: flex; flex-direction: column; gap: 8px; }
.btn-generate { padding: 12px 24px; background: #667eea; color: white; border: none; border-radius: 10px; cursor: pointer; width: 100%; font-weight: 600; }
canvas { max-height: 250px; width: 100%; }
@media (max-width: 768px) { .reports-grid { grid-template-columns: 1fr; } .quick-ranges { flex-wrap: wrap; } }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Initialize charts
let revenueChart, propertyRevenueChart, occupancyChart, propertyPerformanceChart, maintenanceTrendChart, issuesCategoryChart;

function initCharts() {
    revenueChart = new Chart(document.getElementById('revenueTrendChart'), {
        type: 'line',
        data: { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], datasets: [{ label: 'Revenue', data: [12450, 14100, 13800, 15280, 14900, 16350], borderColor: '#667eea', backgroundColor: 'rgba(102,126,234,0.1)', tension: 0.3, fill: true }] },
        options: { responsive: true, maintainAspectRatio: true }
    });
    
    propertyRevenueChart = new Chart(document.getElementById('propertyRevenueChart'), {
        type: 'pie',
        data: { labels: ['Sunset Apartments', 'Maple Grove', 'Harbor Loft', 'Others'], datasets: [{ data: [35, 28, 22, 15], backgroundColor: ['#667eea', '#764ba2', '#f59e0b', '#10b981'] }] }
    });
    
    occupancyChart = new Chart(document.getElementById('occupancyChart'), {
        type: 'line',
        data: { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], datasets: [{ label: 'Occupancy %', data: [82, 84, 85, 86, 87, 88], borderColor: '#10b981', tension: 0.3, fill: true }] }
    });
    
    propertyPerformanceChart = new Chart(document.getElementById('propertyPerformanceChart'), {
        type: 'bar',
        data: { labels: ['Sunset', 'Maple', 'Harbor', 'Oakwood', 'Pine'], datasets: [{ label: 'Occupancy %', data: [92, 88, 85, 90, 82], backgroundColor: '#667eea' }] }
    });
    
    maintenanceTrendChart = new Chart(document.getElementById('maintenanceTrendChart'), {
        type: 'line',
        data: { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], datasets: [{ label: 'Requests', data: [8, 12, 15, 18, 22, 14], borderColor: '#f59e0b', tension: 0.3 }] }
    });
    
    issuesCategoryChart = new Chart(document.getElementById('issuesCategoryChart'), {
        type: 'doughnut',
        data: { labels: ['Plumbing', 'Electrical', 'HVAC', 'Appliances', 'General'], datasets: [{ data: [12, 8, 10, 9, 8], backgroundColor: ['#3b82f6', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6'] }] }
    });
}

// Populate tables with data
const monthlyData = [
    { month: 'January', revenue: 12450, expenses: 3200, profit: 9250, growth: '+2.1%' },
    { month: 'February', revenue: 14100, expenses: 3450, profit: 10650, growth: '+15.1%' },
    { month: 'March', revenue: 13800, expenses: 3300, profit: 10500, growth: '-1.4%' },
    { month: 'April', revenue: 15280, expenses: 3600, profit: 11680, growth: '+11.2%' },
    { month: 'May', revenue: 14900, expenses: 3550, profit: 11350, growth: '-2.8%' },
    { month: 'June', revenue: 16350, expenses: 3800, profit: 12550, growth: '+10.6%' }
];

function populateTables() {
    const monthlyTbody = document.getElementById('monthlyBreakdown');
    if(monthlyTbody) monthlyTbody.innerHTML = monthlyData.map(m => `<tr><td>${m.month}</td><td>$${m.revenue}</td><td>$${m.expenses}</td><td>$${m.profit}</td><td class="${m.growth.includes('-') ? 'down' : 'up'}">${m.growth}</td></tr>`).join('');
    
    const propertyOccupancy = document.getElementById('propertyOccupancy');
    if(propertyOccupancy) propertyOccupancy.innerHTML = `
        <tr><td>Sunset Apartments</td><td>12</td><td>11</td><td>1</td><td>91.7%</td><td><span class="badge badge-success">Excellent</span></td></tr>
        <tr><td>Maple Grove</td><td>10</td><td>9</td><td>1</td><td>90%</td><td><span class="badge badge-success">Excellent</span></td></tr>
        <tr><td>Harbor Loft</td><td>8</td><td>7</td><td>1</td><td>87.5%</td><td><span class="badge badge-warning">Good</span></td></tr>
        <tr><td>Oakwood Residence</td><td>10</td><td>8</td><td>2</td><td>80%</td><td><span class="badge badge-warning">Average</span></td></tr>
        <tr><td>Pine Hill</td><td>8</td><td>7</td><td>1</td><td>87.5%</td><td><span class="badge badge-warning">Good</span></td></tr>
    `;
    
    const responseTime = document.getElementById('responseTimeAnalysis');
    if(responseTime) responseTime.innerHTML = `
        <tr><td>Urgent</td><td>1.2 hours</td><td>4.5 hours</td><td>15</td></tr>
        <tr><td>High</td><td>3.5 hours</td><td>12 hours</td><td>22</td></tr>
        <tr><td>Medium</td><td>8 hours</td><td>24 hours</td><td>28</td></tr>
        <tr><td>Low</td><td>24 hours</td><td>48 hours</td><td>18</td></tr>
    `;
    
    const tenantPayments = document.getElementById('tenantPayments');
    if(tenantPayments) tenantPayments.innerHTML = `
        <tr><td>Emily Clarke</td><td>Sunset #4B</td><td>$1,850</td><td><span class="badge badge-success">Paid</span></td><td>Apr 1, 2025</td><td>$0</td></tr>
        <tr><td>James Wilson</td><td>Maple #12</td><td>$2,200</td><td><span class="badge badge-success">Paid</span></td><td>Apr 3, 2025</td><td>$0</td></tr>
        <tr><td>Sophia Martinez</td><td>Harbor #7</td><td>$1,750</td><td><span class="badge badge-warning">Pending</span></td><td>Mar 28, 2025</td><td>$1,750</td></tr>
        <tr><td>Liam Johnson</td><td>Oakwood #2</td><td>$1,950</td><td><span class="badge badge-danger">Overdue</span></td><td>Mar 15, 2025</td><td>$3,900</td></tr>
    `;
}

// Tab switching
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById(`${btn.dataset.tab}-tab`).classList.add('active');
    });
});

// Quick date ranges
document.querySelectorAll('.quick-range').forEach(btn => {
    btn.addEventListener('click', () => {
        const days = parseInt(btn.dataset.range);
        const end = new Date();
        const start = new Date();
        start.setDate(end.getDate() - days);
        document.getElementById('startDate').value = start.toISOString().split('T')[0];
        document.getElementById('endDate').value = end.toISOString().split('T')[0];
    });
});

function downloadReport(type) { alert(`Downloading ${type} report...`); }
document.getElementById('exportAllBtn')?.addEventListener('click', () => alert('Exporting all reports...'));
document.getElementById('scheduleReportBtn')?.addEventListener('click', () => alert('Schedule recurring report'));
document.getElementById('generateCustomReport')?.addEventListener('click', () => alert('Generating custom report...'));
document.getElementById('applyDateRange')?.addEventListener('click', () => alert('Date range applied, refreshing data...'));

initCharts();
populateTables();
</script>
@endsection