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
    @if(isset($recentProperties) && count($recentProperties) > 0)
    <table>
        <thead>
            <tr>
                <th>Property Name</th>
                <th>Location</th>
                <th>Price/Month</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentProperties as $property)
            <tr>
                <td>{{ $property->name }}</td>
                <td>{{ $property->location }}</td>
                <td>${{ number_format($property->price) }}</td>
                <td>
                    <span class="badge {{ isset($property->status) && $property->status == 'active' ? 'badge-active' : 'badge-pending' }}">
                        {{ $property->status ?? 'pending' }}
                    </span>
                </td>
                <td>
                    <a href="#" style="color: #34A853;">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="text-align: center; padding: 20px;">No properties found. Add your first property!</p>
    @endif
</div>

<!-- Quick Actions Section -->
<div style="margin-top: 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
    <a href="{{ route('properties.create') }}" class="btn-primary" style="text-align: center; justify-content: center;">
        <i class="fas fa-plus"></i> Add New Property
    </a>
    <a href="{{ route('tenants.create') }}" class="btn-outline-primary" style="text-align: center; justify-content: center; display: flex; align-items: center;">
        <i class="fas fa-user-plus"></i> Add New Tenant
    </a>
    <a href="{{ route('payments.create') }}" class="btn-outline-primary" style="text-align: center; justify-content: center; display: flex; align-items: center;">
        <i class="fas fa-receipt"></i> Record Payment
    </a>
</div>
@endsection