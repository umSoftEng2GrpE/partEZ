<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventListItem extends Model
{
    //

    protected $table = 'event_list_items';
    protected $primaryKey = 'iid';

    protected  $guarded = [
        'eid', 'uid',
    ];

    protected $fillable = [
        'description',
    ];

    public static function saveEventListItem( $listItem )
    {
    	return $listItem->save();
    }
}
