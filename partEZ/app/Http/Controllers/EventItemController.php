<?php

namespace App\Http\Controllers;

use App\PollResponse;
use DB;
use Auth;
use Mail;
use Exception;
use App\Event;
use App\User;
use App\Invite;
use App\Poll;
use App\EventListItem;
use App\PollOption;
use Illuminate\Support\Facades\Request;

class EventItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function submitItems($eid)
    {
        $input = Request::all();
        $itemsList = $input['returnlist'];

        $itemArray = array_map( 'trim', explode(',', $itemsList));

        foreach ($itemArray as $item)
        {
            $newItem = new EventListItem();
            $newItem->eid = $eid;
            $newItem->uid = 0;
            $newItem->description = $item;
            $newItem->save();
        }
    }

    public function getEventItems( $eid )
    {
        return Event::getEventItems( $eid );
    }

    public static function assignUser( $iid, $eid )
    {
        EventListItem::assignUser($iid, $eid, Auth::user()['uid']);
        return redirect()->route('events.event_details', [$eid]);;
    }
}