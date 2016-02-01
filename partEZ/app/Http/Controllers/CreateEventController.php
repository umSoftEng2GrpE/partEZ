<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Event;
use App\User;
use DB;
use Illuminate\Support\Facades\Request;

class CreateEventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events/create_event');
    }

    public function create()
    {
        return view('events.create');
    }


    public function store()
    {
        $input = Request::all();

        $event = new Event;

        $event->name = $input['name'];
        $event->location = $input['location'];
        $event->description = $input['description'];
        $event->date = $input['date'];
        $event->stime = $input['stime'];
        $event->etime = $input['etime'];
        $event->uid = Auth::user()['uid'];

        try
        {
            $saveflag = $event->save();
        }
        catch(Exception $e)
        {
            print '<script type="text/javascript">';
            print 'alert("The system has encountered an error please try again later")';
            print '</script>';
            return view('errors.error_event');
        }

        if($saveflag)
        {
            return view('events/success_event');
        }
    }


    public function inviteUsers()
    {
        $input = Request::all();

        $emails = $input['emails'];

        // foreach ($emails as $email) {
        //     self::getUserByEmail($email);
        // }  
    }

    public function getUserByEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->first();

        if (is_null($user))
        {
            $user = new User;

            $user->firstname = 'dummy';
            $user->lastname = 'test';
            $user->email = $email;
            $user->active = 1;

            $user->save();
        }
            
        return $user;
    }

}
