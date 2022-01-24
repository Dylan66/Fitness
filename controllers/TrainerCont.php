<?php

namespace App\Http\Controllers;

use App\User;
use App\Booking;
use App\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerCont extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:web', 'trainer']);
    }
    //
    public function index()
    {
        //
        $trainer = Trainer::where('user_id', Auth::id())->first();
        if ($trainer == null) {
            return redirect()->route('trainer.finish');
        }

        $bookings = Booking::where('trainer_id', $trainer->id)->paginate(10);
        $upcoming = Booking::where('date', '>=', now())->where('trainer_id', $trainer->id)->orderBy('date', 'desc')->paginate(10);;
        $past = Booking::where('date', '<', now())->where('trainer_id', $trainer->id)->orderBy('date', 'desc')->paginate(10);
        $users = User::where('role', 'user')->get();
        //
        return view('dashboard.trainer.index')->with('users', $users)
            ->with('bookings', $bookings)
            ->with('upcoming', $upcoming)
            ->with('past', $past)
            ->with('users', $users);
    }
    public function finish()
    {
        //
        $trainer = Trainer::where('user_id', Auth::id())->first();
        if ($trainer != null) {
            return redirect()->route('trainer.index');
        }
        // return $trainer;
        return view('dashboard.trainer.finish');
        // return 'finish';
    }
    public function save(Request $request)
    {
        //
        if ($request->hasFile('image')) {
            //get filename adn extension
            $filenamewithext = $request->file('image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenamewithext,     PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //set filename
            $image =    $filename . 'image_' . $request->title . time() . '.' . $extension;
            //upload image
            $request->file('image')->storeAs('public/uploads/images', $image);
        } else {
            $image = 'image.jpg';
        }
        $trainer = Trainer::create([
            // 'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id,
            'image' => $image,
            'rating' => 5,
        ]);
        // return $trainer;
        $user = $trainer->user;
        $user->role = 'trainer';
        toastr()->success('Profile saved successfully');
        $user->save();
        // return $trainer;
        return redirect()->route('trainers.show', ['trainer' => $trainer]);
        return 'save';
    }
    public function bookings()
    {
        //
        $trainer = Trainer::where('user_id', Auth::id())->first();
        if ($trainer == null) {
            return redirect()->route('trainer.finish');
        }
        $bookings = Booking::where('trainer_id', $trainer->id)->paginate(10);
        // return $bookings;
        return view('dashboard.trainer.bookings')->with('bookings', $bookings);
        //
    }
    public function booking(Booking $booking)
    {
        //
        // return $booking;
        return view('dashboard.trainer.booking')->with('booking', $booking);
    }

    public function future()
    {
        //
        $trainer = Trainer::where('user_id', Auth::id())->first();
        if ($trainer == null) {
            return redirect()->route('trainer.finish');
        }
        $bookings = Booking::where('date', '>=', now())->where('trainer_id', $trainer->id)->orderBy('date', 'desc')->paginate(10);


        return view('dashboard.trainer.future')->with('bookings', $bookings);
    }
}
