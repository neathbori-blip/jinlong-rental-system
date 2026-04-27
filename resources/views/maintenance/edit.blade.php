@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Maintenance Request #{{ $maintenance->request_number }}</h1>
        <form action="{{ route('maintenance.update', $maintenance) }}" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label>Property</label><select name="property_id" class="w-full border rounded-xl px-4 py-2">@foreach($properties as $p)<option value="{{ $p->id }}" {{ old('property_id',$maintenance->property_id)==$p->id?'selected':'' }}>{{ $p->name }}</option>@endforeach</select></div>
                <div><label>Tenant</label><select name="tenant_id" class="w-full border rounded-xl px-4 py-2"><option value="">None</option>@foreach($tenants as $t)<option value="{{ $t->id }}" {{ old('tenant_id',$maintenance->tenant_id)==$t->id?'selected':'' }}>{{ $t->name }}</option>@endforeach</select></div>
                <div><label>Unit Number</label><input type="text" name="unit_number" value="{{ old('unit_number',$maintenance->unit_number) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Issue Type</label><input type="text" name="issue_type" value="{{ old('issue_type',$maintenance->issue_type) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Priority</label><select name="priority" class="w-full border rounded-xl px-4 py-2">@foreach(['low','medium','high','urgent'] as $pr)<option value="{{ $pr }}" {{ old('priority',$maintenance->priority)==$pr?'selected':'' }}>{{ ucfirst($pr) }}</option>@endforeach</select></div>
                <div><label>Reported Date</label><input type="date" name="reported_date" value="{{ old('reported_date',$maintenance->reported_date->format('Y-m-d')) }}" class="w-full border rounded-xl px-4 py-2" required></div>
                <div><label>Assigned To</label><input type="text" name="assigned_to" value="{{ old('assigned_to',$maintenance->assigned_to) }}" class="w-full border rounded-xl px-4 py-2"></div>
                <div><label>Status</label><select name="status" class="w-full border rounded-xl px-4 py-2">@foreach(['open','in-progress','review','completed','cancelled'] as $st)<option value="{{ $st }}" {{ old('status',$maintenance->status)==$st?'selected':'' }}>{{ ucfirst($st) }}</option>@endforeach</select></div>
                <div><label>Cost ($)</label><input type="number" step="0.01" name="cost" value="{{ old('cost',$maintenance->cost) }}" class="w-full border rounded-xl px-4 py-2"></div>
                <div class="md:col-span-2"><label>Description</label><textarea name="description" rows="3" class="w-full border rounded-xl px-4 py-2" required>{{ old('description',$maintenance->description) }}</textarea></div>
            </div>
            <div class="mt-6 flex gap-2"><button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-xl">Update</button><a href="{{ route('maintenance.index') }}" class="border px-6 py-2 rounded-xl">Cancel</a></div>
        </form>
    </div>
</div>
@endsection