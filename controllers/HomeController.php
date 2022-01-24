<?php

namespace App\Http\Controllers;

use App\User;
use App\Booking;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        return $this->middleware(['auth:web']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $payments = Payment::all();
        $bookings = Booking::all();
        $users = User::where('role', 'user')->get();
        $trainers = User::where('role', 'trainer')->get();
        $all = User::paginate(10);

        $admin = User::where('role', 'admin')->first();
        if ($admin == null) {
            $admin = User::find(Auth::id());
            $admin->role = 'admin';
            $admin->is_complete = true;
            $admin->save();
            // return $admin;
        }
        $user = User::find(Auth::id());
        if ($user->role != 'admin') {
            return redirect()->route('users.index');
        }
        // return $admin;
        // return $all;
        return view('home')
            ->with('payments', $payments)
            ->with('users', $users)
            ->with('trainers', $trainers)
            ->with('all', $all)
            ->with('bookings', $bookings);
    }
    public function wait()
    {
        // 
        if (Auth::user()->is_complete == 1) {
            return redirect()->route('home');
        }
        return view('pages.wait');
    }
}
