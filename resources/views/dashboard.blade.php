@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h4>Total Properties</h4>
            <div class="stat-number">{{ $totalProperties ?? 0 }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-building"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Active Tenants</h4>
            <div class="stat-number">{{ $activeTenants ?? 0 }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Monthly Revenue</h4>
            <div class="stat-number">${{ number_format($monthlyRevenue ?? 0) }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Pending Payments</h4>
            <div class="stat-number">{{ $pendingPayments ?? 0 }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
    </div>
</div>

<div class="recent-section">
    <h3 class="section-title">Recent Properties</h3>
    <table>
        <thead>
            <tr>
                <th>Property Name</th>
                <th>Location</th>
                <th>Price/Month</th>
                <th>Status</th>
                <th>Tenant</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentProperties ?? [] as $property)
            <tr>
                <td>{{ $property->name }}</td>
                <td>{{ $property->location }}</td>
                <td>${{ number_format($property->price) }}</td>
                <td><span class="badge badge-{{ $property->status == 'active' ? 'active' : 'pending' }}">{{ ucfirst($property->status) }}</span></td>
                <td>{{ $property->tenant_name ?? 'Vacant' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No properties found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection