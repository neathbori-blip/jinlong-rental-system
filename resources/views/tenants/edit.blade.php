@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6">
    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Tenant</h1>
        <form action="{{ route('tenants.update', $tenant) }}" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label>Name *</label><input type="text" name="name" value="{{ old('name', $tenant->name) }}" class="w-full border rounded p-2" required></div>
                <div><label>Email *</label><input type="email" name="email" value="{{ old('email', $tenant->email) }}" class="w-full border rounded p-2" required></div>
                <div><label>Phone *</label><input type="text" name="phone" value="{{ old('phone', $tenant->phone) }}" class="w-full border rounded p-2" required></div>
                <div><label>Property *</label>
                    <select name="property_id" class="w-full border rounded p-2" required>
                        @foreach($properties as $p)
                            <option value="{{ $p->id }}" {{ old('property_id', $tenant->property_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div><label>Unit Number *</label><input type="text" name="unit_number" value="{{ old('unit_number', $tenant->unit_number) }}" class="w-full border rounded p-2" required></div>
                <div><label>Monthly Rent ($) *</label><input type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent', $tenant->monthly_rent) }}" class="w-full border rounded p-2" required></div>
                <div><label>Lease End Date *</label><input type="date" name="lease_end" value="{{ old('lease_end', $tenant->lease_end->format('Y-m-d')) }}" class="w-full border rounded p-2" required></div>
                <div><label>Move‑in Date *</label><input type="date" name="move_in_date" value="{{ old('move_in_date', $tenant->move_in_date->format('Y-m-d')) }}" class="w-full border rounded p-2" required></div>
                <div><label>Status *</label>
                    <select name="status" class="w-full border rounded p-2" required>
                        <option value="active" {{ old('status', $tenant->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ old('status', $tenant->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="inactive" {{ old('status', $tenant->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('tenants.index') }}" class="border px-4 py-2 rounded">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection