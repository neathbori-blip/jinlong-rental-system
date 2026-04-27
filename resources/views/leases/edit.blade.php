@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Lease</h1>
        <form action="{{ route('leases.update', $lease) }}" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label>Tenant</label><select name="tenant_id" class="w-full border rounded-xl px-4 py-2" required>@foreach($tenants as $t)<option value="{{ $t->id }}" {{ old('tenant_id', $lease->tenant_id)==$t->id ? 'selected' : '' }}>{{ $t->name }}</option>@endforeach</select></div>
                <div><label>Property</label><select name="property_id" class="w-full border rounded-xl px-4 py-2" required>@foreach($properties as $p)<option value="{{ $p->id }}" {{ old('property_id', $lease->property_id)==$p->id ? 'selected' : '' }}>{{ $p->name }}</option>@endforeach</select></div>
                <div><label>Unit Number</label><input type="text" name="unit_number" value="{{ old('unit_number', $lease->unit_number) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Start Date</label><input type="date" name="start_date" value="{{ old('start_date', $lease->start_date->format('Y-m-d')) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>End Date</label><input type="date" name="end_date" value="{{ old('end_date', $lease->end_date->format('Y-m-d')) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Monthly Rent ($)</label><input type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent', $lease->monthly_rent) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Deposit Amount ($)</label><input type="number" step="0.01" name="deposit_amount" value="{{ old('deposit_amount', $lease->deposit_amount) }}" class="w-full border rounded-xl px-4 py-2"></div>
                <div><label>Status</label><select name="status" class="w-full border rounded-xl px-4 py-2" required>
                    <option value="active" {{ old('status', $lease->status)=='active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ old('status', $lease->status)=='expired' ? 'selected' : '' }}>Expired</option>
                    <option value="terminated" {{ old('status', $lease->status)=='terminated' ? 'selected' : '' }}>Terminated</option>
                </select></div>
                <div class="md:col-span-2"><label>Notes</label><textarea name="notes" rows="2" class="w-full border rounded-xl px-4 py-2">{{ old('notes', $lease->notes) }}</textarea></div>
            </div>
            <div class="mt-6 flex gap-2"><button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-xl">Update</button><a href="{{ route('leases.index') }}" class="border px-6 py-2 rounded-xl">Cancel</a></div>
        </form>
    </div>
</div>
@endsection