<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Mail;
use App\Event;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->getUsersEvents();

        return view('home')->with('events', $events);
    }

    public function getUsersEvents()
    {

        $user = Auth::user();
        $events = Event::where('uid', '=', $user->uid)->get();
      
        return $events;
    }
}
