@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-4">Edit Property</h1>
    <form action="{{ route('properties.update', $property->id) }}" method="POST" class="bg-white rounded shadow p-5">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="block font-medium mb-1">Property Name</label>
            <input type="text" name="name" value="{{ old('name', $property->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-3">
            <label class="block font-medium mb-1">Address</label>
            <textarea name="address" rows="2" class="w-full border rounded px-3 py-2" required>{{ old('address', $property->address) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label>Total Units</label>
                <input type="number" name="total_units" value="{{ old('total_units', $property->total_units) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label>Occupied Units</label>
                <input type="number" name="occupied_units" value="{{ old('occupied_units', $property->occupied_units) }}" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>
        <div class="mb-4">
            <label>Monthly Revenue ($)</label>
            <input type="number" step="0.01" name="monthly_revenue" value="{{ old('monthly_revenue', $property->monthly_revenue) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Property</button>
            <a href="{{ route('properties.index') }}" class="bg-gray-300 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection