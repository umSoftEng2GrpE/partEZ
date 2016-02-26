<?php

namespace App\Http\Controllers\ApiControllers\Events;

use App\EventListItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

class ApiEventItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public static function submitItems( Request $request )
    {
        $itemlist = json_decode($request->getContent());
        foreach( $itemlist->items as $item )
        {
            $newItem = new EventListItem();
            $newItem->uid = $item->uid;
            $newItem->eid = $item->eid;
            $newItem->description = $item->description;
            $newItem->save();
        }
    }

    public function getEventItems( Request $request )
    {
        $items = Event::getEventItems( $request['eid'] );
        return response()->json(compact('items'));
    }
}
