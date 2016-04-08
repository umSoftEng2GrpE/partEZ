<?php

namespace App\Http\Controllers\ApiControllers\Events;

use App\Http\Controllers\EventController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\Poll;
use App\PollOption;
use App\Invite;
use App\User;

class ApiEventDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public static function details( Request $request )
    {//Note this is piggybacking on regular event controller functions, beware of changing them!!
        $eid = $request->eid;
        $event = Event::getEvent($eid);
        $invites = Self::getInvitesFromEid($eid);
        $all_poll_options = Self::getPollOptionsFromEid($eid);
        $itemslist = Event::getEventItems($eid);
        $userRSVP = Invite::getUserRSVP($eid);
        $items = [];
        $item_users = [];

        $ticketcost = (string)$event['ticketprice'];

        if (!strpos($ticketcost, '.')){
            $ticketcost = $ticketcost . ".00";
        }

        foreach ($itemslist as $item)
        {
            array_push($items, $item);
            if( $item->uid != 0 )
            {
                $tmpUser = User::getById($item->uid);
                array_push( $item_users, $tmpUser);
            }

        }

        foreach ($itemslist as $item)
        {
            array_push($items, $item);
        }
        $chat_messages = MessageController::getMessagesFromEid($eid);

        return response()->json(compact('event', 'all_poll_options',
            'items', 'invites', 'chat_messages', 'item_users', 'userRSVP', 'ticketcost') );
    }

    public static function getInvitesFromEid($eid)
    {
        $invites = [];
        //Retrieving Invitees for Display
        $inviteDB = Invite::getInvitees($eid);

        foreach ($inviteDB as $entry)
        {
            array_push($invites, $entry->email);
        }

        return $invites;
    }

    public static function getPollOptionsFromEid($eid)
    {
        $event = Event::find($eid);

        //Retrieving Polls for Display
        $polls = Poll::getEventPolls($eid);

        $all_poll_options = [];
        foreach ($polls as $poll)
        {
            $options = [];

            if(null != $poll)
            {
                $options = PollOption::getPollOptions($poll->pid);
            }
            array_push($all_poll_options, $options);
        }

        return $all_poll_options;
    }
}
