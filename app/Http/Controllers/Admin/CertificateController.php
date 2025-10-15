<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCertificate;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index($booking_id)
    {
        $booking = ServiceBooking::findOrFail($booking_id);
        $certificates = ServiceCertificate::where('service_booking_id',$booking_id)->with('serviceOrder', 'uploader')->latest()->get();
        return view('admin.certificates.index', compact('certificates','booking'));
    }

    public function create($serviceOrderId)
    {
        $serviceOrder = ServiceBooking::findOrFail($serviceOrderId);
        return view('admin.certificates.create', compact('serviceOrder'));
    }
    public function store(Request $request, $serviceOrderId)
    {

        $request->validate([
            'file_title' => 'required|string|max:255',
            'files.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10 MB max
            'notes' => 'nullable|string',
        ]);

        $booking = ServiceBooking::findOrFail($serviceOrderId);

        foreach ($request->file('files') as $file) {
            $path = $file->store("certificates/{$serviceOrderId}", 'public');
            ServiceCertificate::create([
                'service_booking_id' => $serviceOrderId,
                'uploaded_by' => Auth::id(),
                'file_title' => $request->file_title,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientMimeType(),
                'notes' => $request->notes,
            ]);
        }

        // TODO: trigger email notification to the agent

        return back()->with('success', 'Certificates uploaded successfully.');
    }

    public function download($id)
    {
        $certificate = ServiceCertificate::findOrFail($id);
        if (!Storage::disk('public')->exists($certificate->file_path)) {
            abort(404, 'File not found.');
        }
        return Storage::disk('public')->download($certificate->file_path, $certificate->file_name);
    }
}
