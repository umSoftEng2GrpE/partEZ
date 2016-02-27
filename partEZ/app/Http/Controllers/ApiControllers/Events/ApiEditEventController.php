<?php

namespace App\Http\Controllers\ApiControllers\Events;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

class ApiEditEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function editEvent( Request $request )
    {
        $input = json_decode($request->getContent());
        $event = Event::find($input->event->eid);
        if (array_key_exists('name', $input->event)) {
            $event->name = $input->event->name;
        }
        if (array_key_exists('location', $input->event)) {
            $event->location = $input->event->location;
        }
        if (array_key_exists('description', $input->event)) {
            $event->description = $input->event->description;
        }
        if (array_key_exists('date', $input->event)) {
            $event->date = $input->event->date;
        }
        if (array_key_exists('stime', $input->event)) {
            $event->stime = $input->event->stime;
        }
        if (array_key_exists('etime', $input->event)) {
            $event->etime = $input->event->etime;
        }
        Event::saveEvent($event);
    }
}
