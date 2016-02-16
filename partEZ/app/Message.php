<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    protected $primaryKey = 'mid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message', 'eid', 'uid',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = [
        'mid',
    ];


    // Gets all messages for the specified event.
    public static function getByAllByEid($eid) 
    {
    	return DB::table('message')->where('eid', $eid);
    }


    // Gets all messages for the specified user.
    public static function getAllByUid($uid)
    {
    	return DB::table('message')->where('uid', $uid);
    }


    // Gets all messages for the specified event after the specified message.
    public static function getAllRecent($eid, $mid)
    {
    	return DB::table('message')->where('eid', $eid)->where('mid', '>', $mid);
    }

    public static function createMessage($eid, $message)
    {
        $uid = Auth::user()->uid

        DB::table('messages')->insert([
            'eid' => $eid, 
            'uid' => $uid, 
            'message' => $message,
            'created' => date('Y-m-d h:i:s')
            ]);
    }

}
