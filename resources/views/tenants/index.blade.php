@extends('layouts.app')

@section('title', 'Tenants Management')

@section('content')
<div class="max-w-[1400px] mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-users text-purple-600 mr-3"></i> Tenants Management
            </h1>
            <p class="text-slate-500 text-sm">Manage all tenants, leases, and payment history in one place</p>
        </div>
        <a href="{{ route('tenants.create') }}" class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 shadow-md hover:shadow-lg transition">
            <i class="fas fa-user-plus"></i> Add New Tenant
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Total Tenants</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalTenants ?? $tenants->total() }}</p>
                </div>
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-purple-600"></i>
                </div>
            </div>
            <span class="text-xs text-green-600 mt-2 inline-block"><i class="fas fa-arrow-up"></i> +5 this month</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Active Leases</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $activeLeases ?? $tenants->where('status','active')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-home text-green-600"></i>
                </div>
            </div>
            <span class="text-xs text-green-600 mt-2 inline-block"><i class="fas fa-chart-line"></i> 90% occupancy</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Pending Payments</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $pendingPayments ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-orange-600"></i>
                </div>
            </div>
            <span class="text-xs text-red-600 mt-2 inline-block"><i class="fas fa-exclamation-triangle"></i> $6,450 total</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Avg. Rent</p>
                    <p class="text-2xl font-bold text-slate-800">${{ number_format($avgRent ?? 0, 0) }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-blue-600"></i>
                </div>
            </div>
            <span class="text-xs text-green-600 mt-2 inline-block"><i class="fas fa-arrow-up"></i> +5.2% YoY</span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Tenant Cards Grid (Better for modern look) -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-slate-700"><i class="fas fa-id-card mr-2"></i> All Tenants</h2>
        <div class="text-sm text-slate-500">Showing {{ $tenants->firstItem() ?? 0 }} to {{ $tenants->lastItem() ?? 0 }} of {{ $tenants->total() }} tenants</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tenants as $tenant)
        <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl transition duration-300">
            <!-- Tenant Header -->
            <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-5 py-4 border-b">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($tenant->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">{{ $tenant->name }}</h3>
                            <p class="text-xs text-slate-500">ID: #{{ $tenant->id }}</p>
                        </div>
                    </div>
                    <div>
                        @if($tenant->status == 'active')
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full"><i class="fas fa-check-circle"></i> Active</span>
                        @elseif($tenant->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full"><i class="fas fa-clock"></i> Pending</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full"><i class="fas fa-ban"></i> Inactive</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tenant Details -->
            <div class="p-5 space-y-3">
                <div class="flex items-center text-sm">
                    <i class="fas fa-envelope text-slate-400 w-5"></i>
                    <span class="text-slate-600 ml-2">{{ $tenant->email }}</span>
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-phone text-slate-400 w-5"></i>
                    <span class="text-slate-600 ml-2">{{ $tenant->phone }}</span>
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-building text-slate-400 w-5"></i>
                    <span class="text-slate-600 ml-2">{{ $tenant->property->name }} <span class="text-slate-400">• Unit {{ $tenant->unit_number }}</span></span>
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-dollar-sign text-slate-400 w-5"></i>
                    <span class="text-slate-600 ml-2 font-semibold">{{ $tenant->formatted_rent }}</span>
                    <span class="text-slate-400 text-xs ml-1">/ month</span>
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-calendar-alt text-slate-400 w-5"></i>
                    <span class="text-slate-600 ml-2">Lease ends: {{ $tenant->lease_end->format('M d, Y') }}</span>
                    @if($tenant->lease_end->isPast())
                        <span class="ml-2 text-red-500 text-xs"><i class="fas fa-exclamation-circle"></i> Expired</span>
                    @elseif($tenant->lease_end->diffInDays(now()) <= 30)
                        <span class="ml-2 text-orange-500 text-xs"><i class="fas fa-hourglass-half"></i> Soon</span>
                    @endif
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-calendar-check text-slate-400 w-5"></i>
                    <span class="text-slate-600 ml-2">Move in: {{ $tenant->move_in_date->format('M d, Y') }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-5 py-3 bg-slate-50 border-t flex justify-between items-center">
                <div class="flex gap-2">
                    <a href="{{ route('tenants.show', $tenant) }}" class="text-blue-600 hover:text-blue-800 transition" title="View">
                        <i class="fas fa-eye"></i> Details
                    </a>
                    <a href="{{ route('tenants.edit', $tenant) }}" class="text-yellow-600 hover:text-yellow-800 transition" title="Edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
                <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" onsubmit="return confirm('Delete this tenant?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Delete">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 bg-white rounded-xl shadow">
            <i class="fas fa-user-slash text-5xl text-slate-300 mb-3"></i>
            <p class="text-slate-500">No tenants found.</p>
            <a href="{{ route('tenants.create') }}" class="text-purple-600 hover:underline mt-2 inline-block">Add your first tenant</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $tenants->links() }}
    </div>
</div>
@endsection