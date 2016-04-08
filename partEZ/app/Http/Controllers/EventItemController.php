<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiControllers\Events\ApiEventItemController;
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

        $request = new \Illuminate\Http\Request();
        $request->input('itemlist');
        $request->itemlist = $itemArray;
        ApiEventItemController::submitItems($request, $eid);
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