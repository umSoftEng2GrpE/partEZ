<?php

namespace App\Http\Controllers;

use App\Invite;
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
        $invites = $this->getUserInvitedEvents();

        return view('home')->with('events', $events)->with('invites', $invites);
    }

    public function getUsersEvents()
    {
        $user = Auth::user();
        //$events = Event::where('uid', '=', $user->uid)->get();
        //$event = new Event();
        $events = Event::getUserEvents($user->uid);
        return $events;
    }

    public function getUserInvitedEvents()
    {
        $user = Auth::user();
        $invites = Invite::where('uid', '=', $user->uid)->get();
        $events = [];
        foreach($invites as $invite)
        {
            $event_array= (Event::where('eid', '=', $invite->eid)->get() );
            foreach($event_array as $single_event)
            {
                array_push($events,$single_event);
            }
        }
        return $events;
    }
}
