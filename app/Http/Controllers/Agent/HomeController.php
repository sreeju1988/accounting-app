<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Ticket;
use App\Models\News;
class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', 1)->latest()->take(6)->get();
        $news = News::latest('published_at')->take(5)->get();
        $completedBookingsCount = \App\Models\ServiceBooking::where('agent_id', auth()->user()->id)
            ->where('status', 'Completed')
            ->count();
        $inprogressBookingsCount = \App\Models\ServiceBooking::where('agent_id', auth()->user()->id)
            ->whereNotIn('status', ['Completed', 'Cancelled'])
            ->count();

            $agentId = auth()->id();

    $tickets = Ticket::where('agent_id', $agentId)->get();

    $stats = [
        'total' => $tickets->count(),
        'open' => $tickets->where('status','open')->count(),
        'in_progress' => $tickets->where('status','in_progress')->count(),
        'resolved' => $tickets->where('status','resolved')->count(),
        'closed' => $tickets->where('status','closed')->count(),
        'unreplied' => $tickets->where('status', '!=', 'closed')->filter(function($ticket){
            $lastMessage = $ticket->messages()->latest()->first();
            return $lastMessage && $lastMessage->user_id != auth()->id();
        })->count(),
    ];
        return view('agent.home', compact('blogs', 'completedBookingsCount', 'inprogressBookingsCount', 'stats', 'news'));
    }
}
