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

    public static function getByUID($uid)
    {
        return DB::table('events')->where('uid', '=', $uid)->first();
    }


}
