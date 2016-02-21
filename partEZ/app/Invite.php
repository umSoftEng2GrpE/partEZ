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
    protected $table = 'invites';

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

    public static function getInvitees( $eid )
    {
        $invites = DB::table('users')
            ->join('invites', 'invites.uid', '=', 'users.uid')
            ->select('users.email')
            ->where('invites.eid', '=', $eid)
            ->get();
        return $invites;
    }

    public static function getInvites($eid)
    {
        return DB::table('users')
            ->join('invites', 'invites.uid', '=', 'users.uid')
            ->select('users.email')
            ->where('invites.eid', '=', $eid)
            ->get();
    }

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
