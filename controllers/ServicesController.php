<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:web', 'role'])->except('services');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Service::all();
        return view('dashboard.services.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.services.create');
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
        $service = new Service();
        $service->name = $request->name;
        $service->amount = $request->amount;
        $service->description = $request->description;
        $service->save();

        return redirect()->route('services.show', ['service' => $service]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
        // return $service;
        return view('dashboard.services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
        // return $service;
        return view('dashboard.services.edit')->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
        // return $request;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->amount = $request->amount;

        $service->save();
        toastr()->success('Service editted successfully');
        return redirect()->route('services.show', ['service' => $service]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        // return $service;
        $service->delete();
        toastr()->success('Service deleted successfully');
        return redirect()->route('services.index');
    }

    public function services(Service $service)
    {
        //
        return Service::all();
        // return $service;

    }
}
