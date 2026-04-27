@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold"><i class="fas fa-dollar-sign text-green-600 mr-2"></i> Payments</h1>
        <a href="{{ route('payments.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Record Payment</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 p-3 mb-4 text-green-700">{{ session('success') }}</div>
    @endif

    <!-- Summary cards -->
    <div class="grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow text-center">
            <div class="text-green-600 text-2xl"><i class="fas fa-money-bill-wave"></i></div>
            <div class="text-xl font-bold">${{ number_format($totalCollected, 2) }}</div>
            <div class="text-gray-500">Total Collected</div>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <div class="text-yellow-600 text-2xl"><i class="fas fa-clock"></i></div>
            <div class="text-xl font-bold">{{ $pendingCount }}</div>
            <div class="text-gray-500">Pending Payments</div>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <div class="text-blue-600 text-2xl"><i class="fas fa-chart-line"></i></div>
            <div class="text-xl font-bold">${{ number_format($averagePayment, 2) }}</div>
            <div class="text-gray-500">Average Payment</div>
        </div>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2">Tenant</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Method</th>
                    <th class="px-4 py-2">Receipt #</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $payment->tenant->name }}</td>
                    <td class="px-4 py-2">{{ $payment->formatted_amount }}</td>
                    <td class="px-4 py-2">{{ $payment->payment_date->format('M d, Y') }}</td>
                    <td class="px-4 py-2">{{ ucfirst($payment->payment_method) }}</td>
                    <td class="px-4 py-2">{{ $payment->receipt_number ?? '-' }}</td>
                    <td class="px-4 py-2">
                        @if($payment->status == 'paid')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Paid</span>
                        @elseif($payment->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Pending</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded">Failed</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('payments.show', $payment) }}" class="text-blue-600 mr-2"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('payments.edit', $payment) }}" class="text-yellow-600 mr-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline" onsubmit="return confirm('Delete this payment?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4">No payments recorded. <a href="{{ route('payments.create') }}" class="text-green-600">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $payments->links() }}</div>
</div>
@endsection