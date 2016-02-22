<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Event;


class WelcomeController extends Controller
{
    /**
     * Show the applications welcome page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $public_events = Event::getPublicEvents();
        
        return view('welcome')->with('public_events', $public_events);
    }
}
