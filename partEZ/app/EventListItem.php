<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventListItem extends Model
{
    //

    protected $table = 'event_list_items';

    protected  $guarded = [
        'eid','iid', 'uid',
    ];

    protected $fillable = [
        'description',
    ];
}
