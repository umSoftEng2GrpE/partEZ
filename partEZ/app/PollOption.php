<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PollOption extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poll_options';

    protected $primaryKey = 'oid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option', 'pid'
    ];

    public static function getPollOptions($pid)
    {
        return PollOption::all()->where('pid', $pid);
    }

    public static function getPollOptionsWithVotes($pid)
    {
        return DB::table('poll_options')
            ->leftjoin('poll_responses','poll_options.oid','=','poll_responses.oid')
            ->where('poll_options.pid', '=', $pid)
            ->get();
    }

    public static function getVotes($pid, $oid)
    {
        return DB::table('poll_options')
            ->select('COUNT(*)')
            ->where('pid', '=', $pid, 'AND', 'oid', '=', $oid);
    }

    public static function savePollOption( $pollOption )
    {
        return $pollOption->save();
    }

}
