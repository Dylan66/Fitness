<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TrainerResource;

class BookingsController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth:web', 'role',])->except(['store', 'create', 'search']);
        // return $this->middleware(['auth:web']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::paginate(10);
        // return $bookings;
        return view('dashboard.bookings.index')->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->role == 'admin' or Auth::user()->role == 'trainer' ) {
            #
            toastr()->warning('your role is above doing this');
            return redirect()->back();
        }
        return view('pages.book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        $date = Carbon::parse($request->date);
        $booking = new Booking();
        // return $booking;
        $booking->session = $request->session;
        $booking->date = $date;

        $booking->trainer_id = $request->trainer_id;
        $booking->service_id = $request->service;

        $booking->is_complete = false;

        $booking->user_id = Auth::user()->id;
        $booking->save();
        return $booking;
        // return redirect()->route('paypal', ['booking' => $booking]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
        // return $booking;
        return view('dashboard.bookings.show')->with('booking', $booking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
        return view('dashboard.bookings.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
        return $booking;
    }

    public function search(Request $request)
    {
        //
        // return $request;
        $start = $request->date;

        $date = Carbon::parse($start);


        $posibble = Booking::where('date', $date)->where('session', $request->session)->get();
        // return $posibble;
        $trainers = Trainer::all();
        if (count($posibble) == 0) {
            return TrainerResource::collection($trainers);
        }
        $sorted =  $posibble->countBy('trainer_id');
        // return $sorted;
        foreach ($trainers as $ke => $trainer) {
            //
            foreach ($sorted as $key => $value) {
                if ($key == $trainer->id and $value > 2) {
                    // return $trainer;
                    $trainers->pull($ke);
                    break;
                }
            }
        }

        return TrainerResource::collection($trainers);
    }
}
