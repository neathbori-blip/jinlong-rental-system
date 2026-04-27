@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex justify-between items-start">
            <h1 class="text-2xl font-bold">Request #{{ $maintenance->request_number }}</h1>
            <a href="{{ route('maintenance.index') }}" class="text-purple-600">← Back</a>
        </div>
        <hr class="my-4">
        <div class="space-y-2">
            <p><strong>Property:</strong> {{ $maintenance->property->name }} - Unit {{ $maintenance->unit_number }}</p>
            <p><strong>Tenant:</strong> {{ $maintenance->tenant->name ?? 'Not specified' }}</p>
            <p><strong>Issue Type:</strong> {{ $maintenance->issue_type }}</p>
            <p><strong>Priority:</strong> {!! $maintenance->priority_badge !!}</p>
            <p><strong>Status:</strong> {!! $maintenance->status_badge !!}</p>
            <p><strong>Reported Date:</strong> {{ $maintenance->reported_date->format('M d, Y') }}</p>
            <p><strong>Completed Date:</strong> {{ $maintenance->completed_date ? $maintenance->completed_date->format('M d, Y') : '—' }}</p>
            <p><strong>Assigned To:</strong> {{ $maintenance->assigned_to ?? 'Unassigned' }}</p>
            <p><strong>Cost:</strong> ${{ number_format($maintenance->cost ?? 0, 2) }}</p>
            <p><strong>Description:</strong><br>{{ $maintenance->description }}</p>
        </div>
        <div class="mt-6 flex gap-2">
            <a href="{{ route('maintenance.edit', $maintenance) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
            <form action="{{ route('maintenance.destroy', $maintenance) }}" method="POST" onsubmit="return confirm('Delete request?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection