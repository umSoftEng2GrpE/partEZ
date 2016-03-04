<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Poll extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'polls';

    protected $primaryKey = 'pid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'polltype', 'eid',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = [
        'pid',
    ];

    public static function getEventPolls($eid)
    {
        return DB::table('polls')->where('eid', $eid)->get();
    }

    public static function deleteEventPolls($eid)
    {
        $polls = DB::table('polls')->where('eid', $eid)->get();
        
        foreach ($polls as $poll){
            PollOption::deletePollOptions($poll->pid);
        }

        return DB::table('polls')->where('eid', $eid)->delete();
    }
}
