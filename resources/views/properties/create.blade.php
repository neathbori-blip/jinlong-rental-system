@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-2xl font-bold mb-4">Add New Property</h1>
    <form action="{{ route('properties.store') }}" method="POST" class="bg-white rounded shadow p-5">
        @csrf
        <div class="mb-3">
            <label class="block font-medium mb-1">Property Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label class="block font-medium mb-1">Address</label>
            <textarea name="address" rows="2" class="w-full border rounded px-3 py-2" required>{{ old('address') }}</textarea>
            @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label class="block font-medium mb-1">Total Units</label>
                <input type="number" name="total_units" value="{{ old('total_units') }}" class="w-full border rounded px-3 py-2" required>
                @error('total_units') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Occupied Units</label>
                <input type="number" name="occupied_units" value="{{ old('occupied_units') }}" class="w-full border rounded px-3 py-2" required>
                @error('occupied_units') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Monthly Revenue ($)</label>
            <input type="number" step="0.01" name="monthly_revenue" value="{{ old('monthly_revenue') }}" class="w-full border rounded px-3 py-2" required>
            @error('monthly_revenue') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Property</button>
            <a href="{{ route('properties.index') }}" class="bg-gray-300 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection