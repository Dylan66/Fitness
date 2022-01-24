<?php

namespace App\Http\Controllers;

use App\Service;
use App\Trainer;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        // services
        // trainers
        // 
        // 
        $trainers = Trainer::limit(4)->get();
        // return $trainers;
        $services = Service::limit(4)->get();
        // return $services;
        return view('index')->with('services', $services)->with('trainers', $trainers);
    }
    public function trainers()
    {
        // 
        $trainers = Trainer::limit(4)->get();
        // return $trainers;

        return view('pages.trainers')->with('trainers', $trainers);
    }
    public function services()
    {
        // 
        $services = Service::all();
        return view('pages.services')->with('services', $services);
    }
    public function trainer(Trainer $trainer)
    {
        // 
        return $trainer;
        return view('pages.trainer');
    }
    public function service(Service $service)
    {
        // 
        // return $service;
        return view('pages.service')->with('service', $service);
    }
}
