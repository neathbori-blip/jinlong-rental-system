@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex justify-between items-start mb-4">
            <h1 class="text-2xl font-bold">Lease Details</h1>
            <a href="{{ route('leases.index') }}" class="text-purple-600">← Back</a>
        </div>
        <div class="space-y-2">
            <p><strong>Tenant:</strong> {{ $lease->tenant->name }}</p>
            <p><strong>Property:</strong> {{ $lease->property->name }} - Unit {{ $lease->unit_number }}</p>
            <p><strong>Start Date:</strong> {{ $lease->start_date->format('M d, Y') }}</p>
            <p><strong>End Date:</strong> {{ $lease->end_date->format('M d, Y') }}</p>
            <p><strong>Monthly Rent:</strong> {{ $lease->formatted_rent }}</p>
            <p><strong>Deposit:</strong> {{ $lease->formatted_deposit }}</p>
            <p><strong>Status:</strong> {{ ucfirst($lease->status) }}</p>
            <p><strong>Notes:</strong> {{ $lease->notes ?? '—' }}</p>
        </div>
        <div class="mt-6 flex gap-2">
            <a href="{{ route('leases.edit', $lease) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
            <form action="{{ route('leases.destroy', $lease) }}" method="POST" onsubmit="return confirm('Delete this lease?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection