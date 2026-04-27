<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tenant;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('tenant')->latest()->paginate(10);
        $totalCollected = Payment::where('status', 'paid')->sum('amount');
        $pendingCount = Payment::where('status', 'pending')->count();
        $averagePayment = Payment::avg('amount') ?? 0;

        return view('payments.index', compact('payments', 'totalCollected', 'pendingCount', 'averagePayment'));
    }

    public function create()
    {
        $tenants = Tenant::all();
        return view('payments.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:50',
            'receipt_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'status' => 'required|in:paid,pending,failed',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')
                         ->with('success', 'Payment recorded successfully!');
    }

    public function show(Payment $payment)
    {
        $payment->load('tenant');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $tenants = Tenant::all();
        return view('payments.edit', compact('payment', 'tenants'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:50',
            'receipt_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'status' => 'required|in:paid,pending,failed',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
                         ->with('success', 'Payment updated!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')
                         ->with('success', 'Payment deleted.');
    }
}