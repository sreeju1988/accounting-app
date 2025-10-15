<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicePayment;
use App\Models\ServiceBooking;
use App\Models\ServiceOrderLog;
use Illuminate\Support\Facades\Auth;

class ServicePaymentController extends Controller
{
    public function addPaymentForm($bookingId)
    {
        $booking = ServiceBooking::findOrFail($bookingId);
        return view('admin.payments.add_payment', compact('booking'));
    }

    public function storePayment(Request $request, $bookingId)
    {
     

        $request->validate([
            'payment_amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|string',
            'payment_reference' => 'nullable|string',
            'payment_note' => 'nullable|string',
        ]);

        $booking = ServiceBooking::findOrFail($bookingId);

  
        $payment = new ServicePayment();
        $payment->service_booking_id = $booking->id;
        $payment->amount = $request->payment_amount;
        $payment->payment_mode = $request->payment_mode;
        $payment->remarks = $request->payment_reference;
        $payment->note = $request->payment_note;
        $payment->payment_date = now();
        //$payment->recorded_by = Auth::id();
        $payment->save();

        $this->updatePaidAmount($booking, $payment->amount);

        return redirect()->route('admin.service_order.show', $booking->id)
            ->with('success', 'Payment added successfully.');
    }

    // Update paid amount for a booking

    public function updatePaidAmount($booking, $amount)
    {
        $totalPaid = $booking->amount_paid + $amount;
        $booking->amount_paid = $totalPaid;
        $booking->save();
        // Use the balance_due attribute or method if defined as an accessor
        $balanceDue = $booking->getBalanceDueAttribute();

         ServiceOrderLog::create([
                'service_booking_id' => $booking->id,
                'action' => 'Payment verified',
                'description' => 'Payment of ' . $amount . ' verified. Balance due: ' . ($balanceDue ?? 'N/A'),
                'created_by' => auth()->user() ? auth()->user()->id : null,
            ]);

        if (null !== $balanceDue && $balanceDue <= 0) {
            $booking->payment_status = 'paid';
            $booking->invoice_number = 'INV-' . now()->format('Y') . '-' . str_pad($booking->id, 4, '0', STR_PAD_LEFT);
            $booking->invoice_generated_at = now();
            $booking->save();
        }
    }



    // Admin view of payments for a specific order
    public function adminIndex($orderId)
    {
        $booking = ServiceBooking::with('payments')->findOrFail($orderId);
        return view('admin.payments.index', compact('booking'));
    }
}
