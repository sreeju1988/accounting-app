<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBooking;
use App\Models\ServiceBookingDocument;
use App\Models\ServiceOrderLog;
use App\Models\DocumentRule;
use Illuminate\Http\Request;
use App\Models\ServiceCertificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceBookingController extends Controller
{
    /** List all bookings for agent */
    public function index()
    {
        $bookings = ServiceBooking::where('agent_id', Auth::id())
            ->with('service')
            ->latest()
            ->get();

        return view('agent.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $services = Service::select('id', 'name')->where('status', 'active')->latest()->get();
        return view('agent.bookings.create_new_booking', compact('services'));
    }

    public function store(Request $request)
    {
        return redirect()->route('agent.bookings.clientForm', $request->service_id);
    }



    /** Show form for client details */
    public function showClientForm($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        return view('agent.bookings.create_client', compact('service'));
    }

    /** Create a booking record with client info */
    public function createBooking(Request $request, $serviceId)
    {
        $request->validate([
            'client_first_name' => 'required|string|max:100',
            'client_last_name'  => 'required|string|max:100',
            'client_phone'      => 'required|string|max:15',
        ]);

        $service = Service::findOrFail($serviceId);
        try {
            DB::beginTransaction();

            $booking = ServiceBooking::create([
                'agent_id'          => Auth::id(),
                'service_order_number' => $this->generateServiceOrderNumber(),
                'service_id'        => $service->id,
                'client_first_name' => $request->client_first_name,
                'client_last_name'  => $request->client_last_name,
                'client_phone'      => $request->client_phone,
                'status'            => 'Documents Pending',
            ]);

            DB::commit();
            //Log the creation of the service order
            ServiceOrderLog::create([
                'service_booking_id' => $booking->id,
                'action' => 'Service Created',
                'description' => 'Service booked by agent ' . auth()->user()->name,
                'created_by' => auth()->id(),
            ]);
            return redirect()->route('agent.bookings.show', $booking->id);
        } catch (\Exception $e) {

            Log::error('Error creating booking: ' . $e->getMessage());
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create booking. Please try again.']);
        }
    }
    /** Check and generate service order number */
    public function generateServiceOrderNumber()
    {
        $latestBooking = ServiceBooking::latest()->first();
        $nextOrderNumber = $latestBooking ? $latestBooking->id + 1 : 1;
        return 'SO-' . str_pad($nextOrderNumber, 6, '0', STR_PAD_LEFT);
    }

   

    /** Show the document upload form */
    public function showUploadForm($bookingId, $documentId)
    {
       
        $booking = ServiceBooking::with('service')->findOrFail($bookingId);
        $document = $booking->service->documents->find($documentId);
        return view('agent.bookings.single_upload', compact('booking', 'document'));
    }
    /** How to check how many more documents are required */
    public function checkRemainingDocuments($bookingId)
    {
        $booking = ServiceBooking::with('service')->findOrFail($bookingId);
        $requiredDocs = $booking->service->documents;

        // Already uploaded documents
        $uploadedDocIds = ServiceBookingDocument::where('booking_id', $booking->id)
            ->pluck('document_rule_id')
            ->toArray();

        // Find remaining documents
        $remainingDocs = $requiredDocs->whereNotIn('document_rule_id', $uploadedDocIds);
    
        return [
            'remaining' => $remainingDocs->count(),
            'documents' => $remainingDocs
        ];
    }

    /** Update Booking Status */
    private function updateBookingStatus($booking, $newStatus)
    {
        $validStatuses = ['Pending','Documents Pending','Under Review','Waiting for Payment','In Progress','Completed','Cancelled'];
        if (in_array($newStatus, $validStatuses)) {
            $booking->status = $newStatus;
            $booking->save();
        }
    }

    /** Store one document per step */
    public function storeDocument(Request $request, $bookingId)
    {
      
        $booking = ServiceBooking::with('service')->findOrFail($bookingId);
        $document = $booking->service->documents->find($request->document_id);
        $expected_file_formats = explode(',',$document->documentRule->formats);
        $fileSize = $document->documentRule->max_size * 1024; // in KB
        $request->validate([
            'document' => [
                'required',
                'file',
                'mimes:' . implode(',', $expected_file_formats),
                'max:' . $fileSize,
            ],
        ]);
        $path = $request->file('document')->store('documents', 'public');
        ServiceBookingDocument::create([
            'booking_id'       => $booking->id,
            'document_rule_id' => $document->documentRule->id,
            'file_path'        => $path
        ]);

        // Check if all documents are uploaded
        $remainingDocs = $this->checkRemainingDocuments($booking->id);
        if ($remainingDocs['remaining'] == 0) {
            // All documents uploaded
            // Log the creation of the service order
            ServiceOrderLog::create([
                'service_booking_id' => $booking->id,
                'action' => 'Required Documents Uploaded',
                'description' => 'All the required documents uploaded by agent ' . auth()->user()->name,
                'created_by' => auth()->id(),
            ]);
            $this->updateBookingStatus($booking, 'Under Review');

        }
        return redirect()->route('agent.bookings.show', $booking->id)
            ->with('success', 'Document uploaded successfully.');
     }

    // Delete an uploaded document
    public function destroyDocument($bookingId, $documentId)
    {
        $booking = ServiceBooking::findOrFail($bookingId);
        $document = ServiceBookingDocument::where('booking_id', $booking->id)
            ->where('document_rule_id', $documentId)
            ->firstOrFail();

        $document->delete();
        //remove file from storage
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        return redirect()->route('agent.bookings.show', $booking->id)
            ->with('success', 'Document deleted successfully.');
    }

    /** Show all the active services available for booking */
    public function serviceList()
    {
        $services = Service::where('status', 'active')->latest()->get();
        return view('agent.services.service_list', compact('services'));
    }

    /** Service Details */
    public function serviceDetails($id)
    {
        $service = Service::findOrFail($id);
        $bookedServices= ServiceBooking::where('service_id', $service->id)->orderBy('id','desc')->get();
        return view('agent.services.service_details', compact('service', 'bookedServices'));
    }

    /** Show details of a booked service */
    public function bookedServiceShow($id)
    {
        $booking = ServiceBooking::with(['service', 'documents.documentRule'])->findOrFail($id);
        $remainingDocs = $this->checkRemainingDocuments($booking->id);
        $serviceLogs = ServiceOrderLog::where('service_booking_id', $booking->id)->orderBy('created_at', 'desc')->get();
        $certificates = ServiceCertificate::where('service_booking_id', $booking->id)->get();
        return view('agent.bookings.booked_service_show', compact('booking', 'remainingDocs', 'serviceLogs', 'certificates'));
    }

    /** View all bookings - for super_admin */
    public function allBookings()
    {
        $bookings = ServiceBooking::with(['service', 'agent'])->latest()->get();
        return view('admin.service_order.all_bookings', compact('bookings'));
    }
    







    /** Disabled code for later references */


     /** Show one document upload step at a time */
    /* 07-10-2024 - Disabled multi-step upload, now single upload per page 
    public function uploadDocument($bookingId)
    {
        $booking = ServiceBooking::with('service')->findOrFail($bookingId);
        $requiredDocs = $booking->service->documents;

        // Already uploaded documents
        $uploadedDocIds = ServiceBookingDocument::where('booking_id', $booking->id)
            ->pluck('document_rule_id')
            ->toArray();

        // Find the next required document
        $nextDocument = $requiredDocs->firstWhere(function($doc) use ($uploadedDocIds) {
            return !in_array($doc->id, $uploadedDocIds);
        });


        if (!$nextDocument) {
            // All documents uploaded
            $booking->update(['status' => 'Pending']);
            return redirect()->route('agent.bookings.index')
                ->with('success', 'All required documents uploaded successfully!');
        }

        $currentStep = count($uploadedDocIds) + 1;
        $totalSteps  = $requiredDocs->count();

        return view('agent.bookings.upload_document', compact('booking', 'nextDocument', 'currentStep', 'totalSteps'));
    }

    */
}
