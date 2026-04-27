@extends('layouts.app')

@section('title', 'Lease Management')

@section('content')
<div class="max-w-[1400px] mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">
                <i class="fas fa-file-signature text-purple-600 mr-3"></i> Lease Management
            </h1>
            <p class="text-slate-500 text-sm">Manage all lease agreements, renewals, and expiry tracking</p>
        </div>
        <a href="{{ route('leases.create') }}" class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 shadow-md hover:shadow-lg transition">
            <i class="fas fa-plus-circle"></i> New Lease
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">Active Leases</p><div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center"><i class="fas fa-check-circle text-purple-600"></i></div></div>
            <p class="text-2xl font-bold">{{ $activeLeases }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">Expiring Soon</p><div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center"><i class="fas fa-hourglass-half text-yellow-600"></i></div></div>
            <p class="text-2xl font-bold">{{ $expiringSoon }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">Total Deposits</p><div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center"><i class="fas fa-piggy-bank text-green-600"></i></div></div>
            <p class="text-2xl font-bold">${{ number_format($totalDeposits, 2) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
            <div class="flex justify-between"><p class="text-slate-500">Monthly Rent (Active)</p><div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center"><i class="fas fa-dollar-sign text-blue-600"></i></div></div>
            <p class="text-2xl font-bold">${{ number_format($totalMonthlyRent, 2) }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-6 text-green-700 rounded shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- Leases Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($leases as $lease)
        <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl transition duration-300">
            <!-- Header with status -->
            <div class="px-5 py-4 bg-gradient-to-r from-purple-50 to-indigo-50 border-b">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-user text-purple-600"></i>
                            <span class="font-semibold text-slate-800">{{ $lease->tenant->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-500">
                            <i class="fas fa-building"></i>
                            <span>{{ $lease->property->name }} - Unit {{ $lease->unit_number }}</span>
                        </div>
                    </div>
                    <div>
                        @if($lease->status == 'active')
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full"><i class="fas fa-check-circle"></i> Active</span>
                        @elseif($lease->status == 'expired')
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full"><i class="fas fa-calendar-times"></i> Expired</span>
                        @else
                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full"><i class="fas fa-ban"></i> Terminated</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="p-5 space-y-3">
                <div class="flex items-center gap-2 text-sm"><i class="fas fa-calendar-alt w-5 text-slate-400"></i> <span class="text-slate-600">Start: {{ $lease->start_date->format('M d, Y') }}</span></div>
                <div class="flex items-center gap-2 text-sm"><i class="fas fa-calendar-check w-5 text-slate-400"></i> <span class="text-slate-600">End: {{ $lease->end_date->format('M d, Y') }}</span>
                    @if($lease->status == 'active' && $lease->is_expiring_soon)
                        <span class="ml-2 text-orange-500 text-xs bg-orange-50 px-2 py-0.5 rounded-full"><i class="fas fa-hourglass-half"></i> {{ $lease->days_left }} days left</span>
                    @endif
                </div>
                <div class="flex items-center gap-2 text-sm"><i class="fas fa-dollar-sign w-5 text-slate-400"></i> <span class="text-slate-600 font-semibold">{{ $lease->formatted_rent }}</span> <span class="text-slate-400 text-xs">/ month</span></div>
                <div class="flex items-center gap-2 text-sm"><i class="fas fa-money-bill-wave w-5 text-slate-400"></i> <span class="text-slate-600">Deposit: {{ $lease->formatted_deposit }}</span></div>
                @if($lease->notes)
                <div class="mt-2 text-xs text-slate-400 italic"><i class="fas fa-pen"></i> {{ Str::limit($lease->notes, 60) }}</div>
                @endif
            </div>

            <!-- Actions -->
            <div class="px-5 py-3 bg-slate-50 border-t flex justify-between">
                <div class="flex gap-3">
                    <a href="{{ route('leases.show', $lease) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i> Details</a>
                    <a href="{{ route('leases.edit', $lease) }}" class="text-yellow-600 hover:text-yellow-800"><i class="fas fa-edit"></i> Edit</a>
                </div>
                <form action="{{ route('leases.destroy', $lease) }}" method="POST" onsubmit="return confirm('Delete this lease?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 bg-white rounded-xl shadow">
            <i class="fas fa-file-contract text-5xl text-slate-300 mb-3"></i>
            <p class="text-slate-500">No lease agreements yet.</p>
            <a href="{{ route('leases.create') }}" class="text-purple-600 hover:underline mt-2 inline-block">Create your first lease</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">{{ $leases->links() }}</div>
</div>
@endsection