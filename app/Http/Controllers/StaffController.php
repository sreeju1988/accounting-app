<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invitation;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class StaffController extends Controller
{
     public function index()
    {
        // Get invited staff (from invitations)
        $invitations = Invitation::where('role', 'staff')->get();

        // Get registered staff (from users table)
        $staffUsers = User::where('role', 'staff')->get();

        return view('admin.staff.index', compact('invitations', 'staffUsers'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->role !== 'staff') {
            return back()->withErrors(['error' => 'Only staff accounts can be managed']);
        }

        $user->is_active = !$user->is_active; // toggle active flag
        $user->save();

        return back()->with('success', 'Staff status updated successfully');
    }

    public function show(User $user)
    {
        if ($user->role !== 'staff') {
            return back()->withErrors(['error' => 'Only staff accounts can be viewed']);
        }

        return view('admin.staff.show', compact('user'));
    }

    public function completedProjects(User $user)
    {
        if ($user->role !== 'staff') {
            return back()->withErrors(['error' => 'Only staff accounts can be viewed']);
        }
        // Fetch completed or cancelled bookings for the staff
        $completedBookings = ServiceBooking::where('staff_id', $user->id)->whereIn('status', ['Completed', 'Cancelled'])->latest()->get();
        return view('admin.staff.completed_project', compact('user', 'completedBookings'));
    }
}
