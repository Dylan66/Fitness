<?php

namespace App\Http\Controllers;

use App\User;
use App\Trainer;
use Illuminate\Http\Request;

class TrainersController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:web', 'role']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('role', 'trainer')->paginate(10);
        // return $users;
        return view('dashboard.trainers.index')->with('trainers', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::where('role', 'user')->get();
        // return $users;
        return view('dashboard.trainers.create')->with('users', $users);
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
            'user_id' => $request->input('user_id'),
            'image' => $image,
            'rating' => 5,
        ]);
        // return $trainer;
        $user = $trainer->user;
        $user->role = 'trainer';
        $user->is_complete = true;
        toastr()->success('Trainer created successfully');
        $user->save();
        // return $trainer;
        return redirect()->route('trainers.show', ['trainer' => $trainer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(User $trainer)
    {
        //
        // return $trainer;
        // $trainer = Trainer::find($trainer);
        // return $trainer->trainer->bookings;
        return view('dashboard.trainers.show')->with('user', $trainer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit(User $trainer)
    {
        //
        // return $trainer;
        return view('dashboard.trainers.edit')->with('trainer', $trainer->trainer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        //
        // return $request;
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
            $trainer->image = $image;
        }
        $trainer->description = $request->description;
        toastr()->success('Trainer editted successfully');
        $trainer->save();

        return redirect()->route('trainers.show', ['trainer' => $trainer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
        //
        return $trainer;
    }
}
