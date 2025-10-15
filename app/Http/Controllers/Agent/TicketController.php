<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    // List tickets for this agent
    public function index()
    {
        $tickets = Ticket::where('agent_id', Auth::id())->latest()->paginate(10);
        return view('agent.tickets.index', compact('tickets'));
    }

    // Show create ticket form
    public function create(Request $request)
    {
        $services = ServiceBooking::where('agent_id', Auth::id())->get();
        $serviceId = $request->service_id; // optional preselect if from service detail
        return view('agent.tickets.create', compact('services','serviceId'));
    }

    // Store ticket
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:general,service',
            'service_booking_id' => 'nullable|exists:service_bookings,id',
            'attachment' => 'nullable|file|max:5120' // 5 MB
        ]);

        $ticket = Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'type' => $request->type,
            'service_booking_id' => $request->service_booking_id,
            'agent_id' => Auth::id(),
            'status' => 'open',
        ]);

        // store first message
        $messageData = [
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->description,
        ];

        if($request->hasFile('attachment')) {
            $messageData['attachment'] = $request->file('attachment')->store('tickets','public');
        }

        TicketMessage::create($messageData);

        return redirect()->route('agent.tickets.index')->with('success','Ticket created successfully.');
    }

    // Show ticket messages
    public function show(Ticket $ticket)
    {
    
        $messages = $ticket->messages()->orderBy('created_at', 'desc')->get();
        return view('agent.tickets.show', compact('ticket','messages'));
    }

    // Reply to ticket
    public function reply(Request $request, Ticket $ticket)
    {

        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:5120'
        ]);

        $data = [
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ];

        if($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('tickets','public');
        }

        TicketMessage::create($data);

        // optionally update ticket status to in_progress when agent replies
        if($ticket->status == 'open') {
            $ticket->status = 'in_progress';
            $ticket->save();
        }

        return back()->with('success','Message sent successfully.');
    }
}
