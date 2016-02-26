<?php

namespace App\Http\Controllers\ApiControllers\Events;

use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

class ApiEventDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function details( Request $request )
    {//Note this is piggybacking on regular event controller functions, beware of changing them!!
        $eid = $request['eid'];
        $event = Event::getEvent($eid);
        $invites = EventController::getInvitesFromEid($eid);
        $all_poll_options = EventController::getPollOptionsFromEid($eid);
        $itemslist = Event::getEventItems($eid);
        $items = [];
        var_dump($itemslist);

        foreach ($itemslist as $item)
        {
            array_push($items, $item);
        }
        $chat_messages = MessageController::getMessagesFromEid($eid);

        return response()->json(compact('event', 'all_poll_options', 'items', 'invites', 'chat_messages') );
    }
}
