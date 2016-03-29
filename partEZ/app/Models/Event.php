<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    protected $primaryKey = 'eid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'name', 'date', 'stime', 'etime', 'location', 'description', 'public', 'city', 'hastickets', 'numtickets', 'ticketprice'
    ];

    public static function getByID($eid)
    {
        // Returns a single event object to the caller.
        return DB::table('events')->where('eid', $eid)->first();
    }

    public static function getByInviteEID($eid) {
        // Returns an array containing an event object to the caller.
        return self::where('eid', '=', $eid)->get();
    }

    public static function getUserEvents($uid)
    {
        return Event::where('uid', '=', $uid)->get();
    }

    public static function getPublicEvents()
    {
        return Event::where('public', '=', 1)->get();
    }

    public static function getEvent($eid)
    {
        return Event::find($eid);
    }

    public static function saveEvent( $event )
    {
        return $event->save();
    }

    public static function getEventItems( $eid )
    {
        return DB::table('event_list_items')->where('eid', $eid)->get();
    }

    public static function deleteEvent($eid)
    {
        return DB::table('events')->where('eid', $eid)->delete();
    }

}
