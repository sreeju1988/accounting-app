<?php

namespace App\Http\Controllers;

use App\Models\AgentInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgentInvitationMail;

class AgentInvitationController extends Controller
{
    
    public function index()
    {
        $invitations = AgentInvitation::orderBy('id', 'desc')->get();
        return view('invitations.agent.index', compact('invitations'));
    }

    public function create()
    {
        return view('invitations.agent.create'); // simple form: enter email
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:agent_invitations,email',
        ]);

        $token = Str::random(40);

        $invitation = AgentInvitation::create([
            'email' => $request->email,
            'role' => 'agent',
            'token' => $token,
            'expires_at' => now()->addDays(7),
        ]);

        // Send email with invitation link
        $link = route('invitations.agent.accept', $token);

        Mail::to($request->email)->send(new AgentInvitationMail($token, $request->email, auth()->user()->name));

        return back()->with('success', 'Invitation sent to '.$request->email);
    }

    public function resend($token)
    {
        $invitation = AgentInvitation::where('token', $token)->firstOrFail();

        // Resend email with invitation link
        $link = route('invitations.agent.accept', $invitation->token);

        // Send email
        Mail::to($invitation->email)->send(new AgentInvitationMail($token, $invitation->email, auth()->user()->name));

        return back()->with('success', 'Invitation resent to '.$invitation->email);
    }

    public function accept($token)
    {
        $invitation = AgentInvitation::where('token', $token)
            ->where('accepted', false)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        return view('invitations.agent.register', compact('invitation'));
    }

    public function register(Request $request, $token)
    {
        $invitation = AgentInvitation::where('token', $token)
            ->where('accepted', false)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string',
            'password' => 'required|confirmed|min:8',
        ]);

        // Create new staff user
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'password' => bcrypt($request->password),
            'role' => $invitation->role, // staff
        ]);

        $invitation->update(['accepted' => true]);

        return redirect()->route('login')->with('success', 'Account created! Please login.');
    }
}
