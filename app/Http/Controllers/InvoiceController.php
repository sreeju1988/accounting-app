<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServicePayment;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\App;

class InvoiceController extends Controller
{
    public function download($id)
    {
        $payment = ServicePayment::with(['serviceBooking'])->findOrFail($id);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('invoices.payment', compact('payment'));

        return $pdf->download($payment->invoice_number . '.pdf');
    }

    public function downloadFinalInvoice($bookingId)
    {
        $booking = ServiceBooking::with(['agent', 'service'])->findOrFail($bookingId);

        if (!$booking->invoice_number) {
            abort(403, 'Invoice not yet generated. Please complete full payment.');
        }

        $payments = ServicePayment::where('service_booking_id', $booking->id)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('invoices.final_payment', compact('booking', 'payments'));
        return $pdf->download($booking->invoice_number . '.pdf');

        // $pdf = PDF::loadView('invoices.service_booking', compact('booking', 'payments'));
        // $fileName = 'invoice-' . $booking->invoice_number . '.pdf';

        // return $pdf->download($fileName);
    }
}
