<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Events';

    protected $primaryKey = 'eid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'date', 'stime', 'etime', 'location', 'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = [
        'uid',
    ];
}
