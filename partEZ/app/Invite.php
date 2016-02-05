<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Invite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Invites';

    protected $primaryKey = 'eid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'response',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = [
        'eid', 'uid',
    ];


    public static function createInviteLog($eid, $uid)
    {
        DB::table('invites')->insert(array(
            'eid' => $eid,
            'uid' => $uid
            ));
    }

    public static function changeStatus($eid, $uid, $status)
    {
        DB::table('invites')->where('eid', $eid)->where('uid', $uid)->update(['status' => $status]);
    }
}
