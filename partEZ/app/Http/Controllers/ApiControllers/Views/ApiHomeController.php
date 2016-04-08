<?php

namespace App\Http\Controllers\ApiControllers\Views;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Invite;
use Auth;
use DB;
use Mail;
use App\Event;


class ApiHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($local_events_only = false)
    {
        $user = Auth::user();
        $user_events = $this->getUsersEvents();
        $user_events = $user_events->toArray();
        $invited_events = $this->getUserInvitedEvents();

        $public_events = $this->getPublicEvents();
        $public_events = $public_events->toArray();

        $this->updateCity();
        $city = $user->city;
        return response()->json(compact('user_events', 'invited_events', 'public_events', 'local_events_only', 'city'));
    }

        //TODO: perhaps just call these functions from the regular home controller instead of having duplicates here
    public function getUsersEvents()
    {
        $user = Auth::user();

        $events = Event::getUserEvents($user->uid);
        return $events;

    }

    public function updateCity()
    {
        $input = [];
        $user = Auth::user();
        $city =  array_key_exists ('city' , $input) ? $input['city'] : $user->city;
        $user->city = $city;
        $user->save();
    }

    public function getPublicEvents()
    {
        $events = Event::getPublicEvents();
        return $events;
    }

    public function getUserInvitedEvents()
    {
        $user = Auth::user();
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
