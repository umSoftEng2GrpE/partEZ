<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use DB;

class EventListItem extends Model
{
    //

    protected $table = 'event_list_items';
    protected $primaryKey = 'iid';

    protected  $guarded = [
        'eid', 'uid',
    ];

    protected $fillable = [
        'description',
    ];

    public static function saveEventListItem( $listItem )
    {
    	return $listItem->save();
    }

    public static function assignUser( $iid, $eid, $uid )
    {
        $result = DB::table('event_list_items')->where('eid', $eid)->where('iid', $iid)->update(['uid' => $uid]);
        return $result;
    }

    public static function deleteEventListItem($eid)
    {
        return DB::table('event_list_items')->where('eid', $eid)->delete();
    }
}
