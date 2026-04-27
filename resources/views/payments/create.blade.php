@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Record Payment</h1>
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Tenant *</label>
                    <select name="tenant_id" class="w-full border rounded p-2" required>
                        <option value="">Select Tenant</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>{{ $tenant->name }} ({{ $tenant->property->name }} - Unit {{ $tenant->unit_number }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Amount ($) *</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label>Payment Date *</label>
                    <input type="date" name="payment_date" value="{{ old('payment_date') }}" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label>Payment Method *</label>
                    <select name="payment_method" class="w-full border rounded p-2" required>
                        <option value="">Select</option>
                        <option value="cash" {{ old('payment_method')=='cash' ? 'selected' : '' }}>Cash</option>
                        <option value="bank_transfer" {{ old('payment_method')=='bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="credit_card" {{ old('payment_method')=='credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="check" {{ old('payment_method')=='check' ? 'selected' : '' }}>Check</option>
                    </select>
                </div>
                <div>
                    <label>Receipt Number</label>
                    <input type="text" name="receipt_number" value="{{ old('receipt_number') }}" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Status *</label>
                    <select name="status" class="w-full border rounded p-2" required>
                        <option value="paid" {{ old('status')=='paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ old('status')=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ old('status')=='failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label>Notes</label>
                    <textarea name="notes" rows="2" class="w-full border rounded p-2">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Payment</button>
                <a href="{{ route('payments.index') }}" class="border px-4 py-2 rounded">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection