{{-- resources/views/payments/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Payments Management')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-credit-card text-purple-600 mr-3"></i> Payments Management
            </h1>
            <p class="text-slate-500 text-sm">Track, manage, and analyze all rental payments in one place</p>
        </div>
        
        {{-- Using Button Component --}}
        <x-button variant="primary" size="lg" icon="plus-circle" id="addPaymentBtn">
            Record New Payment
        </x-button>
    </div>

    {{-- Stats Cards using Component --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Total Revenue" 
            value="$48,920" 
            icon="dollar-sign"
            iconColor="purple"
            trend="+12.5% from last month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Pending Payments" 
            value="$6,450" 
            icon="clock"
            iconColor="orange"
            trend="8 unpaid invoices"
            :trendUp="false"
        />

        <x-stat-card 
            title="Overdue" 
            value="$2,340" 
            icon="exclamation-triangle"
            iconColor="red"
            trend="3 tenants overdue"
            :trendUp="false"
        />

        <x-stat-card 
            title="Collection Rate" 
            value="87.5%" 
            icon="check-circle"
            iconColor="green"
            trend="42/48 units paying"
            :trendUp="true"
        />
    </div>

    {{-- Filter Component --}}
    <x-filter-card 
        title="Filter Payments"
        searchPlaceholder="Tenant, property, or transaction ID..."
        searchField="searchInput"
        :showStatus="true"
        :showMonth="true"
        :showMinAmount="true"
        :showProperty="false"
        :statusOptions="[
            'paid' => ' Paid',
            'pending' => ' Pending',
            'overdue' => ' Overdue'
        ]"
        :monthOptions="[
            '2025-01' => 'January 2025',
            '2025-02' => 'February 2025',
            '2025-03' => 'March 2025',
            '2025-04' => 'April 2025'
        ]"
    />

    <!-- Analytics Row -->
    <div class="grid grid-cols-1 lg:grid-cols-[1.4fr,0.8fr] gap-6 mb-8">
        <!-- Chart Container -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-line mr-2"></i> Monthly Revenue Trend</h3>
                <span class="bg-indigo-50 px-3 py-1 rounded-full text-xs font-semibold text-indigo-600">2025</span>
            </div>
            <canvas id="revenueChart" height="200"></canvas>
        </div>

        <!-- Summary Container -->
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-chart-pie mr-2"></i> Payment Summary</h3>
                <i class="fas fa-info-circle text-slate-400 cursor-help" title="Last 30 days overview"></i>
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-check-circle text-emerald-500 mr-2"></i> Completed</span>
                    <strong class="text-slate-800">34 payments</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-spinner text-amber-500 mr-2"></i> Pending</span>
                    <strong class="text-slate-800">8 payments</strong>
                </div>
                <div class="flex justify-between py-3 border-b border-slate-100">
                    <span><i class="fas fa-exclamation-circle text-red-500 mr-2"></i> Overdue</span>
                    <strong class="text-slate-800">3 payments</strong>
                </div>
                <div class="flex justify-between pt-4 mt-2 border-t-2 border-slate-200">
                    <span><i class="fas fa-chart-simple mr-2 text-slate-500"></i> Total Transactions</span>
                    <strong class="text-slate-800">45 payments</strong>
                </div>
                <div class="bg-amber-50 p-4 rounded-xl mt-2">
                    <span><i class="fas fa-bell mr-2 text-amber-600"></i> Next Rent Due</span>
                    <strong class="float-right text-amber-700">May 1, 2025</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="bg-white rounded-2xl overflow-hidden border border-slate-100">
        <div class="flex justify-between items-center p-5 border-b border-slate-100 flex-wrap gap-3">
            <h3 class="text-slate-800 font-bold"><i class="fas fa-receipt mr-2"></i> Recent Transactions</h3>
            <div class="flex gap-3">
                <x-button variant="secondary" size="sm" icon="download" id="exportBtn">
                    Export CSV
                </x-button>
                <x-button variant="secondary" size="sm" icon="print" id="printBtn">
                    Print
                </x-button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">ID</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Tenant</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Property</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Amount</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Due Date</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Paid Date</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Status</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Method</th>
                        <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Actions</th>
                    </tr>
                </thead>
                <tbody id="paymentsTableBody">
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
    /* Status Badges */
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
    // Payment Data
    const payments = [
        { id: "INV-1001", tenant: "Emily Clarke", property: "Sunset Apartments #4B", amount: 1850, dueDate: "2025-04-01", paidDate: "2025-03-28", status: "paid", method: "Bank Transfer" },
        { id: "INV-1002", tenant: "James Wilson", property: "Maple Grove #12", amount: 2200, dueDate: "2025-04-03", paidDate: "2025-04-01", status: "paid", method: "Credit Card" },
        { id: "INV-1003", tenant: "Sophia Martinez", property: "Harbor Loft #7", amount: 1750, dueDate: "2025-04-05", paidDate: "", status: "pending", method: "-" },
        { id: "INV-1004", tenant: "Liam Johnson", property: "Oakwood Residence #2", amount: 1950, dueDate: "2025-03-28", paidDate: "", status: "overdue", method: "-" },
        { id: "INV-1005", tenant: "Olivia Brown", property: "Pine Hill #9", amount: 2100, dueDate: "2025-04-02", paidDate: "2025-03-30", status: "paid", method: "Cash" },
        { id: "INV-1006", tenant: "Noah Davis", property: "Cedar Creek #15", amount: 1650, dueDate: "2025-04-10", paidDate: "", status: "pending", method: "-" },
        { id: "INV-1007", tenant: "Ava Garcia", property: "Downtown Suites #3", amount: 2400, dueDate: "2025-03-20", paidDate: "", status: "overdue", method: "-" },
        { id: "INV-1008", tenant: "Mason Rodriguez", property: "Lakeside Villas #8", amount: 1890, dueDate: "2025-04-08", paidDate: "2025-04-05", status: "paid", method: "Bank Transfer" },
        { id: "INV-1009", tenant: "Isabella Miller", property: "West End #22", amount: 1725, dueDate: "2025-03-25", paidDate: "", status: "overdue", method: "-" },
        { id: "INV-1010", tenant: "Ethan Martinez", property: "Hillcrest #5", amount: 1980, dueDate: "2025-04-12", paidDate: "", status: "pending", method: "-" },
        { id: "INV-1011", tenant: "Charlotte Wilson", property: "Riverfront #11", amount: 2300, dueDate: "2025-04-15", paidDate: "2025-04-10", status: "paid", method: "Credit Card" },
        { id: "INV-1012", tenant: "Benjamin Lee", property: "Golden Gate #6", amount: 1675, dueDate: "2025-04-18", paidDate: "", status: "pending", method: "-" }
    ];

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
            tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 40px;">No payments found</td><tr>';
        } else {
            tbody.innerHTML = pageData.map(payment => `
                <tr>
                    <td class="px-4 py-3.5"><strong>${payment.id}</strong></td>
                    <td class="px-4 py-3.5"><i class="fas fa-user-circle text-purple-600 mr-2"></i>${payment.tenant}</td>
                    <td class="px-4 py-3.5"><i class="fas fa-home text-slate-400 mr-2"></i> ${payment.property}</td>
                    <td class="px-4 py-3.5"><strong>${formatAmount(payment.amount)}</strong></td>
                    <td class="px-4 py-3.5">${formatDate(payment.dueDate)}</td>
                    <td class="px-4 py-3.5">${formatDate(payment.paidDate)}</td>
                    <td class="px-4 py-3.5">${getStatusBadge(payment.status)}</td>
                    <td class="px-4 py-3.5">${payment.method}</td>
                    <td class="px-4 py-3.5 action-buttons">
                        <i class="fas fa-eye" title="View Details" onclick="alert('View payment ${payment.id}')"></i>
                        <i class="fas fa-receipt" title="Receipt" onclick="alert('Download receipt for ${payment.id}')"></i>
                        <i class="fas fa-edit" title="Edit" onclick="alert('Edit payment ${payment.id}')"></i>
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
            search: document.getElementById('searchInput')?.value || '',
            status: document.getElementById('statusFilter')?.value || 'all',
            month: document.getElementById('monthFilter')?.value || 'all',
            minAmount: document.getElementById('minAmount')?.value || ''
        };
        currentPage = 1;
        renderTable();
    }
    
    function clearFilters() {
        if (document.getElementById('searchInput')) document.getElementById('searchInput').value = '';
        if (document.getElementById('statusFilter')) document.getElementById('statusFilter').value = 'all';
        if (document.getElementById('monthFilter')) document.getElementById('monthFilter').value = 'all';
        if (document.getElementById('minAmount')) document.getElementById('minAmount').value = '';
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
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const monthFilter = document.getElementById('monthFilter');
    const minAmount = document.getElementById('minAmount');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const exportBtn = document.getElementById('exportBtn');
    const printBtn = document.getElementById('printBtn');
    const addPaymentBtn = document.getElementById('addPaymentBtn');
    
    if (searchInput) searchInput.addEventListener('input', applyFilters);
    if (statusFilter) statusFilter.addEventListener('change', applyFilters);
    if (monthFilter) monthFilter.addEventListener('change', applyFilters);
    if (minAmount) minAmount.addEventListener('input', applyFilters);
    if (clearFiltersBtn) clearFiltersBtn.addEventListener('click', clearFilters);
    if (exportBtn) exportBtn.addEventListener('click', () => alert('CSV export feature ready for backend integration'));
    if (printBtn) printBtn.addEventListener('click', () => window.print());
    if (addPaymentBtn) addPaymentBtn.addEventListener('click', () => alert('Add payment form - ready for integration'));
    
    // Initialize
    initChart();
    renderTable();
</script>
@endsection