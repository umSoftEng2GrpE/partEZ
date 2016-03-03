<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class PollResponse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poll_responses';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = [
        'uid', 'oid', 'pid',
    ];

    public static function deletePollResponses($pid)
    {
        return DB::table('poll_responses')->where('pid', $pid)->delete();
    }
}
