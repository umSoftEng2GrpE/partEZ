<?php

namespace App\Http\Controllers\ApiControllers\Views;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

class ApiWelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $public_events = Event::getPublicEvents();
        return response()->json(compact('public_events'));

        /*return view('welcome')->with('public_events', $public_events);

        $events = $this->getUsersEvents();
        $invites = $this->getUserInvitedEvents();
        $array = array_merge($events->toArray(), $invites);
        return response()->json(compact('array'));*/
    }
}
