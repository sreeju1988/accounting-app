<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketReplyMail;

class TicketController extends Controller
{
    // List all tickets
    public function index(Request $request)
    {
        $tickets = Ticket::with(['agent','assignedStaff'])
                        ->latest()
                        ->paginate(15);

        return view('admin.tickets.index', compact('tickets'));
    }

    // Show ticket messages
    public function show(Ticket $ticket)
    {
        $messages = $ticket->messages()->latest()->get();
        $staffList = User::where('role','staff')->get(); // for assign dropdown
        return view('admin.tickets.show', compact('ticket','messages','staffList'));
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

        // Update status to in_progress if currently open
        if($ticket->status == 'open') {
            $ticket->status = 'in_progress';
            $ticket->save();
        }

        // Notify agent via email
        Mail::to($ticket->agent->email)->send(new TicketReplyMail($ticket, $data['message']));

        return back()->with('success','Reply sent successfully.');
    }

    // Assign ticket to staff
    public function assign(Request $request, Ticket $ticket)
    {
       
        $request->validate([
            'assigned_to' => 'required|exists:users,id'
        ]);
        $ticket->assigned_to = $request->assigned_to;
        $ticket->save();

        return back()->with('success','Ticket assigned successfully.');
    }

    // Change ticket status
    public function changeStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed'
        ]);

        $ticket->status = $request->status;
        $ticket->save();

        return back()->with('success','Ticket status updated.');
    }
}
