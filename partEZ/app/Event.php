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
        'uid', 'name', 'date', 'stime', 'etime', 'location', 'description'
    ];

    public static function  getByID($eid)
    {
        return DB::table('events')->where('eid', $eid)->first();
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

}
