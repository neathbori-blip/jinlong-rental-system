{{-- resources/views/properties/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Properties Management')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-building text-purple-600 mr-3"></i> Properties Management
            </h1>
            <p class="text-slate-500 text-sm">Manage your entire property portfolio, units, and occupancy</p>
        </div>
        <button class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-xl font-semibold cursor-pointer transition-all duration-300 flex items-center gap-2 hover:shadow-lg hover:-translate-y-0.5" id="addPropertyBtn">
            <i class="fas fa-plus-circle"></i> Add New Property
        </button>
    </div>

  
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
            title="Total Units" 
            value="48" 
            icon="door-open"
            iconColor="blue"
            trend="42 occupied"
            :trendUp="true"
            subtext="87.5% occupancy"
        />

        <x-stat-card 
            title="Occupancy Rate" 
            value="87.5%" 
            icon="percent"
            iconColor="green"
            trend="+3.2% vs last month"
            :trendUp="true"
        />

        <x-stat-card 
            title="Monthly Revenue" 
            value="$74,250" 
            icon="dollar-sign"
            iconColor="orange"
            trend="+$5,200 from last month"
            :trendUp="true"
        />
    </div>

    <!-- View Toggle -->
    <div class="flex justify-end gap-2 mb-5">
        <button class="view-btn px-4 py-2 bg-white border border-slate-200 rounded-xl cursor-pointer transition-all duration-200 flex items-center gap-2 active" data-view="grid">
            <i class="fas fa-th-large"></i> Grid View
        </button>
        <button class="view-btn px-4 py-2 bg-white border border-slate-200 rounded-xl cursor-pointer transition-all duration-200 flex items-center gap-2" data-view="list">
            <i class="fas fa-list"></i> List View
        </button>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
        <!-- Property Card 1 -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 py-10 text-center relative">
                <i class="fas fa-building text-5xl text-white"></i>
                <span class="absolute top-2 right-2 bg-white/90 px-3 py-1 rounded-full text-xs font-semibold text-purple-600">12 Units</span>
            </div>
            <div class="p-5">
                <h3 class="text-xl font-bold text-slate-800 mb-2">Sunset Apartments</h3>
                <p class="text-slate-500 text-sm mb-4"><i class="fas fa-map-marker-alt mr-1"></i> 123 Sunset Blvd, Los Angeles, CA 90001</p>
                <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-slate-200">
                    <div><span class="text-xs text-slate-500">Occupied</span><strong class="block text-base text-slate-800">11/12</strong></div>
                    <div><span class="text-xs text-slate-500">Revenue</span><strong class="block text-base text-slate-800">$20,350</strong></div>
                    <div><span class="text-xs text-slate-500">Avg Rent</span><strong class="block text-base text-slate-800">$1,850</strong></div>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full mb-5 overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 91.7%"></div></div>
                <div class="flex gap-3">
                    <button onclick="viewProperty('Sunset Apartments')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-eye mr-1"></i> Details</button>
                    <button onclick="manageUnits('Sunset Apartments')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-door-open mr-1"></i> Units</button>
                </div>
            </div>
        </div>

        <!-- Property Card 2 -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 py-10 text-center relative">
                <i class="fas fa-building text-5xl text-white"></i>
                <span class="absolute top-2 right-2 bg-white/90 px-3 py-1 rounded-full text-xs font-semibold text-purple-600">10 Units</span>
            </div>
            <div class="p-5">
                <h3 class="text-xl font-bold text-slate-800 mb-2">Maple Grove</h3>
                <p class="text-slate-500 text-sm mb-4"><i class="fas fa-map-marker-alt mr-1"></i> 456 Maple Ave, Chicago, IL 60601</p>
                <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-slate-200">
                    <div><span class="text-xs text-slate-500">Occupied</span><strong class="block text-base text-slate-800">9/10</strong></div>
                    <div><span class="text-xs text-slate-500">Revenue</span><strong class="block text-base text-slate-800">$19,800</strong></div>
                    <div><span class="text-xs text-slate-500">Avg Rent</span><strong class="block text-base text-slate-800">$2,200</strong></div>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full mb-5 overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 90%"></div></div>
                <div class="flex gap-3">
                    <button onclick="viewProperty('Maple Grove')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-eye mr-1"></i> Details</button>
                    <button onclick="manageUnits('Maple Grove')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-door-open mr-1"></i> Units</button>
                </div>
            </div>
        </div>

        <!-- Property Card 3 -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 py-10 text-center relative">
                <i class="fas fa-building text-5xl text-white"></i>
                <span class="absolute top-2 right-2 bg-white/90 px-3 py-1 rounded-full text-xs font-semibold text-purple-600">8 Units</span>
            </div>
            <div class="p-5">
                <h3 class="text-xl font-bold text-slate-800 mb-2">Harbor Loft</h3>
                <p class="text-slate-500 text-sm mb-4"><i class="fas fa-map-marker-alt mr-1"></i> 789 Harbor Dr, Miami, FL 33101</p>
                <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-slate-200">
                    <div><span class="text-xs text-slate-500">Occupied</span><strong class="block text-base text-slate-800">7/8</strong></div>
                    <div><span class="text-xs text-slate-500">Revenue</span><strong class="block text-base text-slate-800">$12,250</strong></div>
                    <div><span class="text-xs text-slate-500">Avg Rent</span><strong class="block text-base text-slate-800">$1,750</strong></div>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full mb-5 overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 87.5%"></div></div>
                <div class="flex gap-3">
                    <button onclick="viewProperty('Harbor Loft')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-eye mr-1"></i> Details</button>
                    <button onclick="manageUnits('Harbor Loft')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-door-open mr-1"></i> Units</button>
                </div>
            </div>
        </div>

        <!-- Property Card 4 -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 py-10 text-center relative">
                <i class="fas fa-building text-5xl text-white"></i>
                <span class="absolute top-2 right-2 bg-white/90 px-3 py-1 rounded-full text-xs font-semibold text-purple-600">10 Units</span>
            </div>
            <div class="p-5">
                <h3 class="text-xl font-bold text-slate-800 mb-2">Oakwood Residence</h3>
                <p class="text-slate-500 text-sm mb-4"><i class="fas fa-map-marker-alt mr-1"></i> 321 Oak St, Austin, TX 78701</p>
                <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-slate-200">
                    <div><span class="text-xs text-slate-500">Occupied</span><strong class="block text-base text-slate-800">8/10</strong></div>
                    <div><span class="text-xs text-slate-500">Revenue</span><strong class="block text-base text-slate-800">$15,600</strong></div>
                    <div><span class="text-xs text-slate-500">Avg Rent</span><strong class="block text-base text-slate-800">$1,950</strong></div>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full mb-5 overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 80%"></div></div>
                <div class="flex gap-3">
                    <button onclick="viewProperty('Oakwood Residence')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-eye mr-1"></i> Details</button>
                    <button onclick="manageUnits('Oakwood Residence')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-door-open mr-1"></i> Units</button>
                </div>
            </div>
        </div>

        <!-- Property Card 5 -->
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 py-10 text-center relative">
                <i class="fas fa-building text-5xl text-white"></i>
                <span class="absolute top-2 right-2 bg-white/90 px-3 py-1 rounded-full text-xs font-semibold text-purple-600">8 Units</span>
            </div>
            <div class="p-5">
                <h3 class="text-xl font-bold text-slate-800 mb-2">Pine Hill</h3>
                <p class="text-slate-500 text-sm mb-4"><i class="fas fa-map-marker-alt mr-1"></i> 654 Pine St, Denver, CO 80201</p>
                <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-slate-200">
                    <div><span class="text-xs text-slate-500">Occupied</span><strong class="block text-base text-slate-800">7/8</strong></div>
                    <div><span class="text-xs text-slate-500">Revenue</span><strong class="block text-base text-slate-800">$14,700</strong></div>
                    <div><span class="text-xs text-slate-500">Avg Rent</span><strong class="block text-base text-slate-800">$2,100</strong></div>
                </div>
                <div class="h-1.5 bg-slate-200 rounded-full mb-5 overflow-hidden"><div class="h-full bg-gradient-to-r from-purple-600 to-purple-800 rounded-full" style="width: 87.5%"></div></div>
                <div class="flex gap-3">
                    <button onclick="viewProperty('Pine Hill')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-eye mr-1"></i> Details</button>
                    <button onclick="manageUnits('Pine Hill')" class="flex-1 py-2 border border-slate-200 rounded-lg cursor-pointer transition hover:bg-purple-600 hover:text-white hover:border-purple-600"><i class="fas fa-door-open mr-1"></i> Units</button>
                </div>
            </div>
        </div>
    </div>

    <!-- List View (Hidden by default) -->
    <div id="listView" class="hidden mt-5">
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100">
            <div class="flex justify-between items-center p-5 border-b border-slate-100 flex-wrap gap-3">
                <h3 class="text-slate-800 font-bold"><i class="fas fa-list mr-2"></i> Properties List</h3>
                <div class="table-actions">
                    <input type="text" id="propertySearch" placeholder="Search properties..." class="px-4 py-2 border border-slate-200 rounded-xl w-64">
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Property Name</th>
                            <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Address</th>
                            <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Units</th>
                            <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Occupied</th>
                            <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Occupancy</th>
                            <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Monthly Revenue</th>
                            <th class="px-4 py-3.5 text-left text-slate-600 font-semibold text-xs">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="propertyListBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for view toggle active state -->
<style>
    .view-btn.active {
        background: #667eea !important;
        color: white !important;
        border-color: #667eea !important;
    }
    
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
    
    th, td {
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    
    tr:hover td {
        background-color: #faf9fe;
    }
</style>

<script>
    const propertiesList = [
        { name: "Sunset Apartments", address: "123 Sunset Blvd, Los Angeles, CA 90001", units: 12, occupied: 11, revenue: 20350 },
        { name: "Maple Grove", address: "456 Maple Ave, Chicago, IL 60601", units: 10, occupied: 9, revenue: 19800 },
        { name: "Harbor Loft", address: "789 Harbor Dr, Miami, FL 33101", units: 8, occupied: 7, revenue: 12250 },
        { name: "Oakwood Residence", address: "321 Oak St, Austin, TX 78701", units: 10, occupied: 8, revenue: 15600 },
        { name: "Pine Hill", address: "654 Pine St, Denver, CO 80201", units: 8, occupied: 7, revenue: 14700 }
    ];

    function renderPropertyList() {
        const searchTerm = document.getElementById('propertySearch')?.value.toLowerCase() || '';
        const filtered = propertiesList.filter(p => p.name.toLowerCase().includes(searchTerm));
        const tbody = document.getElementById('propertyListBody');
        tbody.innerHTML = filtered.map(p => `
            <tr>
                <td class="px-4 py-3.5"><strong>${p.name}</strong></td>
                <td class="px-4 py-3.5">${p.address}</td>
                <td class="px-4 py-3.5">${p.units}</td>
                <td class="px-4 py-3.5">${p.occupied}</td>
                <td class="px-4 py-3.5">${Math.round((p.occupied/p.units)*100)}%</td>
                <td class="px-4 py-3.5">$${p.revenue.toLocaleString()}</td>
                <td class="px-4 py-3.5 action-buttons">
                    <i class="fas fa-eye" onclick="viewProperty('${p.name}')"></i>
                    <i class="fas fa-door-open" onclick="manageUnits('${p.name}')"></i>
                    <i class="fas fa-edit" onclick="editProperty('${p.name}')"></i>
                </td>
            </tr>
        `).join('');
    }

    document.getElementById('propertySearch')?.addEventListener('input', renderPropertyList);

    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const view = btn.dataset.view;
            document.getElementById('gridView').style.display = view === 'grid' ? 'grid' : 'none';
            document.getElementById('listView').style.display = view === 'list' ? 'block' : 'none';
            if (view === 'list') renderPropertyList();
            if (view === 'grid') document.getElementById('gridView').style.display = 'grid';
        });
    });

    function viewProperty(name) { alert(`Viewing details for ${name}`); }
    function manageUnits(name) { alert(`Managing units for ${name}`); }
    function editProperty(name) { alert(`Editing ${name}`); }

    document.getElementById('addPropertyBtn')?.addEventListener('click', () => alert('Add new property form'));

    renderPropertyList();
</script>
@endsection