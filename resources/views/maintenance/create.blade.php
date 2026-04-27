@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <h1 class="text-2xl font-bold mb-6"><i class="fas fa-tools mr-2 text-purple-600"></i> New Maintenance Request</h1>
        <form action="{{ route('maintenance.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label>Property *</label><select name="property_id" class="w-full border rounded-xl px-4 py-2" required>@foreach($properties as $p)<option value="{{ $p->id }}">{{ $p->name }}</option>@endforeach</select></div>
                <div><label>Tenant (optional)</label><select name="tenant_id" class="w-full border rounded-xl px-4 py-2"><option value="">Select tenant</option>@foreach($tenants as $t)<option value="{{ $t->id }}">{{ $t->name }}</option>@endforeach</select></div>
                <div><label>Unit Number *</label><input type="text" name="unit_number" value="{{ old('unit_number') }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Issue Type *</label><input type="text" name="issue_type" placeholder="Plumbing, Electrical, etc." value="{{ old('issue_type') }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Priority *</label><select name="priority" class="w-full border rounded-xl px-4 py-2" required><option value="low">Low</option><option value="medium">Medium</option><option value="high">High</option><option value="urgent">Urgent</option></select></div>
                <div><label>Reported Date *</label><input type="date" name="reported_date" value="{{ old('reported_date', date('Y-m-d')) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Assigned To</label><input type="text" name="assigned_to" value="{{ old('assigned_to') }}" class="w-full border rounded-xl px-4 py-2"></div>
                <div><label>Status *</label><select name="status" class="w-full border rounded-xl px-4 py-2" required><option value="open">Open</option><option value="in-progress">In Progress</option><option value="review">Under Review</option><option value="completed">Completed</option><option value="cancelled">Cancelled</option></select></div>
                <div><label>Cost ($)</label><input type="number" step="0.01" name="cost" value="{{ old('cost') }}" class="w-full border rounded-xl px-4 py-2"></div>
                <div class="md:col-span-2"><label>Description *</label><textarea name="description" rows="3" class="w-full border rounded-xl px-4 py-2" required>{{ old('description') }}</textarea></div>
            </div>
            <div class="mt-6 flex gap-2"><button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-xl">Create Request</button><a href="{{ route('maintenance.index') }}" class="border px-6 py-2 rounded-xl">Cancel</a></div>
        </form>
    </div>
</div>
@endsection