<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCont extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:web', 'user']);
    }
    //
    public function index()
    {
        //
        $bookings = Booking::where('user_id', Auth::id())->get();
        $upcoming = Booking::where('date', '>=', now())->where('user_id', Auth::id())->orderBy('date', 'desc')->paginate(10);
        $past = Booking::where('date', '<', now())->where('user_id', Auth::id())->orderBy('date', 'desc')->paginate(10);
        $payments = Payment::where('user_id', Auth::id())->get();

        // return $payments;
        //
        // return Auth::user()->tracks;
        return view('dashboard.user.index')
            ->with('bookings', $bookings)
            ->with('upcoming', $upcoming)
            ->with('past', $past)
            ->with('payments', $payments);
    }
    public function bookings()
    {
        //
        $bookings = Booking::where('user_id', Auth::id())->paginate(10);
        return view('dashboard.user.bookings')->with('bookings', $bookings);
    }
    public function booking(Booking $booking)
    {
        //
        // return $booking;
        return view('dashboard.user.booking')->with('booking', $booking);
    }
    public function payments()
    {
        //
        $payments = Payment::where('user_id', Auth::id())->paginate(10);
        return view('dashboard.user.payments')->with('payments', $payments);
    }
    public function payment(Payment $payment)
    {
        //
        // return $payment;
        return view('dashboard.user.payment')->with('payment', $payment);
    }
    public function pending()
    {
        //
        $bookings = Booking::where('user_id', Auth::id())->where('is_complete', 0)->paginate(10);
        // return $bookings;
        return view('dashboard.user.pending')->with('bookings', $bookings);
    }
    public function future()
    {
        //
        $upcoming = Booking::where('date', '>=', now())->where('user_id', Auth::id())->orderBy('date', 'desc')->paginate(10);
        return view('dashboard.user.future')->with('bookings', $upcoming);
    }
}
