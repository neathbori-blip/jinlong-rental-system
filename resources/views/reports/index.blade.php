{{-- resources/views/reports/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-chart-line text-purple-600 mr-3"></i> Reports & Analytics
            </h1>
            <p class="text-slate-500 text-sm">Comprehensive insights and financial reports for your property portfolio</p>
        </div>
        <div class="flex gap-3">
            <x-button variant="primary" size="md" icon="download" id="exportAllBtn">
                Export All
            </x-button>
            <x-button variant="secondary" size="md" icon="calendar-alt" id="scheduleReportBtn">
                Schedule Report
            </x-button>
        </div>
    </div>

    <!-- Date Range Selector -->
    <div class="bg-white rounded-2xl p-5 mb-8 border border-slate-100">
        <div class="flex justify-between items-center mb-5 flex-wrap gap-4">
            <h3 class="text-slate-800 font-semibold"><i class="fas fa-calendar-alt mr-2"></i> Select Date Range</h3>
            <div class="flex gap-2 flex-wrap">
                <button class="quick-range px-3 py-1.5 bg-slate-100 rounded-lg text-sm cursor-pointer hover:bg-slate-200 transition" data-range="7">Last 7 Days</button>
                <button class="quick-range px-3 py-1.5 bg-slate-100 rounded-lg text-sm cursor-pointer hover:bg-slate-200 transition" data-range="30">Last 30 Days</button>
                <button class="quick-range px-3 py-1.5 bg-slate-100 rounded-lg text-sm cursor-pointer hover:bg-slate-200 transition" data-range="90">Last 90 Days</button>
                <button class="quick-range px-3 py-1.5 bg-slate-100 rounded-lg text-sm cursor-pointer hover:bg-slate-200 transition" data-range="365">This Year</button>
            </div>
        </div>
        <div class="flex gap-4 items-end flex-wrap">
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-semibold text-slate-600"><i class="fas fa-calendar-alt"></i> Start Date</label>
                <input type="date" id="startDate" class="px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-semibold text-slate-600"><i class="fas fa-calendar-alt"></i> End Date</label>
                <input type="date" id="endDate" class="px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
            </div>
            <x-button variant="primary" size="md" icon="sync-alt" id="applyDateRange">
                Apply
            </x-button>
        </div>
    </div>

    <!-- Key Metrics Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Total Revenue Metric -->
        <div class="bg-white rounded-2xl p-5 flex items-center gap-4 border border-slate-100">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center text-white text-xl">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="flex-1">
                <span class="text-slate-500 text-xs block mb-1">Total Revenue</span>
                <span class="text-2xl font-extrabold text-slate-800 block">$124,850</span>
                <span class="text-emerald-500 text-xs"><i class="fas fa-arrow-up"></i> +8.2%</span>
            </div>
        </div>

        <!-- Occupancy Rate Metric -->
        <div class="bg-white rounded-2xl p-5 flex items-center gap-4 border border-slate-100">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white text-xl">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="flex-1">
                <span class="text-slate-500 text-xs block mb-1">Occupancy Rate</span>
                <span class="text-2xl font-extrabold text-slate-800 block">87.5%</span>
                <span class="text-emerald-500 text-xs"><i class="fas fa-arrow-up"></i> +3.1%</span>
            </div>
        </div>

        <!-- Collection Rate Metric -->
        <div class="bg-white rounded-2xl p-5 flex items-center gap-4 border border-slate-100">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white text-xl">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="flex-1">
                <span class="text-slate-500 text-xs block mb-1">Collection Rate</span>
                <span class="text-2xl font-extrabold text-slate-800 block">94.2%</span>
                <span class="text-emerald-500 text-xs"><i class="fas fa-arrow-up"></i> +5.4%</span>
            </div>
        </div>

        <!-- Maintenance Cost Metric -->
        <div class="bg-white rounded-2xl p-5 flex items-center gap-4 border border-slate-100">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-white text-xl">
                <i class="fas fa-tools"></i>
            </div>
            <div class="flex-1">
                <span class="text-slate-500 text-xs block mb-1">Maintenance Cost</span>
                <span class="text-2xl font-extrabold text-slate-800 block">$8,450</span>
                <span class="text-red-500 text-xs"><i class="fas fa-arrow-down"></i> -12.3%</span>
            </div>
        </div>
    </div>

    <!-- Report Tabs -->
    <div class="flex gap-2 mb-8 border-b border-slate-200 flex-wrap">
        <button class="tab-btn px-5 py-3 font-semibold text-slate-500 hover:text-purple-600 transition border-b-2 border-transparent active" data-tab="financial">
            <i class="fas fa-chart-pie mr-2"></i> Financial Reports
        </button>
        <button class="tab-btn px-5 py-3 font-semibold text-slate-500 hover:text-purple-600 transition border-b-2 border-transparent" data-tab="occupancy">
            <i class="fas fa-building mr-2"></i> Occupancy Reports
        </button>
        <button class="tab-btn px-5 py-3 font-semibold text-slate-500 hover:text-purple-600 transition border-b-2 border-transparent" data-tab="maintenance">
            <i class="fas fa-tools mr-2"></i> Maintenance Reports
        </button>
        <button class="tab-btn px-5 py-3 font-semibold text-slate-500 hover:text-purple-600 transition border-b-2 border-transparent" data-tab="tenants">
            <i class="fas fa-users mr-2"></i> Tenant Reports
        </button>
        <button class="tab-btn px-5 py-3 font-semibold text-slate-500 hover:text-purple-600 transition border-b-2 border-transparent" data-tab="custom">
            <i class="fas fa-chart-simple mr-2"></i> Custom Reports
        </button>
    </div>

    <!-- Financial Reports Content -->
    <div id="financial-tab" class="tab-content active">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line mr-2"></i> Revenue Trend</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('revenue')"></x-button>
                </div>
                <canvas id="revenueTrendChart" height="250"></canvas>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-pie mr-2"></i> Revenue by Property</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('propertyRevenue')"></x-button>
                </div>
                <canvas id="propertyRevenueChart" height="250"></canvas>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100 lg:col-span-2">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-table mr-2"></i> Monthly Breakdown</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('monthly')"></x-button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Month</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Revenue</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Expenses</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Net Profit</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Growth</th>
                            </tr>
                        </thead>
                        <tbody id="monthlyBreakdown"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Occupancy Reports Content -->
    <div id="occupancy-tab" class="tab-content hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line mr-2"></i> Occupancy Trend</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('occupancyTrend')"></x-button>
                </div>
                <canvas id="occupancyChart" height="250"></canvas>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-bar mr-2"></i> Property Performance</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('propertyPerformance')"></x-button>
                </div>
                <canvas id="propertyPerformanceChart" height="250"></canvas>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100 lg:col-span-2">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-building mr-2"></i> Property Occupancy Details</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Property</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Total Units</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Occupied</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Vacant</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Occupancy Rate</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Status</th>
                            </tr>
                        </thead>
                        <tbody id="propertyOccupancy"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance Reports Content -->
    <div id="maintenance-tab" class="tab-content hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line mr-2"></i> Maintenance Trends</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('maintenanceTrend')"></x-button>
                </div>
                <canvas id="maintenanceTrendChart" height="250"></canvas>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-pie mr-2"></i> Issues by Category</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('issuesCategory')"></x-button>
                </div>
                <canvas id="issuesCategoryChart" height="250"></canvas>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-100 lg:col-span-2">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-clock mr-2"></i> Response Time Analysis</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Priority</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Avg Response Time</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Avg Resolution Time</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Total Requests</th>
                            </tr>
                        </thead>
                        <tbody id="responseTimeAnalysis"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tenant Reports Content -->
    <div id="tenants-tab" class="tab-content hidden">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl p-5 border border-slate-100">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-slate-800 font-bold"><i class="fas fa-users mr-2"></i> Tenant Payment History</h3>
                    <x-button variant="ghost" size="sm" icon="download" onclick="downloadReport('tenantPayments')"></x-button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Tenant</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Property</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Monthly Rent</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Payment Status</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Last Payment</th>
                                <th class="px-4 py-3 text-left text-slate-600 font-semibold text-xs">Outstanding</th>
                            </tr>
                        </thead>
                        <tbody id="tenantPayments"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Reports Content -->
    <div id="custom-tab" class="tab-content hidden">
        <div class="bg-white rounded-2xl p-8 border border-slate-100">
            <h3 class="text-xl font-bold text-slate-800 mb-6"><i class="fas fa-chart-simple mr-2"></i> Custom Report Builder</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-semibold text-slate-600">Select Report Type</label>
                    <select id="reportType" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                        <option>Financial Summary</option>
                        <option>Occupancy Analysis</option>
                        <option>Maintenance Overview</option>
                        <option>Tenant Ledger</option>
                        <option>Property Comparison</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-semibold text-slate-600">Select Properties</label>
                    <select id="reportProperties" multiple class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm h-24">
                        <option>All Properties</option>
                        <option>Sunset Apartments</option>
                        <option>Maple Grove</option>
                        <option>Harbor Loft</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-semibold text-slate-600">Include Charts</label>
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-2 text-sm"><input type="checkbox" checked class="w-4 h-4"> Revenue Chart</label>
                        <label class="flex items-center gap-2 text-sm"><input type="checkbox" checked class="w-4 h-4"> Occupancy Chart</label>
                        <label class="flex items-center gap-2 text-sm"><input type="checkbox" class="w-4 h-4"> Maintenance Chart</label>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-semibold text-slate-600">Format</label>
                    <select id="reportFormat" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                        <option>PDF</option>
                        <option>Excel</option>
                        <option>CSV</option>
                    </select>
                </div>
            </div>
            <x-button variant="primary" size="lg" icon="chart-line" fullWidth id="generateCustomReport">
                Generate Report
            </x-button>
        </div>
    </div>
</div>

<!-- Custom CSS for tab styling -->
<style>
    .tab-btn.active {
        color: #667eea !important;
        border-bottom-color: #667eea !important;
    }
    
    .report-table th, .report-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .report-table th {
        background: #f8fafc;
        font-weight: 600;
    }
    
    .badge-success {
        background: #d1fae5;
        color: #065f46;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    
    .badge-warning {
        background: #fed7aa;
        color: #92400e;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    
    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
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
function populateTables() {
    // Monthly Breakdown
    const monthlyData = [
        { month: 'January', revenue: 12450, expenses: 3200, profit: 9250, growth: '+2.1%' },
        { month: 'February', revenue: 14100, expenses: 3450, profit: 10650, growth: '+15.1%' },
        { month: 'March', revenue: 13800, expenses: 3300, profit: 10500, growth: '-1.4%' },
        { month: 'April', revenue: 15280, expenses: 3600, profit: 11680, growth: '+11.2%' },
        { month: 'May', revenue: 14900, expenses: 3550, profit: 11350, growth: '-2.8%' },
        { month: 'June', revenue: 16350, expenses: 3800, profit: 12550, growth: '+10.6%' }
    ];
    
    const monthlyTbody = document.getElementById('monthlyBreakdown');
    if (monthlyTbody) {
        monthlyTbody.innerHTML = monthlyData.map(m => `
            <tr class="border-b border-slate-100">
                <td class="px-4 py-3 text-sm">${m.month}</td>
                <td class="px-4 py-3 text-sm">$${m.revenue.toLocaleString()}</td>
                <td class="px-4 py-3 text-sm">$${m.expenses.toLocaleString()}</td>
                <td class="px-4 py-3 text-sm font-semibold">$${m.profit.toLocaleString()}</td>
                <td class="px-4 py-3 text-sm ${m.growth.includes('-') ? 'text-red-500' : 'text-emerald-500'}">${m.growth}</td>
            </tr>
        `).join('');
    }
    
    // Property Occupancy
    const propertyOccupancy = document.getElementById('propertyOccupancy');
    if (propertyOccupancy) {
        propertyOccupancy.innerHTML = `
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Sunset Apartments</td><td class="px-4 py-3 text-sm">12</td><td class="px-4 py-3 text-sm">11</td><td class="px-4 py-3 text-sm">1</td><td class="px-4 py-3 text-sm">91.7%</td><td class="px-4 py-3 text-sm"><span class="badge-success">Excellent</span></td></tr>
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Maple Grove</td><td class="px-4 py-3 text-sm">10</td><td class="px-4 py-3 text-sm">9</td><td class="px-4 py-3 text-sm">1</td><td class="px-4 py-3 text-sm">90%</td><td class="px-4 py-3 text-sm"><span class="badge-success">Excellent</span></td></tr>
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Harbor Loft</td><td class="px-4 py-3 text-sm">8</td><td class="px-4 py-3 text-sm">7</td><td class="px-4 py-3 text-sm">1</td><td class="px-4 py-3 text-sm">87.5%</td><td class="px-4 py-3 text-sm"><span class="badge-warning">Good</span></td></tr>
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Oakwood Residence</td><td class="px-4 py-3 text-sm">10</td><td class="px-4 py-3 text-sm">8</td><td class="px-4 py-3 text-sm">2</td><td class="px-4 py-3 text-sm">80%</td><td class="px-4 py-3 text-sm"><span class="badge-warning">Average</span></td></tr>
            <tr><td class="px-4 py-3 text-sm">Pine Hill</td><td class="px-4 py-3 text-sm">8</td><td class="px-4 py-3 text-sm">7</td><td class="px-4 py-3 text-sm">1</td><td class="px-4 py-3 text-sm">87.5%</td><td class="px-4 py-3 text-sm"><span class="badge-warning">Good</span></td></tr>
        `;
    }
    
    // Response Time Analysis
    const responseTime = document.getElementById('responseTimeAnalysis');
    if (responseTime) {
        responseTime.innerHTML = `
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Urgent</td><td class="px-4 py-3 text-sm">1.2 hours</td><td class="px-4 py-3 text-sm">4.5 hours</td><td class="px-4 py-3 text-sm">15</td></tr>
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">High</td><td class="px-4 py-3 text-sm">3.5 hours</td><td class="px-4 py-3 text-sm">12 hours</td><td class="px-4 py-3 text-sm">22</td></tr>
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Medium</td><td class="px-4 py-3 text-sm">8 hours</td><td class="px-4 py-3 text-sm">24 hours</td><td class="px-4 py-3 text-sm">28</td></tr>
            <tr><td class="px-4 py-3 text-sm">Low</td><td class="px-4 py-3 text-sm">24 hours</td><td class="px-4 py-3 text-sm">48 hours</td><td class="px-4 py-3 text-sm">18</td></tr>
        `;
    }
    
    // Tenant Payments
    const tenantPayments = document.getElementById('tenantPayments');
    if (tenantPayments) {
        tenantPayments.innerHTML = `
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Emily Clarke</td><td class="px-4 py-3 text-sm">Sunset #4B</td><td class="px-4 py-3 text-sm">$1,850</td><td class="px-4 py-3 text-sm"><span class="badge-success">Paid</span></td><td class="px-4 py-3 text-sm">Apr 1, 2025</td><td class="px-4 py-3 text-sm">$0</td></tr>
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">James Wilson</td><td class="px-4 py-3 text-sm">Maple #12</td><td class="px-4 py-3 text-sm">$2,200</td><td class="px-4 py-3 text-sm"><span class="badge-success">Paid</span></td><td class="px-4 py-3 text-sm">Apr 3, 2025</td><td class="px-4 py-3 text-sm">$0</td></tr>
            <tr class="border-b border-slate-100"><td class="px-4 py-3 text-sm">Sophia Martinez</td><td class="px-4 py-3 text-sm">Harbor #7</td><td class="px-4 py-3 text-sm">$1,750</td><td class="px-4 py-3 text-sm"><span class="badge-warning">Pending</span></td><td class="px-4 py-3 text-sm">Mar 28, 2025</td><td class="px-4 py-3 text-sm">$1,750</td></tr>
            <tr><td class="px-4 py-3 text-sm">Liam Johnson</td><td class="px-4 py-3 text-sm">Oakwood #2</td><td class="px-4 py-3 text-sm">$1,950</td><td class="px-4 py-3 text-sm"><span class="badge-danger">Overdue</span></td><td class="px-4 py-3 text-sm">Mar 15, 2025</td><td class="px-4 py-3 text-sm">$3,900</td></tr>
        `;
    }
}

// Tab switching
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
        btn.classList.add('active');
        document.getElementById(`${btn.dataset.tab}-tab`).classList.remove('hidden');
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

// Event Listeners
document.getElementById('exportAllBtn')?.addEventListener('click', () => alert('Exporting all reports...'));
document.getElementById('scheduleReportBtn')?.addEventListener('click', () => alert('Schedule recurring report'));
document.getElementById('generateCustomReport')?.addEventListener('click', () => alert('Generating custom report...'));
document.getElementById('applyDateRange')?.addEventListener('click', () => alert('Date range applied, refreshing data...'));

// Initialize
initCharts();
populateTables();
</script>
@endsection