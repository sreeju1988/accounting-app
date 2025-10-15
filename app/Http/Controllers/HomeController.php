<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $user=auth()->user();
        if($user->roleType()=='Admin'){

            return redirect('/admin/home');
        }

        if($user->roleType()=='Agent'){

            return redirect('/agent/home');
        }
        if($user->roleType()=='Staff'){

            return redirect('/staff/home');
        }
        return view('home');
    }
}
