<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOptions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Poll_Options';

    protected $primaryKey = 'pid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'stime', 'etime', 'location', 'custom',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = [
        'oid',
    ];
}
