<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
