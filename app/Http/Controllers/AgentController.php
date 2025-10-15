<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AgentInvitation;

use Illuminate\Http\Request;

class AgentController extends Controller
{
      public function index()
    {
        // Get invited agents (from invitations)
        $invitations = AgentInvitation::where('role', 'agent')->get();

        // Get registered agents (from users table)
        $agentUsers = User::where('role', 'agent')->get();

        return view('admin.agent.index', compact('invitations', 'agentUsers'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->role !== 'agent') {
            return back()->withErrors(['error' => 'Only agent accounts can be managed']);
        }

        $user->is_active = !$user->is_active; // toggle active flag
        $user->save();

        return back()->with('success', 'Agent status updated successfully');
    }
    public function show(User $user)
    {
        if ($user->role !== 'agent') {
            return back()->withErrors(['error' => 'Only agent accounts can be viewed']);
        }
        $serviceBookings = $user->serviceBookings()->with('service')->latest()->get();
        return view('admin.agent.show', compact('user', 'serviceBookings'));
    }
}
