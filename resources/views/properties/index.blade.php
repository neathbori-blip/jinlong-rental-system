@extends('layouts.app')

@section('title', 'Properties')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <i class="fas fa-building text-primary-500"></i>
        Properties List
    </h2>
    <!-- <a href="{{ route('properties.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Add Property
    </a> -->
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">ID</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Name</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Location</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Price</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties ?? [] as $property)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-4 text-gray-600">#{{ $property->id }}</td>
                    <td class="py-3 px-4 font-medium text-gray-800">{{ $property->name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $property->location }}</td>
                    <td class="py-3 px-4 font-semibold text-gray-800">${{ number_format($property->price) }}</td>
                    <td class="py-3 px-4">
                        <span class="badge {{ $property->status == 'active' ? 'badge-active' : ($property->status == 'pending' ? 'badge-pending' : 'badge-inactive') }}">
                            {{ ucfirst($property->status ?? 'pending') }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex gap-2">
                            <a href="#" class="text-blue-500 hover:text-blue-600">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-600">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-500">
                        <i class="fas fa-building text-5xl mb-3 block"></i>
                        <p>No properties found</p>
                        <a href="{{ route('properties.create') }}" class="text-primary-500 hover:text-primary-600 mt-2 inline-block">
                            Add your first property
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $properties->links() }}
    </div>
</div>
@endsection