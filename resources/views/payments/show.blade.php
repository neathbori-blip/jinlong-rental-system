@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Payment Details</h1>
            <a href="{{ route('payments.index') }}" class="text-green-600">← Back</a>
        </div>
        <hr class="my-4">
        <p><strong>Tenant:</strong> {{ $payment->tenant->name }}</p>
        <p><strong>Amount:</strong> {{ $payment->formatted_amount }}</p>
        <p><strong>Date:</strong> {{ $payment->payment_date->format('M d, Y') }}</p>
        <p><strong>Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
        <p><strong>Receipt #:</strong> {{ $payment->receipt_number ?? 'N/A' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
        <p><strong>Notes:</strong> {{ $payment->notes ?? '—' }}</p>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('payments.edit', $payment) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
            <form action="{{ route('payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Delete payment?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection