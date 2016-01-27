<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollResponse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Poll_Responses';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = [
        'uid', 'oid', 'pid',
    ];
}
