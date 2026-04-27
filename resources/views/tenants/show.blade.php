@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex justify-between items-start">
            <h1 class="text-2xl font-bold">{{ $tenant->name }}</h1>
            <a href="{{ route('tenants.index') }}" class="text-purple-600"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <div class="grid md:grid-cols-2 gap-4 mt-5">
            <div><i class="fas fa-envelope w-5"></i> {{ $tenant->email }}</div>
            <div><i class="fas fa-phone"></i> {{ $tenant->phone }}</div>
            <div><i class="fas fa-building"></i> {{ $tenant->property->name }} - Unit {{ $tenant->unit_number }}</div>
            <div><i class="fas fa-dollar-sign"></i> {{ $tenant->formatted_rent }}</div>
            <div><i class="fas fa-calendar-alt"></i> Lease ends: {{ $tenant->lease_end->format('M d, Y') }}</div>
            <div><i class="fas fa-calendar-check"></i> Move‑in: {{ $tenant->move_in_date->format('M d, Y') }}</div>
            <div><i class="fas fa-tag"></i> Status: {{ ucfirst($tenant->status) }}</div>
        </div>
        <div class="mt-6 flex gap-2">
            <a href="{{ route('tenants.edit', $tenant) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
            <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection