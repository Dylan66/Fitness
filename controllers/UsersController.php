<?php

namespace App\Http\Controllers;

use App\User;
use App\Track;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\Approved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UsersController extends Controller
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
        // return Auth::user();
        $users = User::where('role', 'user')->paginate(10);
        // return $users;
        return view('dashboard.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.users.create');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('dashboard.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('dashboard.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        // return $request;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->is_complete = $request->is_complete == 1 ? true : false;
        $user->save();
        toastr()->success($user->name . 'Editted Successfully');
        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        toastr()->success($user->name . 'Deleted Successfully');

        return redirect()->route('users.index');
    }

    public function pending()
    {
        // 
        $users = User::where('role', 'user')->where('is_complete', 0)->paginate(10);
        // return $users;
        return view('dashboard.users.pending')->with('users', $users);
    }

    public function approve($user)
    {
        // 
        return view('dashboard.users.approve')->with('user', User::find($user));
    }

    public function data_page($user)
    {
        // 
        return view('dashboard.users.data')->with('user', User::find($user));
    }
    public function save($user, Request $request)
    {
        // 
        // return $request;
        $track = new Track();
        $track->user_id = $user;
        $track->weight = $request->weight;
        $track->date = Carbon::now()->format('yy-m-d');
        $track->pressure = $request->pressure;
        // $track->weight = $request->weight;

        $user = User::find($user);
        
        $user->is_complete = true;
        $track->save();
        $user->save();
        Notification::send($user, new Approved());
        toastr()->success($user->name . ' approved Successfully');
        return redirect()->route('users.show', ['user' => $user]);
    }
    // 
    public function data($user, Request $request)
    {
        // 
        // return $request;
        $track = new Track();
        $track->user_id = $user;
        $track->weight = $request->weight;
        $track->date = Carbon::parse($request->date)->format('yy-m-d');
        $track->pressure = $request->pressure;
        // $track->weight = $request->weight;

        $user = User::find($user);
        $user->is_complete = true;
        $track->save();
        $user->save();
        toastr()->success($user->name . ' data entered Successfully');
        return redirect()->route('users.show', ['user' => $user]);
    }
}
