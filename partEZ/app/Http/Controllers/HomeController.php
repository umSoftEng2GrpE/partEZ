<?php

namespace App\Http\Controllers;

use App\Invite;
use Auth;
use DB;
use Mail;
use App\Event;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;

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
    public function index($local_events_only = false)
    {
        $user = Auth::user();
        $events = $this->getUsersEvents();
        $invites = $this->getUserInvitedEvents();
        $public_events = Event::getPublicEvents();
        $this->updateCity();
        
        return view('home')->with('events', $events)
            ->with('invites', $invites)
            ->with('public_events', $public_events)
            ->with('local_events_only', $local_events_only)
            ->with('city', $user->city);
    }

    public function updateCity()
    {
        $input = Request::all();
        $user = Auth::user();
        $city =  array_key_exists ('city' , $input) ? $input['city'] : $user->city;
        $user->city = $city;
        $user->save();
    }

    public function getUsersEvents()
    {
        $user = Auth::user();

        $events = Event::getUserEvents($user->uid);

        return $events;

    }

    public function getUserInvitedEvents()
    {
        $invites = Invite::getActiveUserInvites();
        $events = [];
        foreach($invites as $invite)
        {
            $event_array= Event::getByInviteEID($invite->eid);
            foreach($event_array as $single_event)
            {
                array_push($events, $single_event);
            }
        }

        return $events;
    }
}
