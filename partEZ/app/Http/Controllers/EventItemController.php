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
        $request = new \Illuminate\Http\Request();
        $request->input('eid');
        $request->eid = $eid;
        $response =  ApiEventItemController::getEventItems($request);
        return $response->getData();
    }

    public static function assignUser( $iid, $eid )
    {
        $request = new \Illuminate\Http\Request();
        $request->input('eid');
        $request->eid = $eid;
        $request->input('iid');
        $request->iid = $iid;
        ApiEventItemController::assignUser($request);
        return redirect()->route('events.event_details', [$eid]);;
    }
}