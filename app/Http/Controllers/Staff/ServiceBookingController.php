<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Models\ServiceOrderLog;
use App\Models\User;
use App\Models\ServiceBookingDocument;
use Illuminate\Support\Facades\Storage;

class ServiceBookingController extends Controller
{
    

    public function index()
    {
        $bookings = ServiceBooking::where('staff_id', auth()->user()->id)->with(['service', 'agent'])->latest()->get();
        return view('staff.service_order.all_bookings', compact('bookings'));
    } 
    
    public function inprogressBookings()
    {
        $bookings = ServiceBooking::where('staff_id', auth()->user()->id)->with(['service', 'agent'])
            ->whereNotIn('status', ['Completed', 'Cancelled'])
            ->latest()
            ->get();
        return view('staff.service_order.inprogress_bookings', compact('bookings'));
    }

    public function completedBookings()
    {
        $bookings = ServiceBooking::where('staff_id', auth()->user()->id)->with(['service', 'agent'])
            ->where('status', 'Completed')
            ->latest()
            ->get();
        return view('staff.service_order.completed_bookings', compact('bookings'));
    }

    public function cancelledBookings()
    {
        $bookings = ServiceBooking::where('staff_id', auth()->user()->id)->with(['service', 'agent'])
            ->where('status', 'Cancelled')
            ->latest()
            ->get();
        return view('staff.service_order.cancelled_bookings', compact('bookings'));
    }

    public function show($id)
    {
        $booking = ServiceBooking::with(['service', 'agent'])->findOrFail($id);
        $serviceLogs = ServiceOrderLog::where('service_booking_id', $booking->id)->orderBy('created_at', 'desc')->get();
        return view('staff.service_order.booking_detail', compact('booking', 'serviceLogs'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Documents Pending,Under Review,Waiting for Payment,In Progress,Completed,Cancelled',
            'remarks' => 'nullable|string|max:255',
        ]);

        $booking = ServiceBooking::findOrFail($id);
        $previousStatus = $booking->status;
        $booking->status = $request->status;
        $booking->status_remarks = $request->remarks;
        $booking->save();

        // Log the status change
        if ($previousStatus !== $booking->status) {
            ServiceOrderLog::create([
                'service_booking_id' => $booking->id,
                'action' => 'Status Changed',
                'description' => 'Service Status changed from ' . $previousStatus . ' to ' . $booking->status . '.',
                'created_by' => auth()->user() ? auth()->user()->id : null,
            ]);
        }

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

   

    /** Show form to add fees for the booking */
    public function addFeesForm($id)
    {
        $booking = ServiceBooking::findOrFail($id);
        return view('staff.payments.add_fees', compact('booking'));
    }

    /** Add fees for the booking */
    public function addFees(Request $request, $id)
    {
        $booking = ServiceBooking::findOrFail($id);

        $request->validate([
            'fees_amount' => 'required|numeric|min:0'
        ]);

        $booking->total_amount = $request->fees_amount;
        $booking->save();
        if($booking)
        {
            // Log the addition of fees
            ServiceOrderLog::create([
                'service_booking_id' => $booking->id,
                'action' => 'Fees Added',
                'description' => 'Fees of amount ' . $request->fees_amount . ' added for the service.',
                'created_by' => auth()->user() ? auth()->user()->id : null,
            ]);
        }
        return redirect()->back()->with('success', 'Fees added successfully.');
    }


    /** 
     * Download service booking file download
     */
    public function downloadDocument($documentId)
    {
        $document = ServiceBookingDocument::findOrFail($documentId);
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }
        return Storage::disk('public')->download($document->file_path, $document->file_name);


    }
}
