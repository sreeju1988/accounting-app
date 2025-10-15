<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceBooking;
use App\Models\Ticket;
use App\Models\Service;

class HomeController extends Controller
{
     public function index()
    {
        /**
         * Total payment received and total payment pending
         * show in admin dashboard
         */
        $totalPaymentsReceived = ServiceBooking::where('staff_id', auth()->id())->sum('amount_paid');
        $totalPaymentsPending  = ServiceBooking::where('staff_id', auth()->id())->totalPendingPayments();

        // $totalPaymentsPending check is number or not
        if (!is_numeric($totalPaymentsPending)) {
            $totalPaymentsPending = 0;
        }


        $tickets = Ticket::where('assigned_to', auth()->id())->with('messages','agent')->get();

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
        return view('staff.home', compact('totalPaymentsReceived', 'totalPaymentsPending','stats'));
    }
}
