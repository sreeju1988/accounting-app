<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'phone'  => 'nullable|string|max:15',
            'address'=> 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $filename = time().'_'.$request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('uploads/avatars'), $filename);
            $user->avatar = 'uploads/avatars/'.$filename;
        }

        // Update fields
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->phone   = $request->phone;
        $user->address = $request->address;

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }


      // ✅ Show change password form
    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    // ✅ Handle password update
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('profile.password.edit')->with('success', 'Password changed successfully!');
    }
}
