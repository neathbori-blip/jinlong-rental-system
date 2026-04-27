@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6">
    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">{{ $tenant->name }}</h1>
            <a href="{{ route('tenants.index') }}" class="text-purple-600">← Back</a>
        </div>
        <hr class="my-4">
        <p><strong>Email:</strong> {{ $tenant->email }}</p>
        <p><strong>Phone:</strong> {{ $tenant->phone }}</p>
        <p><strong>Property:</strong> {{ $tenant->property->name }} - Unit {{ $tenant->unit_number }}</p>
        <p><strong>Monthly Rent:</strong> {{ $tenant->formatted_rent }}</p>
        <p><strong>Lease End:</strong> {{ $tenant->lease_end->format('M d, Y') }}</p>
        <p><strong>Move‑in Date:</strong> {{ $tenant->move_in_date->format('M d, Y') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($tenant->status) }}</p>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('tenants.edit', $tenant) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
            <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection