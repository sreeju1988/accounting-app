<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\StaffInvitationMail;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::orderBy('id', 'desc')->get();
        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        return view('invitations.create'); // simple form: enter email
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:invitations,email',
        ]);

        $token = Str::random(40);

        $invitation = Invitation::create([
            'email' => $request->email,
            'role' => 'staff',
            'token' => $token,
            'expires_at' => now()->addDays(7),
        ]);

        // Send email with invitation link
        $link = route('invitations.accept', $token);

         // Send email
         Mail::to($request->email)->send(new StaffInvitationMail($token,$request->email,auth()->user()->name));

        return back()->with('success', 'Invitation sent to '.$request->email);
    }

    public function resend($id)
    {
        $invitation = Invitation::findOrFail($id);

        // Resend email with invitation link
        $link = route('invitations.accept', $invitation->token);

        Mail::raw("You are invited to join as Staff. Click here to register: $link", function ($message) use ($invitation) {
            $message->to($invitation->email)->subject('Staff Invitation Resent');
        });

        return back()->with('success', 'Invitation resent to '.$invitation->email);
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('accepted', false)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        return view('invitations.register', compact('invitation'));
    }

    public function register(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('accepted', false)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|string|min:10|max:13',
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
