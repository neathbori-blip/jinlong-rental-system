@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Payment</h1>
        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Tenant *</label>
                    <select name="tenant_id" class="w-full border rounded p-2" required>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('tenant_id', $payment->tenant_id) == $tenant->id ? 'selected' : '' }}>{{ $tenant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div><label>Amount ($) *</label><input type="number" step="0.01" name="amount" value="{{ old('amount', $payment->amount) }}" class="w-full border rounded p-2" required></div>
                <div><label>Payment Date *</label><input type="date" name="payment_date" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" class="w-full border rounded p-2" required></div>
                <div>
                    <label>Method *</label>
                    <select name="payment_method" class="w-full border rounded p-2" required>
                        <option value="cash" {{ old('payment_method', $payment->payment_method)=='cash' ? 'selected' : '' }}>Cash</option>
                        <option value="bank_transfer" {{ old('payment_method', $payment->payment_method)=='bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="credit_card" {{ old('payment_method', $payment->payment_method)=='credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="check" {{ old('payment_method', $payment->payment_method)=='check' ? 'selected' : '' }}>Check</option>
                    </select>
                </div>
                <div><label>Receipt Number</label><input type="text" name="receipt_number" value="{{ old('receipt_number', $payment->receipt_number) }}" class="w-full border rounded p-2"></div>
                <div>
                    <label>Status *</label>
                    <select name="status" class="w-full border rounded p-2" required>
                        <option value="paid" {{ old('status', $payment->status)=='paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ old('status', $payment->status)=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ old('status', $payment->status)=='failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div class="md:col-span-2"><label>Notes</label><textarea name="notes" rows="2" class="w-full border rounded p-2">{{ old('notes', $payment->notes) }}</textarea></div>
            </div>
            <div class="mt-4 flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Payment</button>
                <a href="{{ route('payments.index') }}" class="border px-4 py-2 rounded">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection