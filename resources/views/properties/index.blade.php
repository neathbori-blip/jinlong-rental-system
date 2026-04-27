@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Properties</h1>
        <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Property</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Properties Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($properties as $property)
            <div class="bg-white rounded shadow p-4 border">
                <h2 class="text-xl font-semibold">{{ $property->name }}</h2>
                <p class="text-gray-600 text-sm">{{ $property->address }}</p>
                <hr class="my-2">
                <p><i class="fas fa-building"></i>   Units: {{ $property->total_units }}</p>
                <p><i class="fas fa-users"></i>   Occupied: {{ $property->occupied_units }}</p>
                <p><i class="fas fa-dollar-sign"></i>   Revenue: ${{ number_format($property->monthly_revenue, 2) }}</p>
                <div class="mt-3 flex gap-3">
                    <a href="{{ route('properties.show', $property->id) }}" class="text-blue-600">View</a>
                    <a href="{{ route('properties.edit', $property->id) }}" class="text-yellow-600">Edit</a>
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No properties yet. <a href="{{ route('properties.create') }}" class="text-blue-600">Create one</a>.</p>
        @endforelse
    </div>

    <!-- Simple Pagination (No styling errors) -->
    <div class="mt-6 flex justify-between items-center">
        @if ($properties->onFirstPage())
            <span class="text-gray-400">← Previous</span>
        @else
            <a href="{{ $properties->previousPageUrl() }}" class="text-blue-600 hover:underline">← Previous</a>
        @endif

        <span class="text-gray-500 text-sm">Page {{ $properties->currentPage() }} of {{ $properties->lastPage() }}</span>

        @if ($properties->hasMorePages())
            <a href="{{ $properties->nextPageUrl() }}" class="text-blue-600 hover:underline">Next →</a>
        @else
            <span class="text-gray-400">Next →</span>
        @endif
    </div>
</div>
@endsection