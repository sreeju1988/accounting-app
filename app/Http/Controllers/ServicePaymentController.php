<?php

namespace App\Http\Controllers;

use App\Models\ServicePayment;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicePaymentController extends Controller
{
    // Agent view: list and add payments
    public function index($orderId)
    {
        $order = ServiceBooking::with(['payments', 'service'])->findOrFail($orderId);
        $this->authorize('view', $order); // optional policy check

        return view('agent.payments.index', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $order = ServiceBooking::findOrFail($orderId);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'transaction_reference' => 'nullable|string|max:100',
            'remarks' => 'nullable|string|max:500',
        ]);

        $validated['service_order_id'] = $order->id;
        $validated['recorded_by'] = Auth::id();

        ServicePayment::create($validated);

        // Update order totals
        $order->updatePaymentStatus();

        return redirect()
            ->route('agent.payments.index', $order->id)
            ->with('success', 'Payment added successfully.');
    }

    // Admin/Staff view for reviewing payments
    public function adminIndex($orderId)
    {
        $order = ServiceBooking::with(['payments', 'agent', 'service'])->findOrFail($orderId);
        return view('admin.payments.index', compact('order'));
    }
}
