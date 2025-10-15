<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Models\ServicePayment;
use App\Models\Ticket;

class HomeController extends Controller
{
    public function index()
    {
        /**
         * Total payment received and total payment pending
         * show in admin dashboard
         */
        $totalPaymentsReceived = ServiceBooking::sum('amount_paid');
        $totalPaymentsPending  = ServiceBooking::totalPendingPayments();

        $totalAgentsCount = \App\Models\User::where('role', \App\Models\User::ROLE_AGENT)->count();
        $totalStaffCount  = \App\Models\User::where('role', \App\Models\User::ROLE_STAFF)->count();
        $totalServices    = Service::where('status','active')->count();
        $totalInactiveServices = Service::where('status','inactive')->count();

        $tickets = Ticket::with('messages','agent')->get();

        $stats = [
            'total' => $tickets->count(),
            'open' => $tickets->where('status','open')->count(),
            'in_progress' => $tickets->where('status','in_progress')->count(),
            'resolved' => $tickets->where('status','resolved')->count(),
            'closed' => $tickets->where('status','closed')->count(),
            'unassigned' => $tickets->whereNull('assigned_to')->count(),
            'unreplied' => $tickets->where('status', '!=', 'closed')->filter(function($ticket){
                $lastMessage = $ticket->messages()->latest()->first();
                return $lastMessage && $lastMessage->user_id != auth()->id();
            })->count(),
        ];
        return view('admin.home', compact('totalPaymentsReceived', 'totalPaymentsPending', 'totalAgentsCount', 'totalStaffCount', 'totalServices', 'totalInactiveServices', 'stats'));
    }
}
