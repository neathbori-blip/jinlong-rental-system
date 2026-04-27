{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-2xl p-6 mb-8 text-white">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-bold mb-2">
                    <i class="fas fa-home mr-3"></i> Welcome back, Admin!
                </h1>
                <p class="text-purple-100 text-sm">Here's what's happening with your property portfolio today.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl text-sm font-semibold hover:bg-white/30 transition flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> Last 30 Days
                </button>
                <button class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl text-sm font-semibold hover:bg-white/30 transition flex items-center gap-2">
                    <i class="fas fa-download"></i> Generate Report
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Total Properties" 
            value="12" 
            icon="building"
            iconColor="purple"
            trend="+2 this year"
            :trendUp="true"
        />

        <x-stat-card 
            title="Total Tenants" 
            value="42" 
            icon="users"
            iconColor="blue"
            trend="+5 this month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Monthly Revenue" 
            value="$74,250" 
            icon="dollar-sign"
            iconColor="green"
            trend="+$5,200 vs last month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Occupancy Rate" 
            value="87.5%" 
            icon="percent"
            iconColor="orange"
            trend="+3.2% improvement"
            :trendUp="true"
        />
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line text-purple-600 mr-2"></i> Revenue Overview</h3>
                <select class="px-3 py-1.5 border border-slate-200 rounded-lg text-sm">
                    <option>Last 6 Months</option>
                    <option>Last 12 Months</option>
                    <option>Last 30 Days</option>
                </select>
            </div>
            <canvas id="revenueChart" height="250"></canvas>
        </div>

        <!-- Occupancy Chart -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-pie text-purple-600 mr-2"></i> Property Distribution</h3>
                <span class="text-xs text-slate-400">by unit count</span>
            </div>
            <canvas id="occupancyChart" height="250"></canvas>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-5 text-white">
            <i class="fas fa-user-plus text-3xl mb-3 opacity-80"></i>
            <h3 class="text-lg font-bold mb-1">Add New Tenant</h3>
            <p class="text-blue-100 text-sm mb-4">Register a new tenant to your property</p>
            <button class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl text-sm font-semibold hover:bg-white/30 transition w-full">
                + Add Tenant
            </button>
        </div>
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white">
            <i class="fas fa-file-signature text-3xl mb-3 opacity-80"></i>
            <h3 class="text-lg font-bold mb-1">Create New Lease</h3>
            <p class="text-emerald-100 text-sm mb-4">Set up a lease agreement</p>
            <button class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl text-sm font-semibold hover:bg-white/30 transition w-full">
                Create Lease
            </button>
        </div>
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl p-5 text-white">
            <i class="fas fa-tools text-3xl mb-3 opacity-80"></i>
            <h3 class="text-lg font-bold mb-1">Maintenance Request</h3>
            <p class="text-amber-100 text-sm mb-4">Report a maintenance issue</p>
            <button class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl text-sm font-semibold hover:bg-white/30 transition w-full">
                New Request
            </button>
        </div>
    </div>

    <!-- Recent Activity & Alerts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Payments -->
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
            <div class="flex justify-between items-center p-5 border-b border-slate-100">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-receipt text-purple-600 mr-2"></i> Recent Payments</h3>
                <a href="{{ route('payments.index') }}" class="text-purple-600 text-sm hover:underline">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Tenant</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Amount</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Date</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Status</th>
                        </tr>
                    </thead>
                    <tbody id="recentPayments">
                        <!-- Dynamic content -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Maintenance -->
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
            <div class="flex justify-between items-center p-5 border-b border-slate-100">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-tools text-purple-600 mr-2"></i> Pending Maintenance</h3>
                <a href="{{ route('maintenance.index') }}" class="text-purple-600 text-sm hover:underline">View All →</a>
            </div>
            <div class="divide-y divide-slate-100">
                <div class="p-4 hover:bg-slate-50 transition cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-slate-800">Water Leak - Unit #4B</p>
                            <p class="text-xs text-slate-500 mt-1">Sunset Apartments • Reported 2h ago</p>
                        </div>
                        <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full">Urgent</span>
                    </div>
                </div>
                <div class="p-4 hover:bg-slate-50 transition cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-slate-800">AC Not Working - Unit #7</p>
                            <p class="text-xs text-slate-500 mt-1">Harbor Loft • Reported 5h ago</p>
                        </div>
                        <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full">High</span>
                    </div>
                </div>
                <div class="p-4 hover:bg-slate-50 transition cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-slate-800">Electrical Outlet - Unit #12</p>
                            <p class="text-xs text-slate-500 mt-1">Maple Grove • Reported 1d ago</p>
                        </div>
                        <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">Medium</span>
                    </div>
                </div>
                <div class="p-4 hover:bg-slate-50 transition cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-slate-800">Dishwasher Broken - Unit #9</p>
                            <p class="text-xs text-slate-500 mt-1">Pine Hill • Reported 2d ago</p>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Low</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Expiring Leases Section -->
    <div class="mt-8 bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <div class="flex justify-between items-center p-5 border-b border-slate-100">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-calendar-alt text-purple-600 mr-2"></i> Expiring Leases (Next 30 Days)</h3>
            <a href="{{ route('leases.index') }}" class="text-purple-600 text-sm hover:underline">Manage Leases →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Tenant</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Property</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Unit</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Lease End</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Days Left</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-slate-600">Action</th>
                    </tr>
                </thead>
                <tbody id="expiringLeases">
                    <!-- Dynamic content -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom CSS for additional styles -->
<style>
    /* Table hover effects */
    tbody tr:hover {
        background-color: #faf9fe;
    }
    
    /* Smooth transitions */
    .transition {
        transition: all 0.2s ease;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
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
                y: { 
                    ticks: { callback: (val) => '$' + val.toLocaleString() },
                    grid: { color: '#f1f5f9' }
                },
                x: { grid: { display: false } }
            }
        }
    });

    // Occupancy Chart (Pie Chart)
    const occupancyCtx = document.getElementById('occupancyChart').getContext('2d');
    new Chart(occupancyCtx, {
        type: 'doughnut',
        data: {
            labels: ['Sunset Apartments (12 units)', 'Maple Grove (10 units)', 'Harbor Loft (8 units)', 'Oakwood (10 units)', 'Others (8 units)'],
            datasets: [{
                data: [12, 10, 8, 10, 8],
                backgroundColor: ['#667eea', '#764ba2', '#f59e0b', '#10b981', '#ef4444'],
                borderWidth: 0,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 11 } } }
            },
            cutout: '60%'
        }
    });

    // Recent Payments Data
    const recentPayments = [
        { tenant: "Emily Clarke", amount: 1850, date: "2025-04-01", status: "paid" },
        { tenant: "James Wilson", amount: 2200, date: "2025-04-03", status: "paid" },
        { tenant: "Sophia Martinez", amount: 1750, date: "2025-04-05", status: "pending" },
        { tenant: "Liam Johnson", amount: 1950, date: "2025-03-28", status: "overdue" }
    ];

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    }

    function getStatusBadge(status) {
        if (status === 'paid') return '<span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded-full">✅ Paid</span>';
        if (status === 'pending') return '<span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full">⏳ Pending</span>';
        return '<span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full">⚠️ Overdue</span>';
    }

    const tbody = document.getElementById('recentPayments');
    if (tbody) {
        tbody.innerHTML = recentPayments.map(p => `
            <tr class="border-b border-slate-100 hover:bg-slate-50">
                <td class="px-5 py-3 text-sm">${p.tenant}</td>
                <td class="px-5 py-3 text-sm font-semibold">$${p.amount.toLocaleString()}</td>
                <td class="px-5 py-3 text-sm">${formatDate(p.date)}</td>
                <td class="px-5 py-3">${getStatusBadge(p.status)}</td>
            </tr>
        `).join('');
    }

    // Expiring Leases Data
    const expiringLeases = [
        { tenant: "Emily Clarke", property: "Sunset Apartments", unit: "#4B", endDate: "2025-01-14", daysLeft: 12 },
        { tenant: "Olivia Brown", property: "Pine Hill", unit: "#9", endDate: "2025-02-19", daysLeft: 18 },
        { tenant: "Mason Rodriguez", property: "Lakeside Villas", unit: "#8", endDate: "2025-04-04", daysLeft: 25 }
    ];

    function getDaysLeftBadge(days) {
        if (days <= 7) return '<span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full"> Urgent</span>';
        if (days <= 14) return '<span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full"> Warning</span>';
        return '<span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full"> Expiring Soon</span>';
    }

    const leasesTbody = document.getElementById('expiringLeases');
    if (leasesTbody) {
        leasesTbody.innerHTML = expiringLeases.map(l => `
            <tr class="border-b border-slate-100 hover:bg-slate-50">
                <td class="px-5 py-3 text-sm font-medium">${l.tenant}</td>
                <td class="px-5 py-3 text-sm">${l.property}</td>
                <td class="px-5 py-3 text-sm">${l.unit}</td>
                <td class="px-5 py-3 text-sm">${formatDate(l.endDate)}</td>
                <td class="px-5 py-3 text-sm">${l.daysLeft} days</td>
                <td class="px-5 py-3">
                    <button class="bg-purple-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-purple-700 transition" onclick="renewLease('${l.tenant}')">
                        Renew Lease
                    </button>
                </td>
            </tr>
        `).join('');
    }

    function renewLease(tenant) {
        alert(`Renewing lease for ${tenant}`);
    }
</script>
@endsection