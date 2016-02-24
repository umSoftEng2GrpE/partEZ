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
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
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
        $array = array_merge($events->toArray(), $invites);
        return response()->json(compact('array'));
    }

    public function getUsersEvents()
    {
        $user = Auth::user();

        $events = Event::getUserEvents($user->uid);
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
