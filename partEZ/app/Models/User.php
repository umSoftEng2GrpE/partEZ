<?php

namespace App;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'uid';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    private static function createDummyAccount($email){
        return DB::table('users')->insertGetId(array(
            'firstname' => '',
            'lastname' => '',
            'email' => $email,
            'active' => 0
            ));

    }


    public static function getById($uid)
    {
        return DB::table('users')->where('uid', $uid)->first();
    }


    public static function getByEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->first();

        if (is_null($user))
        {
            $user = self::getById(self::createDummyAccount($email));   
        }
            
        return $user;
    }
}
